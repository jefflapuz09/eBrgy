<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Officer;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Project::where('isActive',1)->get();
        return view('Project.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $officer = Officer::where('isActive',1)->get();
        return view('Project.create',compact('officer'));
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
            'projectName' => ['required','unique:projects','max:150'],
            'projectDev'=> 'required|max:150',
            'description' => 'nullable|max:150',
            'officerCharge' =>  'required',
            'dateStarted' => 'required',
            'dateEnded' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'projectName' => 'Project Name',
            'projectDev'=> 'Project Developer',
            'description' => 'Description',
            'officerCharge' =>  'Officer-in-Charge',
            'dateStarted' => 'Date Started',
            'dateEnded' => 'Date Ended'
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
                Project::create([
                    'projectName' => $request->projectName,
                    'projectDev'=> $request->projectDev,
                    'description' => $request->description,
                    'officerCharge' =>  $request->officerCharge,
                    'dateStarted' => $request->dateStarted,
                    'dateEnded' => $request->dateEnded
                ]);
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Project')->withSuccess('Successfully inserted into the database.');
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
        $officer = Officer::where('isActive',1)->get();
        $post = Project::find($id);
        return view('Project.update',compact('officer','post'));
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
            'projectName' => ['required',Rule::unique('projects')->ignore($id),'max:150'],
            'projectDev'=> 'required|max:150',
            'description' => 'nullable|max:150',
            'officerCharge' =>  'required',
            'dateStarted' => 'required',
            'dateEnded' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'projectName' => 'Project Name',
            'projectDev'=> 'Project Developer',
            'description' => 'Description',
            'officerCharge' =>  'Officer-in-Charge',
            'dateStarted' => 'Date Started',
            'dateEnded' => 'Date Ended'
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
                Project::find($id)->update([
                    'projectName' => $request->projectName,
                    'projectDev'=> $request->projectDev,
                    'description' => $request->description,
                    'officerCharge' =>  $request->officerCharge,
                    'dateStarted' => $request->dateStarted,
                    'dateEnded' => $request->dateEnded
                ]);
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Project')->withSuccess('Successfully updated into the database.');
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

        Project::find($id)->update(['isActive' => 0]);
            return redirect('/Project');    
    }

    public function soft()
    {
        $post = Project::where('isActive',0)->get();
        return view('Project.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Project::find($id)->update(['isActive' => 1]);
        return redirect('/Project');
    }
}
