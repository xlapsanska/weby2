<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPoint extends Model
{
	protected $fillable = [
		'team','subject', 'year', 'points', 'studentsAgree', 'adminAgree'
	];
}
