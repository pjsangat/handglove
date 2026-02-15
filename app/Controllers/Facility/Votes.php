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
    protected $clinicianModel;
    protected $userModel;
    protected $facilityModel;
    protected $votesModel;
    protected $voteDetailsModel;
    protected $session;

    public function __construct()
    {
        $this->clinicianModel = new CliniciansModel();
        $this->userModel = new UserModel();
        $this->facilityModel = new FacilityModel();
        $this->votesModel = new FacilityVotesModel();
        $this->voteDetailsModel = new FacilityVoteDetailsModel();
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
            'clinicians' => $this->clinicianModel->where('client_id', $this->session->get('facility_id'))->findAll(),
            'page' => 'votes'
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
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-datepicker',
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
                'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.2/datatables.min.js',
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-datepicker.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/plugins/toastr.min.js',
                ASSETS_URL . 'js/pages/facility_votes.min.js',
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

        $votes = $this->votesModel->where('client_id', $facilityId)->findAll();
        $formattedData = [];

        foreach ($votes as $vote) {
            $formattedData[] = [
                'name' => sprintf(
                    '<div><strong>%s - %s</strong></div>',
                    date("M d, Y", strtotime($vote['voting_start_date'])),
                    date("M d, Y", strtotime($vote['voting_end_date']))
                ),
                'description' => $vote['description'],
                'action' => sprintf(
                    '<div class="text-center"><a href="javascript:;" data-id="%s" class="view-unit btn btn-yellow pl-2 pr-2 pt-1 pb-1" title="View Results"><i class="fa fa-search"></i> View Results</a></div>',
                    $vote['id']
                )
            ];
        }

        return $this->response->setJSON([
            'success' => 1,
            'message' => '',
            'data' => $formattedData
        ]);
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

        $rules = [
            'voting_start_date' => [
                'label' => 'Voting Start Date',
                'rules' => 'required'
            ],
            'voting_end_date' => [
                'label' => 'Voting End Date',
                'rules' => 'required'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => 0,
                'message_header' => 'Votes',
                'message' => implode('<br>', $this->validator->getErrors())
            ]);
        }

        $item = [
            'client_id' => $facilityId,
            'voting_start_date' => $this->request->getPost('voting_start_date'),
            'voting_end_date' => $this->request->getPost('voting_end_date'),
            'description' => $this->request->getPost('description'),
            'status' => 10
        ];

        if ($this->votesModel->save($item)) {
            $voteId = $this->votesModel->getInsertID();
            $clinicians = $this->request->getPost('clincian') ?: [];

            foreach ($clinicians as $clinicianId) {
                $this->voteDetailsModel->save([
                    'voting_id' => $voteId,
                    'clinician_id' => $clinicianId
                ]);
            }

            return $this->response->setJSON([
                'success' => 1,
                'message_header' => 'Votes',
                'message' => 'Vote session successfully created.'
            ]);
        }

        return $this->response->setJSON([
            'success' => 0,
            'message_header' => 'Votes',
            'message' => 'Unable to save. Please try again later.'
        ]);
    }

    public function update()
    {
        // Logic seems similar to Units or placeholder, keeping it minimal as in original
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        return $this->response->setJSON(['success' => 0, 'message' => 'Update functionality not fully implemented.']);
    }

    public function get()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Invalid request.']);
        }

        $voteId = $this->request->getPost('unitID'); // unitID used in original
        if (!$voteId) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Missing parameter.']);
        }

        $vote = $this->votesModel->find($voteId);
        if (!$vote) {
            return $this->response->setJSON(['success' => 0, 'message' => 'Record not found.']);
        }

        $vote['start_date'] = date("M d, Y", strtotime($vote['voting_start_date']));
        $vote['end_date'] = date("M d, Y", strtotime($vote['voting_end_date']));
        $vote['details'] = $this->voteDetailsModel->where('voting_id', $vote['id'])->findAll();

        if (!empty($vote['details'])) {
            $totalVotes = 0;
            foreach ($vote['details'] as &$detail) {
                $totalVotes += $detail['votes'];
                $detail['clinician_details'] = $this->clinicianModel->find($detail['clinician_id']);
            }
            unset($detail);

            $vote['total_votes'] = $totalVotes;

            foreach ($vote['details'] as &$detail) {
                $detail['vote_percentage'] = $totalVotes > 0 ? ($detail['votes'] / $totalVotes) * 100 : 0;
            }
            unset($detail);
        }

        return $this->response->setJSON([
            'success' => 1,
            'message' => '',
            'unit' => $vote // returning as 'unit' to match original key
        ]);
    }
}
