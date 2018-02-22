<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voter;
use App\Blotter;
use App\Resident;
use App\Business;
use Carbon\Carbon;

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
        $male = Resident::where('isActive',1)->where('gender',1)->get();
        $female = Resident::where('isActive',1)->where('gender',2)->get();
        $record = Resident::where('isActive',1)->where('isDerogatory',0)->get();
        $business = Business::where('isActive',1)->get();
        $po = Resident::where('isActive',1)->get();

        //case
        
        return view('in',compact('voter','blotter','post','male','female','record','business','po'));
    }

    public function month()
    {
        $jan = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','01')->get());
        $feb = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','02')->get());
        $mar = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','03')->get());
        $apr = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','04')->get());
        $may = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','05')->get());
        $jun = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','06')->get());
        $jul = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','07')->get());
        $aug = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','08')->get());
        $sep = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','09')->get());
        $oct = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','10')->get());
        $nov = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','11')->get());
        $dec = count(Blotter::whereYear('created_at','=' ,date('Y'))->whereMonth('created_at','=','12')->get());
        return Response()->json(['jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aug'=>$aug,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec]);
       // return Response()->json(['data'=>$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec);
  
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
