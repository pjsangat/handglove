<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\FacilityModel;
use App\Models\ShiftsTimekeepingModel;
use App\Models\CliniciansModel;
use App\Models\ShiftsModel;

class Timekeeping extends BaseController
{
    public function index()
    {
        $session = session();
        $data['session'] = $session;
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        } else {
            if($session->get('facility_id') != 0){
                $facilityModel = new FacilityModel;
                $data['facility'] = $facilityModel->find($session->get('facility_id'));
                if(!$data['facility']){
                    return redirect()->to('/profile');
                }
            }

            $data['page'] = 'timekeeping';
            
            return view('components/header', array(
                'title' => 'Time Logs - Handglove',
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
            .view('facility/manage/timekeeping', $data)
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
                    ASSETS_URL . 'js/pages/facility_timekeeping.min.js',
                )
            ))
            .view('components/footer');
        }
    }

    public function list()
    {
        $session = session();
        if($session->get('isLoggedIn') != 1){
            return $this->response->setJSON(['data' => []]);
        }

        $facility_id = $session->get('facility_id');
        $model = new ShiftsTimekeepingModel();
        
        $logs = $model->select('tbl_shift_timekeeping.*, tbl_clinicians.name as clinician_name, tbl_shift_types.name as shift_type_name, tbl_client_units.name as unit_name, tbl_shifts.start_date as shift_start_date, tbl_shifts.shift_start_time, tbl_shifts.shift_end_time')
            ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_shift_timekeeping.clinician_id', 'inner')
            ->join('tbl_shifts', 'tbl_shifts.id = tbl_shift_timekeeping.shift_id', 'inner')
            ->join('tbl_shift_types', 'tbl_shift_types.id = tbl_shifts.shift_type', 'inner')
            ->join('tbl_client_units', 'tbl_client_units.id = tbl_shifts.unit_id', 'inner')
            ->where('tbl_shifts.client_id', $facility_id)
            ->orderBy('tbl_shift_timekeeping.punch_datetime', 'DESC')
            ->findAll();

        foreach($logs as &$log) {
            $log['punch_datetime'] = date('M d, Y h:i A', strtotime($log['punch_datetime']));
            $log['punch_type_label'] = ($log['punch_type'] == 10) ? '<span class="badge badge-success">Clock In</span>' : '<span class="badge badge-danger">Clock Out</span>';
            
            if (empty($log['reference']) && $log['punch_type'] == 20) {
                $log['punch_type_label'] = '<span class="badge badge-warning">Missed Punch Out</span>';
            }

            $log['shift_info'] = '<div>Shift #'.$log['shift_id'].'</div><div>'.date("M d, Y", strtotime($log['shift_start_date'])) . ' '.date("h:i A", strtotime($log['shift_start_time'])) . ' - ' . date("h:i A", strtotime($log['shift_end_time'])).'</div><div>'.$log['shift_type_name'] . ' - ' . $log['unit_name']. '</div>';
            
            $log['action'] = '<a href="'.base_url('facility/manage/timekeeping/view/'.$log['id']).'" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
        }

        return $this->response->setJSON(['data' => $logs]);
    }

    public function view($id)
    {
        $session = session();
        $data['session'] = $session;
        if( is_null($session->get('isLoggedIn')) || $session->get('isLoggedIn') != 1){
            return redirect()->to('/');
        }

        $model = new ShiftsTimekeepingModel();
        $punch = $model->select('tbl_shift_timekeeping.*, tbl_clinicians.name as clinician_name, tbl_clinicians.profile_pic_url, tbl_shift_types.name as shift_type_name, tbl_client_units.name as unit_name, tbl_shifts.start_date as shift_start_date, tbl_shifts.shift_start_time, tbl_shifts.shift_end_time, tbl_shifts.rate')
            ->join('tbl_clinicians', 'tbl_clinicians.id = tbl_shift_timekeeping.clinician_id', 'inner')
            ->join('tbl_shifts', 'tbl_shifts.id = tbl_shift_timekeeping.shift_id', 'inner')
            ->join('tbl_shift_types', 'tbl_shift_types.id = tbl_shifts.shift_type', 'inner')
            ->join('tbl_client_units', 'tbl_client_units.id = tbl_shifts.unit_id', 'inner')
            ->where('tbl_shift_timekeeping.id', $id)
            ->first();

        if (!$punch) {
            return redirect()->to('facility/manage/timekeeping');
        }

        // Fetch punches for this shift and clinician
        $data['clock_in'] = $model->where('shift_id', $punch['shift_id'])
            ->where('clinician_id', $punch['clinician_id'])
            ->where('punch_type', 10)
            ->first();

        $data['clock_out'] = $model->where('shift_id', $punch['shift_id'])
            ->where('clinician_id', $punch['clinician_id'])
            ->where('punch_type', 20)
            ->first();

        $data['punch'] = $punch;
        $data['page'] = 'timekeeping';

        // Status Logic
        if ($data['clock_out']) {
            $data['status_label'] = '<span class="badge badge-primary px-3 py-2">Completed</span>';
        } else {
            $data['status_label'] = '<span class="badge badge-success px-3 py-2">Ongoing</span>';
        }

        // Calculation
        $total_shift_time = "0:00";
        $payable_time = "0:00";
        if ($data['clock_in'] && $data['clock_out']) {
            $start = new \DateTime($data['clock_in']['punch_datetime']);
            $end = new \DateTime($data['clock_out']['punch_datetime']);
            $interval = $start->diff($end);
            
            $total_minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
            $hours = floor($total_minutes / 60);
            $minutes = $total_minutes % 60;
            
            $total_shift_time = sprintf('%d:%02d', $hours, $minutes);
            $payable_time = $total_shift_time; // Assuming no breaks for now
        }

        $data['total_shift_time'] = $total_shift_time;
        $data['payable_time'] = $payable_time;

        return view('components/header', array(
            'title' => 'Timesheet #'.$punch['shift_id'],
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
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/pages/facility_profile'
            ),
            'session' => $session
        ))
        .view('facility/manage/timekeeping_view', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js',
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
            )
        ))
        .view('components/footer');
    }
}
