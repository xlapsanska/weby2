<?php

namespace App\Http\Controllers;

use App\TeamPoint;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('teamAdminCreate');

    }

	public function showUploadFile(Request $request) {
		function w1250_to_utf8($text) {
			$map = array(
				chr(0x8A) => chr(0xA9),
				chr(0x8C) => chr(0xA6),
				chr(0x8D) => chr(0xAB),
				chr(0x8E) => chr(0xAE),
				chr(0x8F) => chr(0xAC),
				chr(0x9C) => chr(0xB6),
				chr(0x9D) => chr(0xBB),
				chr(0xA1) => chr(0xB7),
				chr(0xA5) => chr(0xA1),
				chr(0xBC) => chr(0xA5),
				chr(0x9F) => chr(0xBC),
				chr(0xB9) => chr(0xB1),
				chr(0x9A) => chr(0xB9),
				chr(0xBE) => chr(0xB5),
				chr(0x9E) => chr(0xBE),
				chr(0x80) => '&euro;',
				chr(0x82) => '&sbquo;',
				chr(0x84) => '&bdquo;',
				chr(0x85) => '&hellip;',
				chr(0x86) => '&dagger;',
				chr(0x87) => '&Dagger;',
				chr(0x89) => '&permil;',
				chr(0x8B) => '&lsaquo;',
				chr(0x91) => '&lsquo;',
				chr(0x92) => '&rsquo;',
				chr(0x93) => '&ldquo;',
				chr(0x94) => '&rdquo;',
				chr(0x95) => '&bull;',
				chr(0x96) => '&ndash;',
				chr(0x97) => '&mdash;',
				chr(0x99) => '&trade;',
				chr(0x9B) => '&rsquo;',
				chr(0xA6) => '&brvbar;',
				chr(0xA9) => '&copy;',
				chr(0xAB) => '&laquo;',
				chr(0xAE) => '&reg;',
				chr(0xB1) => '&plusmn;',
				chr(0xB5) => '&micro;',
				chr(0xB6) => '&para;',
				chr(0xB7) => '&middot;',
				chr(0xBB) => '&raquo;',
			);
			return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
		}

		$file = $request->file('image');
		$name = $file->getClientOriginalName();

		$team_fk = 0;
		$year = $request->year;
		$subject = $request->subject;
		$separator = $request->separator;

		$type = explode(".", $name);

		if(strtolower($type[1]) == "csv") {

			$destinationPath = 'storage/studenti/';
			$file->move($destinationPath,$file->getClientOriginalName());

			if (file_exists('../storage/app/public/studenti/'.$name)) {
				$data = array_map('str_getcsv', file('../storage/app/public/studenti/'.$name));
				$separ = $separator;
				if($separ == ";"){
					$csv = array_map(function($data){ return str_getcsv($data, ";");}
						, file('../storage/app/public/studenti/'.$name));
				}
				elseif($separ == ","){
					$csv = array_map(function($data){ return str_getcsv($data, ",");}
						, file('../storage/app/public/studenti/'.$name));
				}
			}
			else {
				$csv = array();
			}

			//Nacitanie udajov do tabulky team_points -- rocnik, tim, predmet, body
			if(count($csv) > 0) {
				$i = 0;
				foreach ($csv as $csv_riadok) {
					if ($i++ > 0) {
						$team   = w1250_to_utf8($csv_riadok[4]);
						$over = DB::table('team_points')
									->where('year', $year)
									->where('team', intval($team))
									->where('subject', $subject)
									->first();

						if($over == null) {
							DB::table('team_points')->insert([
								'year' => $year,
								'team' => intval($team),
								'subject' => $subject,
							]);
						}
						else {
							$team_points = TeamPoint::find($over->id);
							$team_points->delete();

							DB::table('team_points')->insert([
								'year' => $year,
								'team' => intval($team),
								'subject' => $subject,
							]);
						}
					}
				}
			}

			if(count($csv) > 0) {
				$i = 0;
				foreach ($csv as $csv_riadok) {
					if ($i++ > 0) {
						$ais_id = w1250_to_utf8($csv_riadok[0]);
						$meno   = w1250_to_utf8($csv_riadok[1]);
						$email  = w1250_to_utf8($csv_riadok[2]);
						$heslo  = w1250_to_utf8($csv_riadok[3]);
						$team   = w1250_to_utf8($csv_riadok[4]);

						if($heslo != "") {
							$heslo  = Hash::make(w1250_to_utf8($csv_riadok[3]));
						}

						$team_point_fk = DB::table('team_points')
											->select('id')
											->where('year', $year)
											->where('team', intval($team))
											->where('subject', $subject)
											->first();

						if($team_point_fk != null) {
							$team_fk = $team_point_fk->id;
						}

						$overStudent = DB::table('students')
							->where('ais_id', $ais_id)
							->where('team_fk', $team_point_fk->id)
							->first();

						if($overStudent == null) {
							DB::table('students')->insert([
								'name' => $meno,
								'email' => $email,
								'password' => $heslo,
								'ais_id' => $ais_id,
								'team_fk' => $team_point_fk->id,
							]);
						}
						else {

							$sudents = Student::find($overStudent->id);
							$sudents->delete();

							DB::table('students')->insert([
								'name' => $meno,
								'email' => $email,
								'password' => $heslo,
								'ais_id' => $ais_id,
								'team_fk' => $team_point_fk->id,
							]);
						}
					}
				}
			}
			return redirect()->route('teamPoint-create', ['team_fk' => $team_fk])->with('success', 'Nový študenti pridaný.');
		}

		else
			return redirect()->route('teamAdmin-create')->with('error', 'Nový študenti neboli úspešne pridaný.');



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


}
