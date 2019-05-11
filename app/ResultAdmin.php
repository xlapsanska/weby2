<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultAdmin extends Model
{
    protected $fillable = [
        'subject', 'year', 'csv', 'separ',
    ];
}
