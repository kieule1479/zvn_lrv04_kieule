<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    //======== __CONSTRUCT =========
    public function __construct()
    {
        $this->pathViewController = 'admin.dashboard.';
        $this->controllerName     = 'dashboard';
        view()->share('controllerName', $this->controllerName);
    }

    // public function index()
    // {
    //     return view($this->pathViewController .  'index', [

    //     ]);
    // }


}

