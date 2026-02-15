<?php

namespace App\Controllers\Admin;
 
use App\Controllers\BaseController;
 
class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];
        $data['page_title'] = "Admin Dashboard";
        
        return view('admin/dashboard', $data);
    }
}
