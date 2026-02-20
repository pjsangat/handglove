<?php

namespace App\Models;
use CodeIgniter\Model;
 
class ShiftsTimekeepingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_shift_timekeeping';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['shift_id', 'clinician_id', 'punch_datetime', 'punch_type', 'reference', 'ip_address'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function getStats($clinician_id)
    {
        $db = \Config\Database::connect();
        
        // 1. Calculate Attendance
        // Total shifts assigned to this clinician
        $totalAssigned = $db->table('tbl_shift_clinicians')
                            ->where('clinician_id', $clinician_id)
                            ->where('status', 10) // Assigned/Accepted
                            ->countAllResults();
                            
        // Total shifts with at least a punch-in
        $totalPunched = $this->where('clinician_id', $clinician_id)
                             ->select('shift_id')
                             ->where('punch_type', 10)
                             ->groupBy('shift_id')
                             ->countAllResults();
                             
        $attendance = ($totalAssigned > 0) ? ($totalPunched / $totalAssigned) * 100 : 0;
        
        // 2. Calculate Lateness
        $punches = $this->select('tbl_shift_timekeeping.punch_datetime, tbl_shifts.shift_start_time, tbl_shifts.start_date')
                        ->join('tbl_shifts', 'tbl_shifts.id = tbl_shift_timekeeping.shift_id', 'INNER')
                        ->where('tbl_shift_timekeeping.clinician_id', $clinician_id)
                        ->where('tbl_shift_timekeeping.punch_type', 10)
                        ->findAll();
                        
        $lateCount = 0;
        $totalPunches = count($punches);
        
        foreach($punches as $punch){
            $scheduledStart = strtotime($punch['start_date'] . ' ' . $punch['shift_start_time']);
            $actualPunch = strtotime($punch['punch_datetime']);
            
            if($actualPunch > $scheduledStart){
                $lateCount++;
            }
        }
        
        $lateness = ($totalPunches > 0) ? ($lateCount / $totalPunches) * 100 : 0;
        
        return [
            'attendance' => round($attendance),
            'lateness' => round($lateness)
        ];
    }
}
