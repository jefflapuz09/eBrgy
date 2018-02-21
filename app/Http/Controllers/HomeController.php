<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voter;
use App\Blotter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Blotter::where('isActive',1)->where('status',1)->get();
        $blotter = Blotter::where('isActive',1)->where('status',1)->get();
        $voter = Voter::where('isActive',1)->get();
        return view('in',compact('voter','blotter','post'));
    }

    public function error()
    {
        return view('errors.notauth');
    }

    public function error2()
    {
        return view('errors.notallowed');
    }
}
