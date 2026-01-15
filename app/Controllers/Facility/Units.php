<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\CliniciansModel;
use App\Models\CredentialTypesModel;
use App\Models\ClinicianCredentialsModel;
use App\Models\UserModel;
use App\Models\FacilityModel;
use App\Models\FacilityUnitsModel;
use \Datetime;
use CodeIgniter\Files\File;

class Units extends BaseController
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
            $data['page'] = 'units';
            
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
                    ASSETS_URL . 'js/pages/facility_units.min.js',
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
                    if($data['facility']){
                        $unitsModel = new FacilityUnitsModel;
                        $units = $unitsModel
                                    ->where('client_id', $session->get('facility_id'))
                                    ->findAll();

                        $data['data'] = [];
                        $data['success'] = 1;
                        $data['message'] = '';
                        foreach($units as $unit){
                            $item = [
                                'name' => '<div><strong>'.$unit['name'].'</strong></div>',
                                'description' => $unit['description'],
                                'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$unit['id'].'" class="view-unit btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View Unit details"><i class="fa fa-search"></i></a></div>'
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

    public function insert(){
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
                        $unitsModel = new FacilityUnitsModel;

                        $item = [
                            'client_id' => $session->get('facility_id'),
                            'name' => $_POST['name'],
                            'description' => $_POST['description'],
                        ];

                        $unitsModel->save($item);

                        $data['success'] = 1;
                        $data['message'] = 'Unit successfully added to the database.';
                    }
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
                if($session->get('facility_id') != 0){
                    $facilityModel = new FacilityModel;
                    $data['facility'] = $facilityModel->find($session->get('facility_id'));
                    if($data['facility'] && $_POST['unitID']){
                        $unitsModel = new FacilityUnitsModel;

                        $item = [
                            'name' => $_POST['name'],
                            'description' => $_POST['description'],
                        ];

                        $unitsModel->set($item)->where('id', $_POST['unitID'])->update();

                        $data['success'] = 1;
                        $data['message'] = 'Unit successfully updated.';
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
                $unitID = $_POST['unitID'];

                if($unitID){
                    $unitsModel = new FacilityUnitsModel;
                    $unit = $unitsModel->find($unitID);

                    if($unit){
                        $data['success'] = 1;
                        $data['message'] = '';
                        $data['unit'] = $unit;
                    }
                }
            }
        }

        echo json_encode($data);
        exit();

    }
}
