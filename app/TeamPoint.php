<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeamPoint extends Model
{
	protected $fillable = [
		'team','subject', 'year', 'points', 'studentsAgree', 'adminAgree'
	];

	//overi ci v time je uz zvoleny kapitan
	public static function teamCaptain($team_id) {

		$captain = false;

		$student_teams = DB::table("students")
			->join("team_points","students.team_fk","=","team_points.id")
			->select("team_points.*", "students.*")
			->where('team_points.id', $team_id)
			->get();

		foreach ($student_teams as $student_team) {
			if($student_team->isCaptain == 1)
				$captain = true;
		}

		return $captain;
	}

	public static function countStudents($subject, $year) {

		$student_teams = DB::table("students")
			->join("team_points","students.team_fk","=","team_points.id")
			->select("team_points.id as t_id", "team_points.subject", "team_points.year", "students.*")
			->where('team_points.subject', $subject)
			->where('team_points.year', $year)
			->count();

		return $student_teams;

	}

	public static function countStudentsAgree($subject, $year, $agree) {

		$student_teams = DB::table("students")
			->join("team_points","students.team_fk","=","team_points.id")
			->select("team_points.id as t_id", "team_points.subject", "team_points.year", "students.*")
			->where('team_points.subject', $subject)
			->where('team_points.year', $year)
			->where('students.agree', $agree)
			->count();

		return $student_teams;

	}

	public static function countTeams($subject, $year) {

		$teams = DB::table("team_points")
			->where('subject', $subject)
			->where('year', $year)
			->count();

		return $teams;
	}

	public static function countTeamsClose($subject, $year) {

		$teams = DB::table("team_points")
			->where('subject', $subject)
			->where('year', $year)
			->where('adminAgree', 1)
			->count();

		return $teams;
	}

	public static function countTeamsResponseAdmin($subject, $year) {

		$teams = DB::table("team_points")
			->where('subject', $subject)
			->where('year', $year)
			->where('adminAgree', 0)
			->where('studentsAgree', 1)
			->count();

		return $teams;
	}

	public static function countTeamsResponseStudents($subject, $year) {

		$teams = DB::table("team_points")
			->where('subject', $subject)
			->where('year', $year)
			->where('studentsAgree', 0)
			->count();

		return $teams;
	}
}
