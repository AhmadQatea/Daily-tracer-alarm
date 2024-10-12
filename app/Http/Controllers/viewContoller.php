<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewContoller extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create']);
    }

    public function index(){
        return view('pages.home');
    }
    public function feature(){
        return view('pages.feature');
    }
    public function pricing(){
        return view('pages.pricing');
    }
    public function create(){
        return view('pages.create');
    }
}
