<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blotter;
use DomPDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Report.index');
    }

    public function table($start,$end)
    {
       $post = Blotter::whereBetween('created_at', [$start,$end])->get();
       return Response()->json($post);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pdf($start,$end)
    {
        $post = Blotter::whereBetween('created_at', [$start,$end])->whereBetween('status', ['2','4'])->get();
        $pdf = DomPDF::loadView('Forms.BlotterReport',compact('post','start','end'));
        $pdf->SetPaper('letter','portrait');;
        return $pdf->stream();
    }
    

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
