<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

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

            function debug_to_console($data)
            {
                $output = $data;
                if (is_array($output))
                    $output = implode(',', $output);

                echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
            }

            if (file_exists('../storage/app/public/' . $name)) {
                $data = array_map('str_getcsv', file('../storage/app/public/' . $name));
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

            if (count($csv) > 0) {
                $i = 0;
                $new_csv = [];
                foreach ($csv as $csv_riadok) {
                    if ($i == 0) {
                        $csv_riadok = implode($csv_riadok);
                        $csv_riadok = $csv_riadok . ";heslo";
                        $new_csv[] = $csv_riadok;
                    }
                    if ($i++ > 0) {
                        // dd($csv);
                        $password = str_random(15);
                        $csv_riadok = implode($csv_riadok);
                        $csv_riadok = $csv_riadok . ";" . $password;
                        $new_csv[] = $csv_riadok;
                    }
                }
                // dd($new_csv);
                $csvExporter = new \Laracsv\Export();
                $csvExporter->build($new_csv)->download();
            }

            // $csvDB = DB::table('result_admins')->where('csv', strtolower($name))->first();

            // if (empty($csvDB)) {

            // }


            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu je pridané');
        } else
            return redirect()->route('mailAdmin-create')->with('success', 'Nové hodnotenie predmetu nebolo pridané');
    }

    public function sendMail(Request $request)
    {
        if (file_exists('../storage/app/public/mail.csv')) {
            $data = array_map('str_getcsv', file('../storage/app/public/mail.csv'));
            $separ = ";";
            if ($separ == ";") {
                $csv = array_map(function ($data) {
                    return str_getcsv($data, ";");
                }
                    , file("../storage/app/public/mail.csv"));
            } elseif ($separ == ",") {
                $csv = array_map(function ($data) {
                    return str_getcsv($data, ",");
                }
                    , file("../storage/app/public/mail.csv"));
            }
        } else {
            $csv = array();
        }

        $viewDemo = new \stdClass();
        $viewDemo->farba_receiver = $request->farbaPrijemcaMailu;
        $viewDemo->farba_ip_adresa = $request->farbaIpAdresa;
        $viewDemo->farba_ssh_port = $request->farbaSshPort;
        $viewDemo->farba_http_port = $request->farbaHttpPort;
        $viewDemo->farba_https_port = $request->farbaHTTPSPort;
        $viewDemo->farba_misc_1_port = $request->farbaMisc1;
        $viewDemo->farba_misc_2_port = $request->farbaMisc2;
        $viewDemo->farba_login = $request->farbaLogin;
        $viewDemo->farba_password = $request->farbaHeslo;
        $viewDemo->sender = $request->odosielatelMailu;
        $viewDemo->mailType = $request->mailType;
        //dd($request->mailType, $viewDemo);
        $i = 0;
        foreach ($csv as $c) {
            if($i != 0){
                $viewDemo->receiver = $c[1];
                $viewDemo->email = $c[2];
                $viewDemo->login = $c[3];
                $viewDemo->password = $c[4];
                $viewDemo->ip_adresa = $c[5];
                $viewDemo->ssh_port = $c[6];
                $viewDemo->http_port = $c[7];
                $viewDemo->https_port = $c[8];
                $viewDemo->misc_1_port = $c[9];
                $viewDemo->misc_2_port = $c[10];

                Mail::to($viewDemo->email)->send(new DemoEmail($viewDemo));
            }
            $i++;
        }

        return redirect()->route('mailAdmin-create')->with('success', 'Email bol odoslany');
    }
}
