<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
	protected $fillable = [
		'name', 'email', 'points','ais_id', 'agree', 'isCaptain', 'password',
	];

	protected $hidden = [
		'password',
	];

	// Over ci vsetci studenti z timu vyjadrili postoj k udelenym bodom
	public static function studentsIsAgreePoints($team_fk) {

		$allAgree = true;

		$teams_users = DB::table("team_points")
			->join("students", "students.team_fk", "=", "team_points.id")
			->select("students.agree")
			->where("team_points.id", $team_fk)
			->get();

		foreach ($teams_users as $teams_user) {
			if($teams_user->agree == 2)
				$allAgree = false;
		}

		return $allAgree;
	}

}
