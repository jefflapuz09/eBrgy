<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Resident;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Business::where('isActive',1)->get();
        return view('Business.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::where('isActive',1)->get();
        return view('Business.create',compact('resident'));
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
            'name' => ['required','unique:businesses','max:150'],
            'residentId' => 'required',
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'description' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Business Name',
            'residentId' => 'Owner',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Business::create($request->all());

            return redirect('/Business')->withSuccess('Successfully inserted into the database');
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
        $resident = Resident::where('isActive',1)->get();
        $post = Business::find($id);
        return view('Business.update',compact('resident','post'));
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
        $rules = [
            'name' => ['required',Rule::unique('businesses')->ignore($id),'max:150'],
            'residentId' => 'required',
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'description' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Business Name',
            'residentId' => 'Owner',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Business::find($id)->update($request->all());

            return redirect('/Business')->withSuccess('Successfully updated into the database');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Business::find($id)->update(['isActive' => 0]);
            return redirect('/Business');    
    }

    public function soft()
    {
        $post = Business::where('isActive',0)->get();
        return view('Business.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Business::find($id)->update(['isActive' => 1]);
        return redirect('/Business');
    }
}
