<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamAdmin extends Model
{
	protected $fillable = [
		'name', 'email', 'points','ais_id', 'agree', 'isCaptain', 'password',
	];

	protected $hidden = [
		'password',
	];

}
