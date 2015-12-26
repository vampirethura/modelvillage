<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Session;
class HomeController extends Controller
{
    protected $module = 'home';

    //constructor class
    public function __construct()
    {
        $this->middleware('auth'); #check user is authenticated/login
    }

    public function showHome(){
      return view('backend.common.template')
        ->with('content_title', 'Home')
        ->with('module', $this->module);
    }
}
