<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Household;
use App\Resident;
use App\Inhabitant;
use DB;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Household::with('Inhabitants')->where('isActive',1)->get();
        return view('Household.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::where('isActive',1)->get();
        return view('Household.create',compact('resident'));
    }

    public function inhabitant($id)
    {
        $post = Resident::where('id',$id)->get();
        return response()->json($post);
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
            'id' => ['required','unique:households'],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'id' => 'Household No.',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City'
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
                $household = Household::create([
                    'id' => $request->id,
                    'street' => $request->street,
                    'brgy' => $request->brgy,
                    'city' => $request->city,
                ]);

                $id = DB::table('households')
                    ->select('id')
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->get();
                
                foreach($id as $id2)
                {
                    foreach($request->inhabitantss as $inhabitant)
                    {
                        Inhabitant::create([
                            'residentId' => $inhabitant,
                            'householdId' => $id2->id
                        ]);
                    }
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Household')->withSuccess('Successfully inserted into the database.');
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
        $post = Household::find($id);
        $resident = Resident::where('isActive',1)->get();
        $inhabitant = Inhabitant::where('householdId',$id)->first();
        return view('Household.update',compact('post','resident','inhabitant'));
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
            'id' => ['required',Rule::unique('households')->ignore($id)],
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'id' => 'Household No.',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City'
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
                $household = Household::find($id)->update([
                    'id' => $request->id,
                    'street' => $request->street,
                    'brgy' => $request->brgy,
                    'city' => $request->city,
                ]);

                $id = $request->householdId;
                $resid = $request->inhabitantId;

                Inhabitant::where('householdId',$id)->delete();

                foreach($request->inhabitantss as $inhabitant)
                {
                        Inhabitant::updateOrCreate([
                            'residentId' => $inhabitant,
                            'householdId' => $id
                        ]);
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/Household')->withSuccess('Successfully updated into the database.');
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

        Household::find($id)->update(['isActive' => 0]);
            return redirect('/Household');    
    }

    public function soft()
    {
        $post = Household::where('isActive',0)->get();
        return view('Household.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Household::find($id)->update(['isActive' => 1]);
        return redirect('/Household');
    }

    public function remove($id)
    {
        $post = Household::find($id);

        if(count($post->Inhabitants)!=0)
        {
            $inhabitant = Inhabitant::where('householdId',$post->id)->get();
            
            foreach($inhabitant as $ins)
            {
                
                $ins->delete();
            }
        }

        $post->delete();
        return redirect('/Household/Soft');
    }
}
