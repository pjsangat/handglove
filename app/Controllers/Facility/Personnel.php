<?php

namespace App\Controllers\Facility;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\FacilityModel;
use App\Models\UserTypesModel;

class Personnel extends BaseController
{
    protected $userModel;
    protected $facilityModel;
    protected $userTypesModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->facilityModel = new FacilityModel();
        $this->userTypesModel = new UserTypesModel();
        $this->session = session();
    }

    public function index()
    {
        // Redirect if not a facility user
        if ($this->session->get('facility_id') == 0) {
            return redirect()->to('/profile');
        }

        $facility = $this->facilityModel->find($this->session->get('facility_id'));
        if (!$facility) {
            return redirect()->to('/profile');
        }

        $data = [
            'session' => $this->session,
            'facility' => $facility,
            'userTypes' => $this->userTypesModel->findAll(),
            'page' => 'personnel'
        ];

        return view('components/header', [
            'title' => 'Handglove',
            'description' => '',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => [
                'title' => 'Handglove',
                'description' => '',
                'image' => IMG_URL . ''
            ],
            'styles' => [
                'plugins/font_awesome',
                'plugins/datatables',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/toastr',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/facility_profile'
            ],
            'session' => $this->session
        ])
        . view('facility/manage', $data)
        . view('components/scripts_render', [
            'scripts' => [
                'https://code.jquery.com/jquery-3.5.1.min.js' => [
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ],
                'https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js',
                'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.2/datatables.min.js',
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/plugins/toastr.min.js',
                ASSETS_URL . 'js/pages/facility_personnel.min.js',
            ]
        ])
        . view('components/footer');
    }

    public function list()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        $facilityId = $this->session->get('facility_id');
        if ($facilityId == 0) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Unauthorized.']);
        }

        $users = $this->userModel
            ->select('tbl_users.*, tbl_user_types.name as type_name')
            ->join('tbl_user_types', 'tbl_user_types.id = tbl_users.type', 'inner')
            ->where('facility_id', $facilityId)
            ->findAll();

        $formattedData = [];
        foreach ($users as $user) {
            $formattedData[] = [
                'name' => sprintf('<div><strong>%s %s</strong></div>', $user['first_name'], $user['last_name']),
                'email' => $user['email'],
                'contact' => $user['contact_number'],
                'type' => $user['type_name'],
                'status' => $user['status'] == 1 ? 'Active' : 'Inactive',
                'action' => sprintf('<div class="text-center"><a href="javascript:;" data-id="%s" class="view-personnel btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View details"><i class="fa fa-search"></i></a></div>', $user['id'])
            ];
        }

        return $this->response->setJSON([
            'success' => 1,
            'message' => '',
            'data' => $formattedData
        ]);
    }

    public function get()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        $personnelId = $this->request->getPost('personnelID');
        if (!$personnelId) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Missing ID.']);
        }

        $user = $this->userModel->find($personnelId);
        if ($user && $user['facility_id'] == $this->session->get('facility_id')) {
            return $this->response->setJSON(['success' => 1, 'personnel' => $user]);
        }

        return $this->response->setJSON(['success' => 0, 'message' => 'Personnel not found or unauthorized.']);
    }

    public function insert()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        $facilityId = $this->session->get('facility_id');
        if ($facilityId == 0) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Unauthorized.']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email|is_unique[tbl_users.email]',
            'contact_number' => 'required',
            'signature' => 'required',
            'type' => 'required',
            'password' => 'required|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => 0,
                'message_header' => 'Personnel',
                'message' => implode('<br>', $validation->getErrors())
            ]);
        }

        $item = [
            'facility_id' => $facilityId,
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'contact_number' => $this->request->getPost('contact_number'),
            'signature' => $this->request->getPost('signature'),
            'type' => $this->request->getPost('type'),
            'status' => $this->request->getPost('status'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'token' => '',
            'token_active' => 0
        ];

        $this->userModel->save($item);

        return $this->response->setJSON([
            'success' => 1,
            'message_header' => 'Personnel',
            'message' => 'Personnel successfully added.'
        ]);
    }

    public function update()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        $facilityId = $this->session->get('facility_id');
        $personnelId = $this->request->getPost('personnelID');

        if ($facilityId == 0 || !$personnelId) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request or missing ID.']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|valid_email|is_unique[tbl_users.email,id,{$personnelId}]",
            'contact_number' => 'required',
            'signature' => 'required',
            'type' => 'required'
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[5]';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => 0,
                'message_header' => 'Personnel',
                'message' => implode('<br>', $validation->getErrors())
            ]);
        }

        $item = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'contact_number' => $this->request->getPost('contact_number'),
            'signature' => $this->request->getPost('signature'),
            'type' => $this->request->getPost('type'),
            'status' => $this->request->getPost('status')
        ];

        if ($this->request->getPost('password')) {
            $item['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($personnelId, $item);

        return $this->response->setJSON([
            'success' => 1,
            'message_header' => 'Personnel',
            'message' => 'Personnel successfully updated.'
        ]);
    }
}
