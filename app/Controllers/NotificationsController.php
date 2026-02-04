<?php

namespace App\Controllers;

use App\Models\NotificationsModel;
use CodeIgniter\API\ResponseTrait;

class NotificationsController extends BaseController
{
    use ResponseTrait;

    protected $notificationsModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();
    }

    /**
     * Notification Management Index
     */
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = $session->get('id');
        $data['session'] = $session;
        $data['page'] = 'notifications';
        
        // Fetch all notifications for the user
        $data['notifications'] = $this->notificationsModel->where('user_id', $userId)
                                                          ->orderBy('created_at', 'DESC')
                                                          ->findAll();

        return view('components/header', [
            'title' => 'Notifications | Handglove',
            'description' => '',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'Handglove',
                'description' => '',
                'image' => IMG_URL . ''
            ),
            'session' => $session,
            'styles' => [
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/facility_profile'
            ]
        ])
        . view('notifications/manage', $data)
        . view('components/scripts_render', [
            'scripts' => [
                'https://code.jquery.com/jquery-3.5.1.min.js' => [
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ],
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/components/notifications.min.js',
            ]
        ])
        . view('components/footer');
    }

    /**
     * Get unread notifications for the logged-in user
     */
    public function get_unread()
    {

        $userId = session()->get('id');
        if (!$userId) {
            return $this->failUnauthorized('Session expired');
        }

        $notifications = $this->notificationsModel->getUnreadByUser($userId);
        $count = count($notifications);

        return $this->respond([
            'status' => 'success',
            'count' => $count,
            'notifications' => $notifications
        ]);
    }

    /**
     * Mark all notifications as read for the logged-in user
     */
    public function mark_all_read()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return $this->failUnauthorized('Session expired');
        }

        $this->notificationsModel->markAllAsRead($userId);

        return $this->respond([
            'status' => 'success',
            'message' => 'All notifications marked as read'
        ]);
    }

    /**
     * Mark a single notification as read
     */
    public function mark_read($id)
    {
        $userId = session()->get('id');
        if (!$userId) {
            return $this->failUnauthorized('Session expired');
        }

        $notification = $this->notificationsModel->find($id);
        if (!$notification || $notification['user_id'] != $userId) {
            return $this->failNotFound('Notification not found');
        }

        $this->notificationsModel->update($id, ['is_read' => 1]);

        return $this->respond([
            'status' => 'success',
            'message' => 'Notification marked as read'
        ]);
    }
}
