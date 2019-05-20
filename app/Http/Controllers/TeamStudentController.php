<?php

namespace App\Http\Controllers;

use App\TeamStudent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamStudentController extends Controller
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
	    $user = DB::table("users")->select("username")->where("id", Auth::id())->first();
	    $student = DB::table("students")->where('email', 'like', $user->username.'%')->first();
	    //$student_team = DB::table("students")->select("team_fk")->where('email', 'like', $user->username.'%')->get()->toArray();


	    $student_team = DB::table("students")
		                        ->join("team_points","students.team_fk","=","team_points.id")
		                        ->select("students.*","team_points.*")
		                        ->where('email', 'like', $user->username.'%')
		                        ->get();
	    dd($student_team);


	    $teams_users = DB::table("team_points")
		    ->join("students", "students.team_fk", "=", "team_points.id")
		    ->get();

	    $teams = DB::table("team_points")
		    ->where("year", $year)
		    ->where("subject", $subject)
		    ->get();

	    return view('teamPointStudent')
		    ->with(compact('teams'))
		    ->with(compact('teams_users'))
		    ->with(compact('team_fk'));
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
     * @param  \App\TeamStudent  $teamStudent
     * @return \Illuminate\Http\Response
     */
    public function show(TeamStudent $teamStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamStudent  $teamStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamStudent $teamStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamStudent  $teamStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamStudent $teamStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamStudent  $teamStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamStudent $teamStudent)
    {
        //
    }
}
