<?php
namespace App\Controllers\Facility;
use App\Controllers\BaseController;

use App\Models\CliniciansModel;
use App\Models\CredentialTypesModel;
use App\Models\ClinicianCredentialsModel;
use App\Models\UserModel;
use App\Models\FacilityModel;
use \Datetime;
use CodeIgniter\Files\File;

class Users extends BaseController
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
            $data['page'] = 'users';
            
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

}
