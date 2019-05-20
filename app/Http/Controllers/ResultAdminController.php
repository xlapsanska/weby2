<?php

namespace App\Http\Controllers;

use App\ResultAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use PDF;
use Dompdf\Dompdf;

class ResultAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = ResultAdmin::all();
        return view('resultAdminIndex')
            ->with(compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resultAdminCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $year = $request->year;
        $subject = $request->subject;
        $separator = $request->separator;

        $type = explode(".", $name);

        if (strtolower($type[1]) == "csv") {
            $destinationPath = 'storage';
            $file->move($destinationPath, $file->getClientOriginalName());

            $csvDB = DB::table('result_admins')->where('csv', strtolower($name))->first();

            if (empty($csvDB)) {
                DB::table('result_admins')->insert([
                    'year' => $year,
                    'subject' => $subject,
                    'separ' => $separator,
                    'csv' => strtolower($name),
                ]);
            }


            return redirect()->route('resultAdmin-create')->with('success', 'Nové hodnotenie predmetu je pridané');
        } else
            return redirect()->route('resultAdmin-create')->with('success', 'Nové hodnotenie predmetu nebolo pridané');


    }

    public function deleteSubject($id)
    {

        DB::table('result_admins')->where('subject', $id)->delete();
        return redirect()->route('resultAdmin-index')->with('success', 'Predmet bol odstránený');
    }


    public function exportPdf($id)
    {

        $result = ResultAdmin::where('id', $id)->first();

        if (file_exists('../storage/app/public/' . $result->csv)) {
            $data = array_map('str_getcsv', file('../storage/app/public/' . $result->csv));
            $separ = $result->separ;
            if ($separ == ";") {
                $csv = array_map(function ($data) {
                    return str_getcsv($data, ";");
                }
                    , file("../storage/app/public/" . $result->csv));
            } elseif ($separ == ",") {
                $csv = array_map(function ($data) {
                    return str_getcsv($data, ",");
                }
                    , file("../storage/app/public/" . $result->csv));
            }
        } else {
            $csv = array();
        }

        $counter = 0;
        $html = [];
        foreach ($csv[0] as $c) {
            $html[] = "<th>" . $c . "</th>";
            $counter = $counter + 1;
        };

        $result = [];
        $i = 0;

        foreach ($csv as $c) {
            if ($i++ > 0) {
                $result[] = "<tr>";
                foreach ($c as $c2)
                    $result[] = "<td>" . $c2 . "</td>";
                $result[] = "</tr>";
            }
        }

        $header = implode($html);
        $content1 = implode($result);

        if ($counter < 8) {
            $html = '
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <table class="table"><thead><tr>' . $header . '</tr></thead><tbody>' . $content1 . '</tbody></table>';
        } else {
            $html = '
 <table class="table"><thead><tr>' . $header . '</tr></thead><tbody>' . $content1 . '</tbody></table>';

        }

        $pdf = PDF::loadHTML($html);

        return $pdf->stream();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ResultAdmin $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultAdmin $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ResultAdmin $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultAdmin $resultAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultAdmin $resultAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultAdmin $resultAdmin)
    {
        //
    }
}