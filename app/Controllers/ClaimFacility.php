<?php

namespace App\Controllers;

class ClaimFacility extends BaseController
{
    public function index()
    {
        return view('components/header', array(
            'title' => 'Claim Your Facility | Handglove',
            'description' => 'Stand out with a free Business Profile on Handglove.',
            'url' => base_url('claim-facility'),
            'keywords' => 'claim facility, business profile, handglove, healthcare',
            'meta' => array(
                'title' => 'Claim Your Facility | Handglove',
                'description' => 'Stand out with a free Business Profile on Handglove.',
                'image' => base_url('assets/img/handglove-logo.png')
            ),
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/pages'
            )
        ))
        .view('pages/claim_facility')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-4.5.2/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
            )
        ))
        .view('components/footer');
    }
}
