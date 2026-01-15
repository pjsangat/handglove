<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\CliniciansModel;
use App\Models\UserModel;
use App\Models\FacilityModel;
use App\Models\FacilityVotesModel;
use App\Models\FacilityVoteDetailsModel;
use \Datetime;
use CodeIgniter\Files\File;

class Votes extends BaseController
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
            $objClinicians = new CliniciansModel;
            $data['clinicians'] = $objClinicians->where('client_id', $session->get('facility_id'))->findAll();
            $data['page'] = 'votes';
            
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
                    ASSETS_URL . 'js/pages/facility_votes.min.js',
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
                        $votesModel = new FacilityVotesModel;
                        $votes = $votesModel
                                    ->where('client_id', $session->get('facility_id'))
                                    ->findAll();

                        $data['data'] = [];
                        $data['success'] = 1;
                        $data['message'] = '';
                        foreach($votes as $vote){
                            $item = [
                                'name' => '<div><strong>'.date("M d, Y", strtotime($vote['voting_start_date'])).' - ' .date("M d, Y", strtotime($vote['voting_end_date'])). '</strong></div>',
                                'description' => $vote['description'],
                                'action' => '<div class="text-center"><a href="javascript:;" data-id="'.$vote['id'].'" class="view-unit btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View voting"><i class="fa fa-search"></i> View Results</a></div>'
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
                        $votesModel = new FacilityVotesModel;
                        $voteDetailsModel = new FacilityVoteDetailsModel;

                        // $unitsModel = new FacilityUnitsModel;

                        $item = [
                            'client_id' => $session->get('facility_id'),
                            'voting_start_date' => $this->request->getPost('voting_start_date'),
                            'voting_end_date' => $this->request->getPost('voting_end_date'),
                            'description' => $_POST['description'],
                            'status' => 10
                        ];

                        $id = $votesModel->save($item);
                        $voteID = $votesModel->getInsertID();
                        if($voteID){

                            $clinicians = $this->request->getPost('clincian');
                            foreach($clinicians as $clinician_id){
                                $item = [
                                    'voting_id' => $voteID,
                                    'clinician_id' => $clinician_id
                                ];
                                $voteDetailsModel->save($item);
                            }

                            $data['success'] = 1;
                            $data['message'] = 'Unit successfully added to the database.';
                        }else{
                            $data['error'][] = 'Unable to save. Please try again later';
                        }
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
                    $votesModel = new FacilityVotesModel;
                    $voteDetailsModel = new FacilityVoteDetailsModel;
                    $unit = $votesModel->find($unitID);
                    $unit['start_date'] = date("M d, Y", strtotime($unit['voting_start_date']));
                    $unit['end_date'] = date("M d, Y", strtotime($unit['voting_end_date']));
                    $unit['details'] = $voteDetailsModel->where('voting_id', $unit['id'])->findAll();

                    if(!empty($unit['details'])){
                        $clinModel = new CliniciansModel;
                        $total_votes = 0;
                        foreach($unit['details'] as $ctr => $detail){
                            $total_votes += $detail['votes'];
                            $unit['details'][$ctr]['clinician_details'] = $clinModel->find($detail['clinician_id']);
                        }
                        $unit['total_votes'] = $total_votes;

                        foreach($unit['details'] as $ctr => $detail){
                            $unit['details'][$ctr]['vote_percentage'] = ($detail['votes'] / $total_votes) * 100;
                        }
                    }

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
