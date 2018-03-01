<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use App\Blotter;
use App\Business;
use App\Schedule;
use App\Resident;
use App\parentModel;
use App\Voter;
use DB;
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
        $post = Resident::where('isActive',1)->where('isRegistered',1)->get();
        return view('Resident.index',compact('post'));
    }

    public function index2()
    {
        $post = Resident::where('isActive',1)->where('isRegistered',0)->get();
        return view('Non-resident.index',compact('post'));
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

    public function create2()
    {
        return view('Non-resident.create');
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
            'firstName' => ['required','max:70','unique:residents', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'tinNo' => 'nullable|max:50',
            'periodResidence' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable','regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'tinNo' => 'Tin No.',
            'periodResidence' => 'Period of Residence',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            try 
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
                    'image' => $pic,
                    'contactNumber' => $request->contactNumber,
                    'created_at' => $request->created_at
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

                if($request->filled('voterId'))
                {
                    Voter::create([
                        'residentId' => $resident->id,
                        'voterId' => $request->voterId,
                        'precintNo' => $request->precintNo
                    ]);
                }
          
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            

            return redirect('/Resident')->withSuccess('Successfully inserted into the database.');
        }
    }


    public function notResident(Request $request)
    {
        $rules = [
            'firstName' => ['required','max:70','unique:residents', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'tinNo' => 'nullable|max:50',
            'periodResidence' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable','regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'tinNo' => 'Tin No.',
            'periodResidence' => 'Period of Residence',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            try
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
                    'image' => $pic,
                    'isRegistered' => 0,
                    'contactNumber' => $request->contactNumber,
                    'created_at' => $request->created_at
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

                if($request->filled('voterId'))
                {
                Voter::create([
                    'residentId' => $resident->id,
                    'voterId' => $request->voterId,
                    'precintNo' => $request->precintNo
                ]);
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Resident/NotResident')->withSuccess('Successfully inserted into the database.');
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


    public function edit2($id)
    {
        $post = Resident::find($id);
        return view('Non-resident.update',compact('post'));
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
            'firstName' => ['required','max:70',Rule::unique('residents')->ignore($id), 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'tinNo' => 'nullable|max:50',
            'periodResidence' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable','regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'tinNo' => 'Tin No.',
            'periodResidence' => 'Period of Residence',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            try
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

                $resident = Resident::find($id)->update([
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
                    'image' => $pic,
                    'created_at' => $request->created_at
                ]);

                $chkVoter = DB::table('residents as r')
                ->join('voters as v','v.residentId','r.id')
                ->select('r.*')
                ->where('r.id',$id)
                ->get();

                $chkParent = DB::table('residents as r')
                ->join('parents as p','p.residentId','r.id')
                ->select('r.*')
                ->where('r.id',$id)
                ->get();

                if(count($chkParent)!=0)
                {
                    parentModel::find($request->parentid)->updateOrCreate([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }

                if(count($chkParent)==0)
                {
                    parentModel::create([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }
                
                if($request->filled('voterId'))
                {
                    if(count($chkVoter) == 0)
                    {
                        Voter::create([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }

                    if(count($chkVoter) != 0)
                    {
                        Voter::find($request->vId)->updateOrCreate([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Resident')->withSuccess('Successfully updated into the database.');
        }
    }


    public function update2(Request $request, $id)
    {
        $rules = [
            'firstName' => ['required','max:70',Rule::unique('residents')->ignore($id), 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable','max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required','max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'tinNo' => 'nullable|max:50',
            'periodResidence' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable','regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'tinNo' => 'Tin No.',
            'periodResidence' => 'Period of Residence',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            try
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
                    'image' => $pic,
                    'created_at' => $request->created_at
                ]);

                $chkVoter = DB::table('residents as r')
                ->join('voters as v','v.residentId','r.id')
                ->select('r.*')
                ->where('r.id',$id)
                ->get();

                $chkParent = DB::table('residents as r')
                ->join('parents as p','p.residentId','r.id')
                ->select('r.*')
                ->where('r.id',$id)
                ->get();

                if(count($chkParent)!=0)
                {
                    parentModel::find($request->parentid)->updateOrCreate([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }
                
                if(count($chkParent)==0)
                {
                    parentModel::create([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }
                
                if($request->filled('voterId'))
                {
                    if(count($chkVoter) == 0)
                    {
                        Voter::create([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }

                    if(count($chkVoter) != 0)
                    {
                        Voter::find($request->vId)->updateOrCreate([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Resident/NotResident')->withSuccess('Successfully updated into the database.');
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

    public function destroy2($id)
    {

        Resident::find($id)->update(['isActive' => 0]);
            return redirect('/Resident/NotResident');    
    }

    public function soft2()
    {
        $post = Resident::where('isActive',0)->get();
        return view('Non-resident.soft',compact('post'));
    }

    public function reactivate2($id)
    {
        Resident::find($id)->update(['isActive' => 1]);
        return redirect('/Resident/NotResident');
    }

    public function remove($id)
    {
        $post = Resident::find($id);

        $chkHousehold = Inhabitant::where('residentId',$id)->get();
        $chkBlotter = Blotter::where('complainant',$id)->orWhere('complainedResident', $id)->get();
        $chkBusiness = Business::where('residentId',$id)->get();
        $chkSchedule = Schedule::where('residentId',$id)->get();

        if(count($chkHousehold) > 0 || count($chkBlotter) > 0 || count($chkBusiness) > 0 || count($chkSchedule) > 0)
        {
            return redirect('/Resident')->withError('It seems that the record is still being used in other items. Deletion failed.');
        }
        else
        {
            if(count($post->Parents)!=0)
            {
                $parent = parentModel::where('residentId',$post->id)->first();
                $parent->delete();
            }
    
            if(count($post->Voter)!=0)
            {
                $voter = Voter::where('residentId',$post->id)->first();
                $voter->delete();
            }
    
            $post->delete();
            return redirect('/Resident/Soft');
        }
    }

    public function remove2($id)
    {
        $post = Resident::find($id);

        if(count($post->Parents)!=0)
        {
            $parent = parentModel::where('residentId',$post->id)->first();
            $parent->delete();
        }

        if(count($post->Voter)!=0)
        {
            $voter = Voter::where('residentId',$post->id)->first();
            $voter->delete();
        }

        $post->delete();
        return redirect('/Resident/NotResident/Soft');
    }
}
