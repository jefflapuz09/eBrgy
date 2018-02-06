<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Resident;
use App\Officer;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Schedule::where('isActive',1)->get();
        $resident = Resident::where('isActive',1)->get();
        $officer = Officer::where('isActive',1)->get();
        return view('Schedule.index',compact('post','resident','officer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $resident = Resident::where('isActive',1)->get();
        // return view('Schedule.create',compact('resident'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'residentId' => ['required'],
            'officerId' => 'required',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'residentId' => 'Resident',
            'officerId' => 'Person-in-Charge',
            'date' => 'Date',
            'start' => 'Time Started',
            'end' => 'Time Ended',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Schedule::create([
                'residentId' => $request->residentId,
                'officerId' => $request->officerId,
                'date' => $request->date,
                'start' => $request->start,
                'end' => $request->end
            ]);

            return redirect('/Schedule')->withSuccess('Successfully inserted into the database.');
        }
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

        Schedule::find($id)->update(['isActive' => 0]);
            return redirect('/Schedule');    
    }

    public function soft()
    {
        $post = Schedule::where('isActive',0)->get();
        return view('Schedule.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Schedule::find($id)->update(['isActive' => 1]);
        return redirect('/Schedule');
    }
}
