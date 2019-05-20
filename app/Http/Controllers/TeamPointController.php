<?php

namespace App\Http\Controllers;

use App\TeamPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamPointController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team_fk = $request->get('team_fk');
        $points = $request->get('points');

        $t = TeamPoint::find($team_fk);
        //dd($point_team);
        $t->t_points = intval($points);
	    $t->timestamps = false;
        $t->save();

	    return redirect()->route('teamPoint-create', ['team_fk' => $team_fk])->with('success', 'Body úspešne zapísané.');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\TeamPoint  $teamPoint
     * @return \Illuminate\Http\Response
     */
    public function show(TeamPoint $teamPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamPoint  $teamPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamPoint $teamPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamPoint  $teamPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamPoint $teamPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamPoint  $teamPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamPoint $teamPoint)
    {
        //
    }
}
