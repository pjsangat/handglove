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
use App\Models\NotificationsModel;
use App\Models\UserModel;
use \Datetime;
use CodeIgniter\Files\File;

class Jobs extends BaseController
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
            $objShiftsModel = new ShiftsModel;
            $objShiftTypes = new ShiftTypesModel;
            $shiftTypes = $objShiftTypes->where('status', 1)->findAll();

            $objUnits = new FacilityUnitsModel;
            $units = $objUnits->where('client_id', $session->get('facility_id'))->findAll();

            $data['page'] = 'jobs';
            $data['shiftTypes'] = $shiftTypes;
            $data['shiftTimes'] = $objShiftsModel->shift_time_range;
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
                    ASSETS_URL . 'js/pages/facility_jobs.min.js',
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

                    $objShiftsModel = new ShiftsModel;
                    $shift = $objShiftsModel->find($this->request->getPost('shiftID'));

                    if( !empty($shift)){
                        $validation =  \Config\Services::validation();
                        $rules = [];
                        $item = [];

                        if($this->request->getPost('shift_type') ){
                            $rules['shift_type'] = [
                                'label' => 'Shift Type',
                                'rules' => 'required',
                            ];
                            $item['shift_type'] = $this->request->getPost('shift_type');
                        }

                        if($this->request->getPost('rate')){
                            $rules['rate'] = [
                                'label' => 'Rate',
                                'rules' => 'required',
                            ];
                            $item['rate'] = $this->request->getPost('rate');
                        }

                        if($this->request->getPost('unit_id')){
                            $rules['unit_id'] =  [
                                'label' => 'Unit',
                                'rules' => 'required',
                            ];
                            $item['unit_id'] = $this->request->getPost('unit_id');
                        }

                        if($this->request->getPost('slots')){
                            $rules['slots'] =  [
                                'label' => 'Open Positions',
                                'rules' => 'required',
                            ];
                            $item['slots'] = $this->request->getPost('slots');
                        }

                        $status = 1;
                        if($this->request->getPost('status')){
                            $status = $this->request->getPost('status');
                        }

                        if(!empty($rules)){
                            if ($this->validate($rules)) {
                                $item['status'] = $status;
                                $objShiftsModel->update($shift['id'], $item);

                                $data['success'] = 1;
                                if($status == 100){
                                    $data['message'] = 'Shift has been cancelled';
                                }else{
                                    $data['message'] = 'Shift has been updated successfully.';
                                }
                            }else{
                                $data['message'] = $validation->getErrors();
                            }
                        }else{
                            $item['status'] = $status;
                            $objShiftsModel->update($shift['id'], $item);

                            $data['success'] = 1;
                            if($status == 100){
                                $data['message'] = 'Shift has been cancelled';
                            }else{
                                $data['message'] = 'Shift has been updated successfully.';
                            }
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
                    $validation =  \Config\Services::validation();
                    $rules = [
                        'shift_type' => [
                            'label' => 'Shift Type',
                            'rules' => 'required',
                        ],
                        'rate' => [
                            'label' => 'Rate',
                            'rules' => 'required',
                        ],
                        'unit_id' => [
                            'label' => 'Unit',
                            'rules' => 'required',
                        ],
                        'date' => [
                            'label' => 'Shift Date',
                            'rules' => 'required',
                        ],
                        'time' => [
                            'label' => 'Shift Time',
                            'rules' => 'required',
                        ],
                        'slots' => [
                            'label' => 'Open Positions',
                            'rules' => 'required',
                        ],
                    ];
                    if ($this->validate($rules)) {
                        $shift_time = explode(" - ", $this->request->getPost('time'));


                        $objShiftsModel = new ShiftsModel;
                        $item = [
                            'client_id' => $session->get('facility_id'),
                            'shift_type' => $this->request->getPost('shift_type'),
                            'rate' => $this->request->getPost('rate'),
                            'slots' => $this->request->getPost('slots'),
                            'unit_id' => $this->request->getPost('unit_id'),
                            'start_date' => $this->request->getPost('date'),
                            'status' => 1
                        ];
                        $shift_time = explode(" - ", $this->request->getPost('time'));
                        $item['shift_start_time'] = date("H:i:s", strtotime($shift_time[0]));
                        $item['shift_end_time'] = date("H:i:s", strtotime($shift_time[1]));

                        $id = $objShiftsModel->save($item);
                        if($id){
                            $data['message'] = 'Shift successfully added';
                            $data['success'] = 1;
                        }else{
                            $data['message'][] = "Error adding shift. Please try again later.";
                        }
                    }else{
                        $data['message'] = $validation->getErrors();
                    }

                        // $facilityModel = new FacilityModel;
                        // $data['facility'] = $facilityModel->find($session->get('facility_id'));
                        // if($data['facility']){
                        //     $unitsModel = new FacilityUnitsModel;

                        //     $item = [
                        //         'client_id' => $session->get('facility_id'),
                        //         'name' => $_POST['name'],
                        //         'description' => $_POST['description'],
                        //     ];

                        //     $unitsModel->save($item);

                        //     $data['success'] = 1;
                        //     $data['message'] = 'Unit successfully added to the database.';
                        // }
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
                    
                        $objShiftsModel = new ShiftsModel;
                        $builder = $objShiftsModel
                                    ->select('tbl_shifts.*, tbl_shift_types.name as type_name, tbl_client_units.name as unit_name, (SELECT count(tbl_client_shift_requests.id) FROM tbl_client_shift_requests WHERE tbl_client_shift_requests.client_id = tbl_shifts.client_id AND tbl_client_shift_requests.shift_id = tbl_shifts.id) as applicants, (SELECT count(tbl_client_shift_requests.id) FROM tbl_client_shift_requests WHERE tbl_client_shift_requests.client_id = tbl_shifts.client_id AND tbl_client_shift_requests.shift_id = tbl_shifts.id AND status = 20) as accepted')
                                    ->join('tbl_client_units', 'tbl_client_units.id = tbl_shifts.unit_id', 'inner')
                                    ->join('tbl_shift_types', 'tbl_shift_types.id = tbl_shifts.shift_type', 'inner')
                                    ->where('tbl_shifts.client_id', $session->get('facility_id'))
                                    ->where('tbl_shifts.start_date', $this->request->getPost('date'));

                        if($this->request->getPost('time') == 'am'){
                            $builder->where('tbl_shifts.shift_start_time', '07:00:00');
                        }else if($this->request->getPost('time') == 'pm'){
                            $builder->groupStart();
                                $builder->where('tbl_shifts.shift_start_time', '15:00:00');
                                $builder->orWhere('tbl_shifts.shift_start_time', '21:00:00');
                            $builder->groupEnd();
                        }else if($this->request->getPost('time') == 'eve'){
                            $builder->where('tbl_shifts.shift_start_time', '23:00:00');
                        }
                        $units = $builder->findAll();

                        $data['data'] = [];
                        $data['success'] = 1;
                        $data['message'] = '';

                        $objShiftRequests = new ShiftRequestsModel;

                        foreach($units as $unit){
                            $unit['requests'] = $objShiftRequests
                                                        ->select('tbl_clinicians.name as clinician_name')
                                                        ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_client_shift_requests.clinician_id', 'INNER')
                                                        ->whereIn('tbl_client_shift_requests.status', [10, 15])
                                                        ->where('tbl_client_shift_requests.shift_id', $unit['id'])
                                                        ->findAll();

                            $unit['accepted_arr'] = $objShiftRequests
                                                        ->select('tbl_clinicians.name as clinician_name')
                                                        ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_client_shift_requests.clinician_id', 'INNER')
                                                        ->where('tbl_client_shift_requests.status', 20)
                                                        ->where('tbl_client_shift_requests.shift_id', $unit['id'])
                                                        ->findAll();

                            $item = [
                                'name' => view('facility/_shift_view', $unit),
                                'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$unit['id'].'" data-type="'.$unit['shift_type'].'" class="request-clinician-table btn btn-blue pl-2 pr-2 pt-1 pb-1" title="Request for Clinicians"><i class="fa fa-users"></i> Request Clinicians</a></div>'
                            ];

                            if($unit['status'] == 100){
                                $item['action'] = '<div class="alert alert-danger text-center" role="alert">Cancelled</div>';
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


    public function requests_list(){
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
                        $objShiftRequests = new ShiftRequestsModel;
                        $clinicianModel = new CliniciansModel;

                        $requests = $objShiftRequests
                                        ->select('tbl_clinicians.*, tbl_clinician_types.name as type_name, tbl_client_shift_requests.*')
                                        ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_client_shift_requests.clinician_id', 'INNER')
                                        ->join('tbl_clinician_types', 'tbl_clinician_types.id = tbl_clinicians.type', 'inner')
                                        ->where('tbl_client_shift_requests.shift_id', $this->request->getVar('shift'))
                                        ->findAll();
                        $data['data'] = [];
                        $data['success'] = 1;
                        $data['message'] = '';
                        foreach($requests as $request){
                            $item = [
                                'details' => '<div><strong>'.$request['name'].'</strong><br>'.$request['email'].'<br>'.$request['contact_number'].'</div>',
                                'type' => $request['type_name'],
                                'level' => $clinicianModel->tier_mapping[$request['tier']],
                            ];

                            if($request['status'] == 15){
                                $item['action'] = '<div class="text-center"><a href="javascript:;" data-shift-id="'.$this->request->getVar('shift').'" data-id="'.$request['clinician_id'].'" data-value="20" class="respond-request btn thm-btn pl-2 pr-2 pt-1 pb-1" title=""><i class="fa fa-plust"></i> Accept</a> <a href="javascript:;" data-shift-id="'.$this->request->getVar('shift').'" data-id="'.$request['clinician_id'].'" data-value="100" class="respond-request btn btn-danger pl-2 pr-2 pt-1 pb-1" title=""><i class="fa fa-plust"></i> Decline</a></div>';
                            }else{
                                $item['action'] = '<div class="text-center">'.$objShiftRequests->status_mapping_facility_pov[$request['status']].'</div>';
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

    public function request(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){

                    $facilityModel = new FacilityModel;
                    $facility = $facilityModel->find($session->get('facility_id'));

                    if($facility){
                        $objShiftsModel = new ShiftsModel;
                        $shift = $objShiftsModel->find($this->request->getPost('shiftID'));
                        
                        $objShiftRequest = new ShiftRequestsModel;

                        $applied = $objShiftRequest
                                    ->where('client_id', $session->get('facility_id'))
                                    ->where('shift_id', $this->request->getPost('shiftID'))
                                    ->where('status', 20)
                                    ->get()->getNumRows();

                        if($applied < $shift['slots']){
                            $item = [
                                'client_id' => $session->get('facility_id'),
                                'shift_id' => $this->request->getPost('shiftID'),
                                'clinician_id' => $this->request->getPost('clinicianID'),
                                'status' => 10
                            ];

                            $id = $objShiftRequest->save($item);

                            $notificationsModel = new NotificationsModel();
                            $notificationsModel->createNotification($session->get('facility_id'), $this->request->getPost('clinicianID'), 'shift_request', $id);

                            $data['message'] = 'Successfully sent a request to clinician';
                            $data['success'] = 1;

                        }else{
                            $data['error'][] = 'You reached the maximum slots allowed for this shift.';
                        }
                    }
                }
            }
        }

        echo json_encode($data);
        exit();
    }

    public function respond_to_application(){
        $data = [
            'success' => 0, 
            'message' => 'Invalid requests.'
        ];

        $session = session();
        if( $session->get('isLoggedIn') == 1){
            if($this->request->isAJAX()){
                if($session->get('facility_id') != 0){

                    $facilityModel = new FacilityModel;
                    $facility = $facilityModel->find($session->get('facility_id'));

                    if($facility){
                        $objShiftsModel = new ShiftsModel;
                        $shift = $objShiftsModel->find($this->request->getPost('shiftID'));
                        if(!empty($shift)){
                            $objShiftRequest = new ShiftRequestsModel;

                            $applied = $objShiftRequest
                                        ->where('client_id', $session->get('facility_id'))
                                        ->where('shift_id', $this->request->getPost('shiftID'))
                                        ->where('status', 20)
                                        ->get()->getNumRows();

                            if($applied < $shift['slots']){
                                
                                
                                $objShiftRequest->set(['status' => $this->request->getPost('status')])
                                    ->where('shift_id', $shift['id'])
                                    ->where('clinician_id', $this->request->getPost('clinicianID'))
                                    ->update();


                                $objShiftClinicians = new ShiftCliniciansModel;



                                $data['shift'] = $shift;
                                if($this->request->getPost('status') == 20){
                                    $notificationsModel = new NotificationsModel();
                                    $notificationsModel->createNotification($session->get('facility_id'), $this->request->getPost('clinicianID'), 'approval', $shift['id']);
                                    
                                    $data['message'] = 'Application accepted successfully.';

                                    $item = [
                                        'client_id' => $session->get('facility_id'),
                                        'shift_id' => $this->request->getPost('shiftID'),
                                        'clinician_id' => $this->request->getPost('clinicianID'),
                                        'status' => 10,
                                        'pcc_status' => 10
                                    ];
                                    $objShiftClinicians->save($item);
                                    
                                }else{
                                    $data['message'] = 'Application declined successfully.';
                                }

                                $data['success'] = 1;

                            }else{
                                $data['message'][] = 'You reached the maximum slots allowed for this shift.';
                            }
                        }
                    }
                }
            }
        }

        echo json_encode($data);
        exit();
    }

}
