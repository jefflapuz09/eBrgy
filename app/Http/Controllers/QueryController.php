<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Voter;
use App\Resident;
use App\Blotter;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voter = Voter::where('isActive',1)->get();
        $male = Resident::where('isActive',1)->where('gender',1)->get();
        $female = Resident::where('isActive',1)->where('gender',2)->get();
        $file = Blotter::where('status',4)->get();
        $senior = DB::select(DB::raw('SELECT firstName,lastName,civilStatus,gender FROM `residents` where DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), "%Y")+0 >= 60'));
        return view('Query.index',compact('voter','male','female','file','senior'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
