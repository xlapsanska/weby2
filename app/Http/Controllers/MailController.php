<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
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

            function debug_to_console( $data ) {
                $output = $data;
                if ( is_array( $output ) )
                    $output = implode( ',', $output);
            
                echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
            }

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
                    // dd($student);
                    DB::table('mails')->insert([
                        'id' => $student[0],
                        'name' => $student[1],
                        'email' => $student[2],
                        'login' => $student[3],
                        'password' => $student[4],
                    ]);
                }
                // dd($new_csv);
                $csvExporter = new \Laracsv\Export();
                $collection = DB::table('mails')->get();
                // dd($collection_1);
                // dd($collection);
                // $csvExporter->build($collection, [ $collection_header[0],$collection_header[1],$collection_header[2],$collection_header[3],$collection_header[4] ])->download('new.csv');
                ob_end_clean(); 
                ob_start();
                $csvExporter->build($collection, ['id' => 'ID', 'name' => 'Meno', 'email' => 'E-mail', 'login' => 'Login', 'password' => 'Heslo'])->download('new.csv');

                return;
			}

            // $csvDB = DB::table('result_admins')->where('csv', strtolower($name))->first();

            // if (empty($csvDB)) {
                
            // }


            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu je pridané');
        } else
            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu nebolo pridané');
    }
}
