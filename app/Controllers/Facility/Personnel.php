<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\FacilityModel;
use App\Models\UserTypesModel;

class Personnel extends BaseController
{
    public function index(){
        $session = session();
        $data['session'] = $session;
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }else{
            if($session->get('facility_id') != 0){
                $facilityModel = new FacilityModel;
                $data['facility'] = $facilityModel->find($session->get('facility_id'));
                if(!$data['facility']){
                    return redirect()->to('/profile');
                }
            }
            $userTypesModel = new UserTypesModel;
            $data['userTypes'] = $userTypesModel->findAll();
            $data['page'] = 'personnel';
            
            // PAGE HEAD PROCESSING
            return view('components/header', array(
                'title' => 'Handglove',
                'description' => '',
                'url' => BASE_URL,
                'keywords' => '',
                'meta' => array(
                    'title' => 'Handglove',
                    'description' => '',
                    'image' => IMG_URL . ''
                ),
                'styles' => array(
                    'plugins/font_awesome',
                    'plugins/datatables',
                    COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                    COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                    COMPILED_ASSETS_PATH . 'css/components/owl',
                    COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                    COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                    COMPILED_ASSETS_PATH . 'css/components/global',
                    COMPILED_ASSETS_PATH . 'css/components/animations',
                    COMPILED_ASSETS_PATH . 'css/components/buttons',
                    COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                    COMPILED_ASSETS_PATH . 'css/components/footer',
                    COMPILED_ASSETS_PATH . 'css/pages/facility_profile'
                ),
                'session' => $data['session']
            ))
            .view('facility/manage', $data)
            .view('components/scripts_render', array(
                'scripts' => array(
                    'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                        'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                        'crossorigin' => 'anonymous'
                    ),
                    'https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js',
                    'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.2/datatables.min.js',
                    ASSETS_URL . 'js/plugins/popper.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                    ASSETS_URL . 'js/components/global.min.js',
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/facility_personnel.min.js',
                )
            ))
            .view('components/footer');
        }
    }

    public function list(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){
                    $userModel = new UserModel;
                    $users = $userModel
                                ->select('tbl_users.*, tbl_user_types.name as type_name')
                                ->join('tbl_user_types', 'tbl_user_types.id = tbl_users.type', 'inner')
                                ->where('facility_id', $session->get('facility_id'))
                                ->findAll();

                    $data['data'] = [];
                    $data['success'] = 1;
                    $data['message'] = '';
                    foreach($users as $user){
                        $item = [
                            'name' => '<div><strong>'.$user['first_name'].' '.$user['last_name'].'</strong></div>',
                            'email' => $user['email'],
                            'contact' => $user['contact_number'],
                            'type' => $user['type_name'],
                            'status' => $user['status'] == 1 ? 'Active' : 'Inactive',
                            'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$user['id'].'" class="view-personnel btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View details"><i class="fa fa-search"></i></a></div>'
                        ];
                        $data['data'][] = $item;
                    }
                }
            }
        }
        echo json_encode($data);
        exit();
    }

    public function get(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];
        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                $personnelID = $_POST['personnelID'];
                if($personnelID){
                    $userModel = new UserModel;
                    $user = $userModel->find($personnelID);
                    if($user && $user['facility_id'] == $session->get('facility_id')){
                        $data['success'] = 1;
                        $data['personnel'] = $user;
                    }
                }
            }
        }
        echo json_encode($data);
        exit();
    }

    public function insert(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];
        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){
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
                        $data['message'] = implode('<br>', $validation->getErrors());
                        echo json_encode($data);
                        exit();
                    }

                    $userModel = new UserModel;
                    $item = [
                        'facility_id' => $session->get('facility_id'),
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'email' => $_POST['email'],
                        'contact_number' => $_POST['contact_number'],
                        'signature' => $_POST['signature'],
                        'type' => $_POST['type'],
                        'status' => $_POST['status'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'token' => '',
                        'token_active' => 0
                    ];
                    $userModel->save($item);
                    $data['success'] = 1;
                    $data['message'] = 'Personnel successfully added.';
                }
            }
        }
        echo json_encode($data);
        exit();
    }

    public function update(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];
        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0 && $_POST['personnelID']){
                    $validation = \Config\Services::validation();
                    $personnelID = $_POST['personnelID'];
                    $rules = [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => "required|valid_email|is_unique[tbl_users.email,id,{$personnelID}]",
                        'contact_number' => 'required',
                        'signature' => 'required',
                        'type' => 'required'
                    ];

                    if(!empty($_POST['password'])){
                        $rules['password'] = 'min_length[5]';
                    }

                    if (!$this->validate($rules)) {
                        $data['message'] = implode('<br>', $validation->getErrors());
                        echo json_encode($data);
                        exit();
                    }

                    $userModel = new UserModel;
                    $item = [
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'email' => $_POST['email'],
                        'contact_number' => $_POST['contact_number'],
                        'signature' => $_POST['signature'],
                        'type' => $_POST['type'],
                        'status' => $_POST['status']
                    ];
                    if(!empty($_POST['password'])){
                        $item['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    }
                    $userModel->update($_POST['personnelID'], $item);
                    $data['success'] = 1;
                    $data['message'] = 'Personnel successfully updated.';
                }
            }
        }
        echo json_encode($data);
        exit();
    }
}
