<?php

namespace App\Controllers;

use App\Models\DonorsModel;

class Donors extends BaseController
{
    public function index()
    {
        $model = new DonorsModel();
        $donors = $model->orderBy('id', 'ASC')->findAll();

        return view('components/header', array(
            'title' => 'Donors & Sponsors | Handglove',
            'description' => 'Meet our generous Donors and Sponsors.',
            'url' => base_url('donors'),
            'keywords' => 'donors, sponsors, handglove, healthcare',
            'meta' => array(
                'title' => 'Donors & Sponsors | Handglove',
                'description' => 'Meet our generous Donors and Sponsors.',
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
        .view('pages/donors', ['donors' => $donors])
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
