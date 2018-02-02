<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\parentModel;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class residentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Resident::where('isActive',1)->get();
        return view('Resident.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Resident.create');
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
            'firstName' => ['required','max:50','unique:residents', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required',
            'brgy' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'province' => 'nullable',
            'citizenship' => 'required',
            'religion' => 'required',
            'birthdate' => 'required',
            'birthPlace' => 'required',
            'civilStatus' => 'required',
            'occupation' => 'nullable',
            'tinNo' => 'nullable',
            'periodResidence' => 'required',
            'image' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Service Category',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $file = $request->file('image');
            $pic = "";
            if($file == '' || $file == null){
                $pic = "img/steve.jpg";
            }else{
                $date = date("Ymdhis");
                $extension = $request->file('image')->getClientOriginalExtension();
                $pic = "img/".$date.'.'.$extension;
                $request->file('image')->move("img",$pic);    
                // $request->file('photo')->move(public_path("/uploads"), $newfilename);
            }

            $resident = Resident::create([
                'firstName' => $request->firstName,
                'middleName' => $request->middleName,
                'lastName' => $request->lastName,
                'street' => $request->street,
                'brgy' => $request->brgy,
                'city' => $request->city,
                'gender' => $request->gender,
                'province' => $request->province,
                'citizenship' => $request->citizenship,
                'religion' => $request->religion,
                'birthdate' => $request->birthdate,
                'birthPlace' => $request->birthPlace,
                'civilStatus' => $request->civilStatus,
                'occupation' => $request->occupation,
                'tinNo' => $request->tinNo,
                'periodResidence' => $request->periodResidence,
                'image' => $pic
            ]);

            parentModel::create([
                'residentId' => $resident->id,
                'motherFirstName' => $request->motherFirstName,
                'motherMiddleName' => $request->motherMiddleName,
                'motherLastName' => $request->motherLastName,
                'fatherFirstName' => $request->fatherFirstName,
                'fatherMiddleName' => $request->fatherMiddleName,
                'fatherLastName' => $request->fatherLastName,
            ]);

            return redirect('/Resident')->withSuccess('Successfully inserted into the database.');
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
        $post = Resident::find($id);
        return view('Resident.update',compact('post'));
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
            'firstName' => ['required','max:50',Rule::unique('residents')->ignore($id), 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required',
            'brgy' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'province' => 'nullable',
            'citizenship' => 'required',
            'religion' => 'required',
            'birthdate' => 'required',
            'birthPlace' => 'required',
            'civilStatus' => 'required',
            'occupation' => 'nullable',
            'tinNo' => 'nullable',
            'periodResidence' => 'required',
            'image' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Service Category',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $file = $request->file('image');
            $pic = "";
            if($file == '' || $file == null){
                $nullpic = Resident::find($id);
                $pic = $nullpic->image;
            }else{
                $date = date("Ymdhis");
                $extension = $request->file('image')->getClientOriginalExtension();
                $pic = "img/".$date.'.'.$extension;
                $request->file('image')->move("img",$pic);    
                // $request->file('photo')->move(public_path("/uploads"), $newfilename);
            }

            Resident::find($id)->update([
                'firstName' => $request->firstName,
                'middleName' => $request->middleName,
                'lastName' => $request->lastName,
                'street' => $request->street,
                'brgy' => $request->brgy,
                'city' => $request->city,
                'gender' => $request->gender,
                'province' => $request->province,
                'citizenship' => $request->citizenship,
                'religion' => $request->religion,
                'birthdate' => $request->birthdate,
                'birthPlace' => $request->birthPlace,
                'civilStatus' => $request->civilStatus,
                'occupation' => $request->occupation,
                'tinNo' => $request->tinNo,
                'periodResidence' => $request->periodResidence,
                'image' => $pic
            ]);

            parentModel::find($request->parentid)->update([
                'residentId' => $request->residentId,
                'motherFirstName' => $request->motherFirstName,
                'motherMiddleName' => $request->motherMiddleName,
                'motherLastName' => $request->motherLastName,
                'fatherFirstName' => $request->fatherFirstName,
                'fatherMiddleName' => $request->fatherMiddleName,
                'fatherLastName' => $request->fatherLastName,
            ]);

            return redirect('/Resident')->withSuccess('Successfully updated into the database.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        Resident::find($id)->update(['isActive' => 0]);
            return redirect('/Resident');    
    }

    public function soft()
    {
        $post = Resident::where('isActive',0)->get();
        return view('Resident.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Resident::find($id)->update(['isActive' => 1]);
        return redirect('/Resident');
    }
}
