<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\FacilityModel;
use App\Models\ShiftsModel;
use App\Models\ShiftTypesModel;
use App\Models\ShiftRequestsModel;
use App\Models\ShiftCliniciansModel;
use App\Models\FacilityUnitsModel;
use App\Models\UserModel;
use \Datetime;
use CodeIgniter\Files\File;

class Shifts extends BaseController
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

            $objUnits = new FacilityUnitsModel;
            $units = $objUnits->where('client_id', $session->get('facility_id'))->findAll();

            $data['page'] = 'shifts';
            $data['units'] = $units;
            
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
                    ASSETS_URL . 'js/plugins/bootstrap-datepicker.js',
                    ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                    ASSETS_URL . 'js/components/navigation_bar.min.js',
                    ASSETS_URL . 'js/pages/facility_shifts.min.js',
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

                    $date = date("Y-m-d");
                    if($this->request->getPost('date')){
                        $date = $this->request->getPost('date');
                    }
                    if($data['facility']){

                        $objShiftsModel = new ShiftsModel;
                        $builder = $objShiftsModel
                                    ->select('tbl_shifts.*, tbl_shift_types.name as type_name, tbl_client_units.name as unit_name, (SELECT count(tbl_client_shift_requests.id) FROM tbl_client_shift_requests WHERE tbl_client_shift_requests.client_id = tbl_shifts.client_id AND tbl_client_shift_requests.shift_id = tbl_shifts.id) as applicants, (SELECT count(tbl_client_shift_requests.id) FROM tbl_client_shift_requests WHERE tbl_client_shift_requests.client_id = tbl_shifts.client_id AND tbl_client_shift_requests.shift_id = tbl_shifts.id AND status = 20) as accepted')
                                    ->join('tbl_client_units', 'tbl_client_units.id = tbl_shifts.unit_id', 'inner')
                                    ->join('tbl_shift_types', 'tbl_shift_types.id = tbl_shifts.shift_type', 'inner')
                                    ->where('tbl_shifts.client_id', $session->get('facility_id'))
                                    ->where('tbl_shifts.unit_id', $this->request->getPost('unitID'))
                                    ->where('tbl_shifts.start_date', $date)
                                    ->where("'".date("H:i:s")."' BETWEEN tbl_shifts.shift_start_time AND  tbl_shifts.shift_end_time");

                        $units = $builder->findAll();


                        foreach($units as $unit){
                            $objShiftClinicians = new ShiftCliniciansModel;

                            $unit['shift_end_time_formatted'] = date("h:i A", strtotime($unit['shift_end_time']));
                            $unit['shift_start_time_formatted'] = date("h:i A", strtotime($unit['shift_start_time']));

                            $unit['clinicians'] = $objShiftClinicians
                                                        ->select('tbl_clinicians.name as clinician_id, tbl_clinicians.name as clinician_name, tbl_clinicians.profile_pic_url, tbl_shift_clinicians.*')
                                                        ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_shift_clinicians.clinician_id', 'INNER')
                                                        ->where('tbl_shift_clinicians.status', 10)
                                                        ->where('tbl_shift_clinicians.shift_status', 0)
                                                        ->where('tbl_shift_clinicians.shift_id', $unit['id'])
                                                        ->findAll();

                            $data['data'][] = $unit;
                        }                                

                    }
                }

            }

        }


        echo json_encode($data);
        exit();
    }


}
