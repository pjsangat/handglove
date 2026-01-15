<?php

namespace App\Controllers\Clinician;


use App\Controllers\BaseController;
use App\Models\CliniciansModel;
use App\Models\ClinicianReferralsModel;
use App\Models\CredentialTypesModel;
use App\Models\ClinicianCredentialsModel;
use App\Models\ShiftRequestsModel;
use App\Models\ShiftsModel;
use App\Models\ShiftCliniciansModel;
use App\Libraries\Ciqrcode;
use App\Models\UserModel;
use \Datetime;
use CodeIgniter\Files\File;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $data['session'] = $session;
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }else{
            $credentialTypeModel = new CredentialTypesModel;
            $clinModel = new CliniciansModel;
            $clinCredsModel = new ClinicianCredentialsModel;

            $data['credential_types'] = $credentialTypeModel->where('status', 1)->findAll();
            $data['profileData'] = $clinModel
                                        ->select('tbl_clinicians.*, tbl_clinician_types.name as type_name')
                                        ->join('tbl_clinician_types', 'tbl_clinician_types.id = tbl_clinicians.type', 'INNER')
                                        ->where('tbl_clinicians.email', session()->get('email'))
                                        ->first();

            $credentials = $clinCredsModel->where('clinician_id', $data['profileData']['id'])->findAll();
            foreach($credentials as $credential){
                $data['profileData']['credentials'][$credential['credential_id']] = $credential;
            }
            $objClinReferrals = new ClinicianReferralsModel;
            $referral_arr = $objClinReferrals->where('clinician_id', $data['profileData']['id'])
                                    ->findAll();

            
            $referrals = [];
            foreach($referral_arr as $ref){
                $supervisor = $clinModel->find($ref['supervisor_id']);
                $referrals[] = $supervisor;
            }
            $data['referrals'] = $referrals;
            $objShiftRequest = new ShiftRequestsModel;
            $data['job_requests'] = $objShiftRequest->getRequests($data['profileData']['id']);

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
                    COMPILED_ASSETS_PATH . 'css/pages/profile'
                ),
                'session' => $data['session']
            ))
            .view('profile/index', $data)
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
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/profile.min.js',
                )
            ))
            .view('components/footer');
        }
    }

    function public_profile($clinician_id){
            $credentialTypeModel = new CredentialTypesModel;
            $clinModel = new CliniciansModel;
            $clinCredsModel = new ClinicianCredentialsModel;

            $data['credential_types'] = $credentialTypeModel->where('status', 1)->findAll();
            $data['profileData'] = $clinModel
                                        ->select('tbl_clinicians.*, tbl_clinician_types.name as type_name')
                                        ->join('tbl_clinician_types', 'tbl_clinician_types.id = tbl_clinicians.type', 'INNER')
                                        ->where('tbl_clinicians.email', session()->get('email'))
                                        ->first();

            $credentials = $clinCredsModel->where('clinician_id', $data['profileData']['id'])->findAll();
            foreach($credentials as $credential){
                $data['profileData']['credentials'][$credential['credential_id']] = $credential;
            }
            $objClinReferrals = new ClinicianReferralsModel;
            $referral_arr = $objClinReferrals->where('clinician_id', $data['profileData']['id'])
                                    ->findAll();

            
            $referrals = [];
            foreach($referral_arr as $ref){
                $supervisor = $clinModel->find($ref['supervisor_id']);
                $referrals[] = $supervisor;
            }
            $data['referrals'] = $referrals;
            $objShiftRequest = new ShiftRequestsModel;
            $data['job_requests'] = $objShiftRequest->getRequests($data['profileData']['id']);

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
                    COMPILED_ASSETS_PATH . 'css/pages/profile'
                ),
                'session' => $data['session']
            ))
            .view('profile/public', $data)
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
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/profile.min.js',
                )
            ))
            .view('components/footer');
    }

    public function edit()
    {
        $session = session();
        $data['session'] = $session;
        
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }
        $regModel = new RegistrationModel;
        $mTypeModel = new MembertypeModel;
        $data['regData'] = $regModel->where('email_address', session()->get('email'))->first();
        $data['mType'] = $mTypeModel->where('id', $data['regData']['member_type'])->first();
        
        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'Villamor Air Base Golf Course',
            'description' => '',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'Villamor Air Base Golf Course',
                'description' => '',
                'image' => IMG_URL . ''
            ),
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-datepicker',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/profile'
            ),
            'session' => $data['session']
        ))
        .view('profile/edit', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/jquery.validate.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/profile.min.js',
            )
        ));
    }

    public function update(){

        $session = session();
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }

        $data['success'] = 0;
        $data['message'] = 'Invalid request';
        
        if ($this->request->isAJAX()) {
            $validationRule = [
                'id_file' => [
                    'label' => 'ID',
                    'rules' => [
                        'max_size[id_file, 16000]',
                    ],
                ],
            ];
            if (! $this->validateData([], $validationRule)) {
                $data['message'] = implode("<br>",  $this->validator->getErrors());
            }else{
                $file = $this->request->getFile('id_file');

                $first_name = $this->request->getPost('first_name');
                $last_name = $this->request->getPost('last_name');
                $mobile_number = $this->request->getPost('contact_number');
                $date_of_birth = $this->request->getPost('date_of_birth');
    
                $regModel = new RegistrationModel;
                $reg = $regModel->where('email_address', $session->get('email'))->first();
                $item = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'mobile_number' => $mobile_number,
                    'date_of_birth' => date("Y-m-d", strtotime($date_of_birth)),
                ];
                $nsave = $regModel->set($item)->where('email_address', $session->get('email'))->update();
                if($nsave && $file->isValid()){
                    $orig_name = $file->getName();

                    $client = new \Aws\S3\S3Client([
                        'region' => 'ap-southeast-1',
                        'version' => 'latest',
                        'credentials' => [
                            'key' => 'AKIATCKASCV6SM4BXYHC',
                            'secret' => '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',
                        ],
                    ]);
                    $bucket = 'tpbucketdv01';
                    $key = 'vabgc/uploads/'.$reg['id'].'/'.$orig_name; // Assuming 'file' is the name of the input field
                    
                    $result = $client->putObject([
                        'Bucket' => $bucket,
                        'Key' => $key,
                        'SourceFile' => $file->getRealPath(),
                        'ContentType' => $file->getMimeType()
                    ]);                    
                    $regModel = new RegistrationModel;
                    $regModel->update($reg['id'], ['id_image' => $result['ObjectURL']]);

                    // $path = FCPATH.'assets/img/uploads/'.$reg['id'];
                    // if(!is_dir(FCPATH.'assets/img/uploads/')){
                    //     mkdir(FCPATH.'assets/img/uploads/');
                    // }
                    // if(!is_dir($path)){
                    //     mkdir($path);
                    // }
                    // if($file->move($path, $orig_name)){
                    //     $regModel = new RegistrationModel;
                    //     $regModel->update($reg['id'], ['id_image' => BASE_URL . 'assets/img/uploads/' . $reg['id'] . '/' . $orig_name]);
                    // }
                }

                $userModel = new UserModel;
                $item = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'contact_number' => $mobile_number,
                    'date_of_birth' => date("Y-m-d", strtotime($date_of_birth)),
                ];
                $save = $userModel->set($item)->where('id', $session->get('id'))->update();


                // $nsave = $regModel->save($item);
                // $reg_id = $regModel->getInsertID();
    
                // $save = $userModel->save($item);
                // $user_id = $userModel->getInsertID();

                if($save){
                    $session->set('first_name', $first_name);
                    $session->set('last_name', $last_name);
                    $session->set('date_of_birth',  date("Y-m-d", strtotime($date_of_birth)));
                    $session->set('mobile_number', $mobile_number);
                    session()->setFlashData('success', 'Profile successfully updated.');

                    $data['message'] = 'Profile successfully updated.';
                    $data['success'] = 1;
                }
            }

        }

        echo json_encode($data);
        exit();


    }

    public function change_password(){

        $session = session();
        $data['session'] = $session;
        
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }

        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'Villamor Air Base Golf Course',
            'description' => '',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'Villamor Air Base Golf Course',
                'description' => '',
                'image' => IMG_URL . ''
            ),
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-datepicker',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/profile'
            ),
            'session' => $data['session']
        ))
        .view('profile/change_password', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/jquery.validate.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/profile.min.js',
            )
        ));

    }
    public function update_password(){

        $session = session();
        $data['success'] = 0;
        $data['message'] = 'Invalid request';

        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }

        if ($this->request->isAJAX()) {
            $userModel = new UserModel;
            $user = $userModel->find($session->get('id'));
            $verify_password = password_verify($this->request->getPost('current'), $user['password']);

            if($verify_password){
                $userModel = new UserModel;
                $password = $this->request->getPost('password');
                $save = $userModel->set(['password' => password_hash($password, PASSWORD_DEFAULT)])->where('id', $session->get('id'))->update();
                if($save){
                    $data['success'] = 1;
                    session()->setFlashData('success', 'Password successfully updated.');
                    $data['message'] = 'success';
                }
            }else{
                $data['message'] = 'Current password is invalid.';
            }
        }

        echo json_encode($data);
        exit();
    }

    function upload_credentials(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            $clinModel = new CliniciansModel;
            $profileData = $clinModel->where('email', session()->get('email'))->first();

            $clinician_id = $profileData['id'];
            
            if($this->request->isAJAX()){

                // $path = FCPATH. 'leads/uploads/clinicians/'.$clinician_id;

                $validationRule = [
                    'file_' . $_POST['credential_id'] => [
                        'label' => 'Credential File',
                        'rules' => [
                            'uploaded[file_' . $_POST['credential_id'].']',
                            'mime_in[file_' . $_POST['credential_id'].',image/jpg,image/jpeg,image/png,application/pdf]',
                            'max_size[file_' . $_POST['credential_id'].', '.(1024 * 5).']',
                        ],
                    ],
                ];

                
                // if (!is_dir($path)) {
                //     mkdir($path, 0777);
                // }

                if (! $this->validateData([], $validationRule)) {
                    $data['message'] = implode(",", $this->validator->getErrors());
                }else{
                    
                    $orig_filename = $_FILES['file_' . $_POST['credential_id']]['name'];
                    // $file_arr = explode(".", $_FILES['file_' . $_POST['credential_id']]['name']);

                    // $filename = $file_arr[0] . '_' . $_POST['credential_id'] . '_' . date("YmdHis") .'.' . $file_arr[1];
                    // $config['file_name'] = $filename;

                    $img = $this->request->getFile('file_' . $_POST['credential_id']);
                    if (! $img->hasMoved()) {
                        
                        $credsModel = new ClinicianCredentialsModel;
                        $creds = $credsModel->where('clinician_id', $clinician_id)->where('credential_id', $_POST['credential_id'])->findAll();

                        if(!empty($creds)){
                            foreach($creds as $item){
                                unlink($item['file_path']);
                                $credsModel->where('id', $item['id'])->delete();
                            }
                        }
                        $filepath = WRITEPATH . 'uploads/' . $img->store();

                        $item = [
                            'credential_id' => $_POST['credential_id'],
                            'clinician_id' => $clinician_id,
                            'filename' => $orig_filename,
                            'file_path' => $filepath
                        ];
                        $credsModel->save($item);

                        $data['success'] = 1;
                        $data['data'] = [
                            'file' => '<a href="'. base_url('profile/showCredential/'.$_POST['credential_id']) .'" target="_blank">'.$orig_filename.'</a>',
                            'credential_id' => $_POST['credential_id']
                        ];
                    }


                }

            }
        }

        echo json_encode($data);
        exit();
    }


    public function request(){
        $session = session();
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        if( $session->get('isLoggedIn') == 1){
            $clinModel = new CliniciansModel;
            $profileData = $clinModel->where('email', session()->get('email'))->first();

            $clinician_id = $profileData['id'];
            
            if($this->request->isAJAX()){
                $item = [
                    'status' => $this->request->getPost('status'),
                ];
                $objShiftRequest = new ShiftRequestsModel;
                $objShiftRequest->update($this->request->getPost('requestID'), $item);

                if($this->request->getPost('status') == '20'){
                    $shiftClinModel = new ShiftCliniciansModel;
                    
                    $item = [
                        'client_id' => $this->request->getPost('clientID'),
                        'shift_id' => $this->request->getPost('shiftID'),
                        'clinician_id' => $profileData['id'],
                        'status' => 10,
                        'pcc_status' => 10,
                    ];
                    $shiftClinModel->save($item);
                }

                $session->setFlashdata('message', 'Job Request has been ' . ($item['status'] == 20 ? 'accepted' : 'declined') . '.');
            }
        }


        echo json_encode($data);
        exit();
    }
    function test_email(){
        $email = service('email');
        $email->setFrom('admin@handglove.net', 'Handglove');
        $email->setTo('pjsangat@gmail.com');
        $email->setSubject('Email Test');
        $email->setMessage('Testing the email class.');
        $e = $email->send();
        pe($email->printDebugger());
    }

}
