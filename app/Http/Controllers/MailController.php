<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{

    public function create()
    {
        return view('mailAdminCreate');
    }

    public function showUploadFile(Request $request)
    {
        // $faker = Faker\Factory::create();
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        // dd(count($file));
        $separator = $request->separator;
	    $type = explode(".", $name);
        if (strtolower($type[1]) == "csv") {
            $destinationPath = 'storage/';
            $file->move($destinationPath, $file->getClientOriginalName());
            
            if (file_exists('../storage/app/public/'.$name)) {
                $data = array_map('str_getcsv', file('../storage/app/public/'.$name));
                $separ = $separator;
                if($separ == ";"){
                    $csv = array_map(function($data){ return str_getcsv($data, ";");}
                        , file('../storage/app/public/'.$name));
                }
                elseif($separ == ","){
                    $csv = array_map(function($data){ return str_getcsv($data, ",");}
                        , file('../storage/app/public/'.$name));
                }
            }
            unlink(storage_path('../storage/app/public/'.$name));

            if(count($csv) > 0) {
                $i = 0;
                $new_csv = [];
                $new_csv_header = [];
                foreach ($csv as $csv_riadok) {
                    if($i == 0){
                        $csv_riadok = implode($csv_riadok);
                        $csv_riadok =$csv_riadok.";heslo";
                        $new_csv_header[] = $csv_riadok;
                    }
                    if ($i++ > 0) {
                        $password = str_random(15);
                        $csv_riadok = implode($csv_riadok);
                        $csv_riadok = $csv_riadok.";".$password;
                        $new_csv[] = explode(";",$csv_riadok);
                    }
                }
                foreach($new_csv as $student){
                    DB::table('mails')->insert([
                        'ais_id' => $student[0],
                        'name' => $student[1],
                        'email' => $student[2],
                        'login' => $student[3],
                        'password' => $student[4],
                    ]);
                }

                $csvExporter = new \Laracsv\Export();
                $collection = DB::table('mails')->get();

                ob_end_clean();
                ob_start();
                $csvExporter->build($collection, ['id' => 'ID', 'name' => 'Meno', 'email' => 'E-mail', 'login' => 'Login', 'password' => 'Heslo'])->download('new.csv');
                return;
            }

            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu je pridané');
        } else
            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu nebolo pridané');
    }

    public function sendMail(Request $request)
    {
	    $file = $request->file('image');

	    $name = $file->getClientOriginalName();

	    $separator = $request->separator;
	    $type = explode(".", $name);

	    if (strtolower($type[1]) == "csv") {
		    $destinationPath = 'storage/';
		    $file->move($destinationPath, $file->getClientOriginalName());
		    function debug_to_console($data)
		    {
			    $output = $data;
			    if (is_array($output)) {
				    $output = implode(',', $output);
			    }

			    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
		    }

		    if (file_exists('../storage/app/public/' . $name)) {
			    $data  = array_map('str_getcsv', file('../storage/app/public/' . $name));
			    $separ = $separator;
			    if ($separ == ";") {
				    $csv = array_map(function ($data) {
					    return str_getcsv($data, ";");
				    }
					    , file('../storage/app/public/' . $name));
			    } elseif ($separ == ",") {
				    $csv = array_map(function ($data) {
					    return str_getcsv($data, ",");
				    }
					    , file('../storage/app/public/' . $name));
			    }
		    }
		    unlink(storage_path('../storage/app/public/' . $name));

		    $viewDemo                    = new \stdClass();
		    $viewDemo->farba_blok    = $request->colorBlock;
		    $viewDemo->farba_text    = $request->colorText;
		    $viewDemo->farba_text_blok    = $request->colorTextBlock;
		    $viewDemo->sablona    = $request->sablona;
            $viewDemo->sender            = $request->odosielatelMailu;
            $viewDemo->subject           = $request->subject;
		    $viewDemo->mailType          = $request->mailType;
		    $viewDemo->email           = $request->email;
		    //dd($request->mailType, $viewDemo);
		    $i = 0;
		    $j = 0;
		    $hlavicka = array();
		    //$vsetci = array();
		    $other = array();
		    foreach ($csv as $c) {

		    	if($j != 0) {

			    	foreach ($c as $bunka) {
					    if ($i > 4) {
						    array_push($other, $bunka);
					    }
					    $i++;
				    }
				    //array_push($vsetci, $osoba);

				    $viewDemo->receiver    = $c[1];
				    $viewDemo->email       = $c[2];
				    $viewDemo->login       = $c[3];
				    $viewDemo->password    = $c[4];

				    $viewDemo->other = $other;
				    $viewDemo->hlavicka = $hlavicka;
				    Mail::to($viewDemo->email)->send(new DemoEmail($viewDemo));
				    $other = array();
					$i = 0;
				    //
				    DB::table('mails_info')->insert([
					    'datum'          => Carbon::now(),
					    'meno_studenta'  => $c[1],
					    'predmet_spravy' => $viewDemo->subject,
					    'id_sablona' => $viewDemo->sablona,
				    ]);
			    }
			    else {
			    	$k= 0;
			    	foreach ($c as $bunka) {
					    if ($k > 4) {
						    array_push($hlavicka, $bunka);
					    }
					    $k++;
			    	}


			    }
			    $j++;
		    }
	    }

        return redirect()->route('mailAdmin-create')->with('success', 'Email bol odoslany');
    }
}
