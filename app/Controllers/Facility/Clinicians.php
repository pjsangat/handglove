<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\CliniciansModel;
use App\Models\ClinicianTypesModel;
use App\Models\UserModel;
use App\Models\FacilityModel;
use \Datetime;
use CodeIgniter\Files\File;

class Clinicians extends BaseController
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
            $clinicianTypesModel = new ClinicianTypesModel;

            $data['clinicianTypes'] = $clinicianTypesModel->where('status', 1)->findAll();
            $data['page'] = 'clinicians';
            
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
                    'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.2/datatables.min.js',
                    ASSETS_URL . 'js/plugins/popper.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                    ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                    ASSETS_URL . 'js/components/global.min.js',
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/facility_clinicians.min.js',
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
                    $facilityModel = new FacilityModel;
                    $data['facility'] = $facilityModel->find($session->get('facility_id'));
                    if(!$data['facility']){
                        return redirect()->to('/profile');
                    }else{
                        $clinicianModel = new CliniciansModel;

                        $clinicianQuery = $clinicianModel
                                            ->select('tbl_clinicians.*, tbl_clinician_types.name as type_name')
                                            ->join('tbl_clinician_types', 'tbl_clinician_types.id = tbl_clinicians.type', 'inner')
                                            ->where('tbl_clinicians.client_id', $session->get('facility_id'));

                        if($this->request->getVar('type') == 'request'){
                            if($this->request->getVar('type')){
                                $clinicianQuery->where('tbl_clinicians.type', $this->request->getVar('shiftType'));
                                $clinicianQuery->where('tbl_clinicians.id NOT IN (SELECT clinician_id FROM tbl_client_shift_requests WHERE tbl_client_shift_requests.client_id = '.$session->get('facility_id').' AND  tbl_client_shift_requests.shift_id = '.$this->request->getVar('shift').')');
                            }
                        }

                        $clinicians = $clinicianQuery->findAll();
                        $data['data'] = [];
                        $data['success'] = 1;
                        $data['message'] = '';
                        foreach($clinicians as $clinician){
                            $item = [
                                'details' => '<div><strong>'.$clinician['name'].'</strong><br>'.$clinician['email'].'<br>'.$clinician['contact_number'].'</div>',
                                'type' => $clinician['type_name'],
                                'level' => $clinicianModel->tier_mapping[$clinician['tier']],
                                'status' => $clinician['status'] == 1 ? 'Active' : 'Inactive',
                                'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$clinician['id'].'" class="view-clinician btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View Clinician details"><i class="fa fa-search"></i></a> <a href="javascript:;" class="edit-clinician btn btn-danger pl-2 pr-2 pt-1 pb-1" title="Remove Clinician from this Facility"><i class="fa fa-trash"></i></a></div>'
                            ];

                            if($this->request->getVar('type') && $this->request->getVar('type') == 'request'){
                                $item['action'] = '<div class="text-center"><a href="javascript:;" data-shift-id="'.$this->request->getVar('shift').'" data-id="'.$clinician['id'].'" class="request-clinician btn thm-btn pl-2 pr-2 pt-1 pb-1" title=""><i class="fa fa-plust"></i> Request</a></div>';
                            }
                            $data['data'][] = $item;
                        }
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
                $clinicianID = $_POST['clinicianID'];

                if($clinicianID){
                    $clinicianModel = new CliniciansModel;
                    $clinician = $clinicianModel
                                        ->select('tbl_clinicians.*, tbl_clinician_types.name as type_name')
                                        ->join('tbl_clinician_types', 'tbl_clinician_types.id = tbl_clinicians.type', 'inner')
                                        ->find($clinicianID);
                    if($clinician){
                        $data['success'] = 1;
                        $data['message'] = '';

                        $clinician['status_label'] = $clinician['status'] == 1 ? 'Active' : 'Inactive';
                        $clinician['level'] = $clinicianModel->tier_mapping[$clinician['tier']];

                        $data['clinician'] = $clinician;
                    }
                }
            }
        }

        echo json_encode($data);
        exit();

    }
}
