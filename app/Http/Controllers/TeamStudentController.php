<?php

namespace App\Http\Controllers;

use App\TeamStudent;
use App\TeamPoint;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamStudentController extends Controller
{

    public function create()
    {
	    $user = DB::table("users")->select("ais_id")->where("id", Auth::id())->first();

	    $student = DB::table("students")->where('ais_id', $user->ais_id)->first();

	    $teams = DB::table("students")
		    ->join("team_points","students.team_fk","=","team_points.id")
		    ->select("team_points.*", "students.id as s_id", "students.agree")
		    ->where('students.ais_id', $user->ais_id)
		    ->get();

	    $teams_arr = DB::table("students")
		                        ->join("team_points","students.team_fk","=","team_points.id")
		                        ->select("team_points.id")
		                        ->where('students.ais_id', $user->ais_id)
		                        ->get();

	    if(count($teams_arr) == 0){
	    	$teams_arr = array();
	    }
	    else
	    	$teams_arr = data_get($teams_arr, '*.id');

	    $student_teams = DB::table("students")
							    ->join("team_points","students.team_fk","=","team_points.id")
							    ->select("team_points.*", "students.id as s_id", "students.name", "students.email", "students.points", "students.agree", "students.isCaptain")
							    ->whereIn('team_points.id', $teams_arr)
							    ->get();

	    $student_teams = collect($student_teams)->groupBy('id')->toArray();

	    return view('teamPointStudent')
		    ->with(compact('student'))
		    ->with(compact('student_teams'))
		    ->with(compact('teams'));
    }

    public function store(Request $request)
    {
    	$team_fk = $request->get('team_fk');
	    $student = $request->get('student_auth');
	    $team_points = intval($request->get('team_points'));
    	$count_students = intval($request->get('team_student_count'));

    	$overBody = 0;
    	for ($i = 0; $i < $count_students; $i++) {
		    $overBody = $overBody + intval($request->get('points-'.$i));
	    }

	    if($overBody == $team_points) {
		    $student_auth = Student::find($request->get('student_auth'));

		    for ($i = 0; $i < $count_students; $i++) {
			    $s = Student::find($request->get('student_id-'.$i));

			    if($student_auth->ais_id == $s->ais_id) {
				    $s->isCaptain = 1;
				    $s->agree = 1;
			    }

			    $s->points = intval($request->get('points-'.$i));
			    $s->timestamps = false;
			    $s->save();


		    }

		    $allAgree = Student::studentsIsAgreePoints($team_fk);

		    if($allAgree) {
			    $t = TeamPoint::find($team_fk);
			    $t->studentsAgree = 1;
			    $t->timestamps = false;
			    $t->save();
		    }

		    return redirect()->route('pointStudent-create')->with('success', 'Zmeny vykonané úspešne.');
	    }

	    else {
		    return redirect()->route('pointStudent-create')->with('error', 'Súčet bodov nesedí s pridelenými bodmi.');
	    }

    }


	public function agree(Request $request)
	{
		$team_fk = $request->get('team_fk');
		$student = $request->get('student_id');
		$agree = intval($request->get('agree'));

		$s = Student::find($student);
		$s->agree = $agree;
		$s->timestamps = false;
		$s->save();

		$allAgree = Student::studentsIsAgreePoints($team_fk);

		if($allAgree) {
			$t                = TeamPoint::find($team_fk);
			$t->studentsAgree = 1;
			$t->timestamps    = false;
			$t->save();
		}

		return redirect()->route('pointStudent-create')->with('success', 'Zmeny vykonané úspešne.');

	}
}
