<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationsModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
        'url'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get unread notifications for a specific user
     * 
     * @param int $userId
     * @return array
     */
    public function getUnreadByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('is_read', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Mark all notifications as read for a specific user
     * 
     * @param int $userId
     * @return bool
     */
    public function markAllAsRead($userId)
    {
        return $this->where('user_id', $userId)
                    ->set(['is_read' => 1])
                    ->update();
    }

    /**
     * Create a notification record
     * 
     * @param int $fromId Facility ID (tbl_clients)
     * @param int $toId Clinician ID (tbl_clinicians)
     * @param string $type 
     * @param int $referenceId
     * @return bool
     */
    public function createNotification($fromId, $toId, $type, $referenceId)
    {
        $facilityModel = new \App\Models\FacilityModel();
        $clinicianModel = new \App\Models\CliniciansModel();
        $userModel = new \App\Models\UserModel();

        $facility = $facilityModel->find($fromId);
        $clinician = $clinicianModel->find($toId);

        if (!$facility || !$clinician) {
            return false;
        }

        $user = $userModel->where('email', $clinician['email'])->first();
        if (!$user) {
            return false;
        }

        $title = "Notification";
        $message = "You have a new update.";
        $url = "javascript:void(0)";

        switch ($type) {
            case 'shift_request':
                $title = "New Shift Request";
                $message = "You have a new shift request from " . $facility['company_name'];
                $url = base_url('profile');
                break;
            case 'registration':
                $title = "Registration Update";
                $message = "Your registration status has been updated.";
                break;
            case 'approval':
                $title = "Shift Approved";
                $message = "Your shift has been approved by " . $facility['company_name'];
                break;
        }

        return $this->insert([
            'user_id' => $user['id'],
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
            'url'     => $url,
            'is_read' => 0
        ]);
    }
}
