<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\FacilityModel;
use App\Models\ShiftsModel;
use App\Models\CliniciansModel;
use App\Models\ShiftCliniciansModel;
use App\Models\ShiftTypesModel;
use App\Models\ShiftRequestsModel;
use App\Models\FacilityUnitsModel;
use App\Models\FacilityOnboardingModel;
use App\Models\FacilityOnboardingSettingsModel;
use App\Models\UserModel;
use \Datetime;
use CodeIgniter\Files\File;

class Onboarding extends BaseController
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

            $onboardingSettingsModel = new FacilityOnboardingSettingsModel;
            $onboardingSettings = $onboardingSettingsModel->where('client_id', $session->get('facility_id'))->get()->getRowArray();

            $onboardingSettings['clock_in'] = json_decode($onboardingSettings['clock_in'], true);
            $onboardingSettings['access'] = json_decode($onboardingSettings['access'], true);
            $onboardingSettings['clock_out_approval'] = json_decode($onboardingSettings['clock_out_approval'], true);
            $onboardingSettings['task_delay'] = json_decode($onboardingSettings['task_delay'], true);
            $onboardingSettings['back_up_approval'] = json_decode($onboardingSettings['back_up_approval'], true);
            $onboardingSettings['phone'] = json_decode($onboardingSettings['phone'], true);

            $data['onboardingSettings'] = $onboardingSettings;
            $data['page'] = 'onboarding';
            
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
                    COMPILED_ASSETS_PATH . 'css/components/bootstrap-datepicker',
                    COMPILED_ASSETS_PATH . 'css/components/bootstrap-switch-toggle',
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
                    'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.2/datatables.min.js',
                    ASSETS_URL . 'js/plugins/popper.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                    ASSETS_URL . 'js/components/global.min.js',
                    'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-datepicker.js',
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/facility_onboarding.min.js',
                )
            ))
            .view('components/footer');
        }
    }


    public function update(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){
                    $postData = $this->request->getPost();
                    $file = $this->request->getFile('pdf');

                    $validationRules = [
                        'name' => [
                            'label' => 'Name',
                            'rules' => 'required',
                        ],
                        'youtube_link' => [
                            'label' => 'Youbute link',
                            'rules' => 'permit_empty|valid_url_strict'
                        ]
                    ];

                    if ($file && $file->isValid() && $file->getError() == 0) {
                        $validationRules['pdf'] = [
                            'label' => 'PDF File',
                            'rules' => [
                                'uploaded[pdf]',
                                'mime_in[pdf,application/pdf]',
                                'max_size[pdf, '.(1024 * 5).']',
                            ],
                        ];
                    }

                    if (!$this->validate($validationRules)) {
                        $data['message'] = $this->validator->getErrors();
                    }else{

                        $onboardingObj = new FacilityOnboardingModel;
                        $item = [
                            'name' => $postData['name'],
                            'description' => $postData['description'],
                            'command' => $postData['command'],
                            'youtube_link' => $postData['youtube_link'],
                        ];
                        $onboardingObj->update($postData['onboardingID'], $item);


                        if ($file && $file->isValid() && $file->getError() == 0) {
                            $orig_filename = $_FILES['pdf']['name'];


                            if(! $file->hasMoved()) {
                                $onboardingModel = new FacilityOnboardingModel;
                                $onboarding = $onboardingModel->find($postData['onboardingID']);
                                if(!empty($onboarding) && !empty($onboarding['filename'])){
                                    @unlink($onboarding['filename']);
                                }
                                $filepath = WRITEPATH . 'uploads/' . $file->store();
                                $onboardingObj->update($postData['onboardingID'], ['filename' => $filepath]);

                            }
                        }
                        $data['success'] = 1;
                        $data['message'] = 'Onboarding file updated successfully.';

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
                    $postData = $this->request->getPost();
                    $file = $this->request->getFile('pdf');

                    $validationRules = [
                        'name' => [
                            'label' => 'Name',
                            'rules' => 'required',
                        ],
                        'youtube_link' => [
                            'label' => 'Youbute link',
                            'rules' => 'permit_empty|valid_url_strict'
                        ]
                    ];

                    if ($file && $file->isValid() && $file->getError() == 0) {
                        $validationRules['pdf'] = [
                            'label' => 'PDF File',
                            'rules' => [
                                'uploaded[pdf]',
                                'mime_in[pdf,application/pdf]',
                                'max_size[pdf, '.(1024 * 5).']',
                            ],
                        ];
                    }

                    if (!$this->validate($validationRules)) {
                        $data['message'] = $this->validator->getErrors();
                    }else{

                        $onboardingObj = new FacilityOnboardingModel;
                        $item = [
                            'name' => $postData['name'],
                            'description' => $postData['description'],
                            'client_id' => $session->get('facility_id'),
                            'command' => $postData['command'],
                            'youtube_link' => $postData['youtube_link'],
                        ];
                        $onboardingObj->save($item);


                        if ($file && $file->isValid() && $file->getError() == 0) {
                            $orig_filename = $_FILES['pdf']['name'];


                            if(! $file->hasMoved()) {
                                $onboardingModel = new FacilityOnboardingModel;
                                $onboarding = $onboardingModel->find($postData['onboardingID']);
                                if(!empty($onboarding) && !empty($onboarding['filename'])){
                                    @unlink($onboarding['filename']);
                                }
                                $filepath = WRITEPATH . 'uploads/' . $file->store();
                                $onboardingObj->update($postData['onboardingID'], ['filename' => $filepath]);

                            }
                        }
                        $data['success'] = 1;
                        $data['message'] = 'Onboarding file updated successfully.';

                    }
                }
            }
        }

        echo json_encode($data);
        exit();
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

                    $facilityModel = new FacilityModel;
                    $data['facility'] = $facilityModel->find($session->get('facility_id'));

                    if($data['facility']){
                        
                        $onboardingModel = new FacilityOnboardingModel;
                        $onboarding_files = $onboardingModel->where('client_id', $data['facility']['id'])->findAll();
                        foreach($onboarding_files as $onboarding_file){

                            $item = [
                                'name' => $onboarding_file['name'],
                                'pdf' => $onboarding_file['filename'] != '' ? '<div class="text-center"><a href="'.base_url('facility/profile/'.$onboarding_file['client_id'].'/onboarding/'.$onboarding_file['id'].'/pdf').'" target="_blank" style="font-size: 25px;color: red;"><i class="fas fa-file-pdf"></i></a>' : '',
                                'youtube' => $onboarding_file['youtube_link'] != '' ? '<div class="text-center"><a href="'.$onboarding_file['youtube_link'].'" target="_blank" style="font-size: 25px;color: red;"><i class="fab fa-youtube"></i></a>' : '',
                                'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$onboarding_file['id'].'" class="update-onboarding btn btn-blue pl-2 pr-2 pt-1 pb-1" title="Update"><i class="fa fa-edit"></i></a> <a href="'.base_url('facility/profile/'.$onboarding_file['client_id'].'/onboarding/'.$onboarding_file['id']).'" target="_blank" class="btn pl-2 pr-2 pt-1 pb-1" title="View"><i class="fa fa-eye"></i></a></div>'
                            ];


                            $data['data'][] = $item;
                        }

                    }

                }
            }
        }
        echo json_encode($data);
        exit();

    }

    public function update_settings(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){
                    $postData = $this->request->getPost();
                    $onboardingSettingsModel = new FacilityOnboardingSettingsModel;

                    $item = [
                        'timezone' => $postData['timezone'],
                        'clock_in' => isset($postData['clock_in']) ? json_encode($postData['clock_in']) : json_encode([]),
                        'client_id' => $session->get('facility_id'),
                        'access' => isset($postData['access']) ? json_encode($postData['access']) : json_encode([]),
                        'clock_out_approval' => isset($postData['clock_out_approval']) ? json_encode($postData['clock_out_approval']) : json_encode([]),
                        'task_delay' => isset($postData['task_delay']) ? json_encode($postData['task_delay']) : json_encode([]),
                        'back_up_approval' => isset($postData['back_up_approval']) ? json_encode($postData['back_up_approval']) : json_encode([]),
                        'phone' => isset($postData['phone']) ? json_encode($postData['phone']) : json_encode([]),
                        'allow_overtime' => isset($postData['allow_overtime']) ? $postData['allow_overtime'] : 0,
                    ];
                    $onboardingSettings = $onboardingSettingsModel->where('client_id', $session->get('facility_id'))->get()->getRowArray();
                    if(empty($onboardingSettings)){
                        $onboardingSettingsModel->save($item);
                    }else{
                        $item['updated_when'] = date("Y-m-d H:i:s");
                        $onboardingSettingsModel->update($onboardingSettings['id'], $item);
                    }

                    $data['success'] = 1;
                    $data['message'] = 'Onboarding settings updated successfully';
                }
            }
        }
        echo json_encode($data);
        exit();
    }

    public function edit(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){
                    $postData = $this->request->getPost();
                    $onboardingModel = new FacilityOnboardingModel;
                    $onboarding = $onboardingModel->find($postData['onboardingID']);
                    if(!empty($onboarding)){
                        $data['success'] = 1;
                        $data['onboarding'] = $onboarding;
                    }
                }
            }
        }
        echo json_encode($data);
        exit();

    }


}
