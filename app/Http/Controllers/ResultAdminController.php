<?php

namespace App\Http\Controllers;

use App\ResultAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResultAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resultAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
    
    public function showUploadFile(Request $request) {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $year = $request->year;
        $subject = $request->subject;
        $separator = $request->separator;
       
        $type = explode(".", $name);
        
        if(strtolower($type[1]) == "csv") {
            $destinationPath = 'storage';
            $file->move($destinationPath,$file->getClientOriginalName());

            DB::table('results')->insert([
                'year' => $year,
                'subject' => $subject,
                'separ' => $separator,
                'csv' => strtolower($name),
               
            ]);

            return redirect()->route('resultAdmin-create')->with('success', 'Nové hodnotenie predmetu je pridané');
        }

        else
            return redirect()->route('resultAdmin-create')->with('success', 'Nové hodnotenie predmetu nebolo pridané');


    
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResultAdmin  $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultAdmin  $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultAdmin  $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultAdmin  $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultAdmin $resultAdmin)
    {
        //
    }
}
