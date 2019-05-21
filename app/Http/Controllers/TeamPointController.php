<?php

namespace App\Http\Controllers;

use App\TeamPoint;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

class TeamPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($team_fk)
    {

    	$subject = DB::table("team_points")->select("subject")->where("id", $team_fk)->first();
    	$subject = $subject->subject;

	    $year = DB::table("team_points")->select("year")->where("id", $team_fk)->first();
	    $year = $year->year;

	    $teams_users = DB::table("team_points")
		            ->join("students", "students.team_fk", "=", "team_points.id")
		            ->where("year", $year)
		            ->where("subject", $subject)
		            ->get();

	    $teams = DB::table("team_points")
		    ->where("year", $year)
		    ->where("subject", $subject)
		    ->get();

	    return view('teamPointCreate')
		        ->with(compact('teams'))
		        ->with(compact('teams_users'))
		        ->with(compact('team_fk'));
    }

    public function store(Request $request)
    {
        $team_fk = $request->get('team_fk');
        $points = $request->get('points');

        $t = TeamPoint::find($team_fk);
        $t->t_points = intval($points);
	    $t->studentsAgree = 0;
	    $t->adminAgree = 0;
	    $t->timestamps = false;
        $t->save();

        $students = DB::table("students")
	                    ->where("team_fk", $team_fk)
	                    ->get();

        foreach ($students as $student) {
	        $s = Student::find($student->id);
	        $s->points = 0;
	        $s->agree = 2;
	        $s->isCaptain = 0;
	        $s->timestamps = false;
	        $s->save();
        }

	    return redirect()->route('teamPoint-create', ['team_fk' => $team_fk])->with('success', 'Body úspešne zapísané.');

    }


	public function edit()
	{
		$teams_users = DB::table("team_points")
			->join("students", "students.team_fk", "=", "team_points.id")
			->get();

		$teams = DB::table("team_points")->get();


		return view('teamPointCreate')
			->with(compact('teams'))
			->with(compact('teams_users'));
	}

	public function agree(Request $request)
	{

		$team_fk = $request->get('team_fk');
		$agree = intval($request->get('agreeAdmin'));

		$t = TeamPoint::find($team_fk);
		$t->adminAgree = $agree;
		$t->timestamps = false;
		$t->save();

		return redirect()->route('teamPointAll-create')->with('success', 'Zmeny vykonané úspešne.');

	}

	public function downloadCSV(Request $request)
	{

		$team_fk = $request->get('team_fk');

		$students = Student::where('team_fk', $team_fk)->get();
		$csvExporter = new \Laracsv\Export();
		$csvExporter->build($students, ['ais_id' => 'AIS ID', 'name' => 'Meno', 'points' => 'Body'])->download();

	}

}

