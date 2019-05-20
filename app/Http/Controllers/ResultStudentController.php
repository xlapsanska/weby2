<?php

namespace App\Http\Controllers;

use App\ResultAdmin;
use Illuminate\Http\Request;

class ResultStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $results = ResultAdmin::all();
	    return view('resultStudentIndex')
		    ->with(compact('results'));
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
     * @param  \App\ResultStudent  $resultStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ResultStudent $resultStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultStudent  $resultStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultStudent $resultStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultStudent  $resultStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultStudent $resultStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultStudent  $resultStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultStudent $resultStudent)
    {
        //
    }
}
