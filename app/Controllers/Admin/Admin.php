<?php

namespace App\Controllers\Admin;
 
use App\Controllers\BaseController;
 
class Admin extends BaseController
{
    
    public function index(){
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        return redirect()->to('/admin/dashboard');
    }

}
