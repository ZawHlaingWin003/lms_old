<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteAdministrationController extends Controller
{
    public function index() {
        return view('user.admin.site-administration');
    }
}
