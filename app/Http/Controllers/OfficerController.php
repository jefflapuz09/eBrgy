<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Officer;
use App\Resident;
use App\User;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $post = Officer::where('isActive',1)->get();
        return view('Officer.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::where('isActive',1)->get();
       return view('Officer.create',compact('resident'));
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
            'residentId' => ['required','unique:officers'],
            'position' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'conpassword' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'residentId' => 'Resident',
            'position' => 'Position',
            'email' => 'Email Address',
            'password' => 'Password',
            'conpassword' => 'Password Confirmation',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            if($request->password && $request->conpassword)
            {
                try
                {
                    $officer = Officer::create([
                        'residentId' => $request->residentId,
                        'position' => $request->position,
                        'userRole' => 2
                    ]);
        
                    User::create([
                        'officerId' => $officer->id,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'userRole' => 2
                    ]);
                }
                catch(\Illuminate\Database\QueryException $e){
                    DB::rollBack();
                    $errMess = $e->getMessage();
                    return Redirect::back()->withErrors($errMess);
                }
                return redirect('/Officer')->withSuccess('Successfully inserted into the database.');
            }
            else
            {
                return Redirect::back()->withErrors('The password does not match');
            }
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
        $post = Officer::with('User')->find($id);
        return view('Officer.update',compact('resident','post'));
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
            'residentId' => ['required',Rule::unique('officers')->ignore($id)],
            'position' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'conpassword' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'residentId' => 'Resident',
            'position' => 'Position',
            'email' => 'Email Address',
            'password' => 'Password',
            'conpassword' => 'Password Confirmation',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            if($request->password && $request->conpassword)
            {
                try
                {
                    $officer = Officer::find($id)->update([
                        'residentId' => $request->residentId,
                        'position' => $request->position
                    ]);
        
                    User::find($request->userId)->update([
                        'officerId' => $request->officerId,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'userRole' => 2
                    ]);
                }
                catch(\Illuminate\Database\QueryException $e){
                    DB::rollBack();
                    $errMess = $e->getMessage();
                    return Redirect::back()->withErrors($errMess);
                }
                return redirect('/Officer')->withSuccess('Successfully inserted into the database.');
            }
            else
            {
                return Redirect::back()->withErrors('The password does not match');
            }
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

        Officer::find($id)->update(['isActive' => 0]);
            return redirect('/Officer');    
    }

    public function soft()
    {
        $post = Officer::where('isActive',0)->get();
        return view('Officer.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Officer::find($id)->update(['isActive' => 1]);
        return redirect('/Officer');
    }
}
