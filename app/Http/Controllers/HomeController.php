<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

	    if (file_exists('data.csv')) {

		    $csv = array_map('str_getcsv', file('data.csv'));
		    $user = Auth::user();
		    $hlavicka = $csv[0];
			$zaznam = array();
			foreach ($csv as $item) {
				if($user->username == $item[1]) {
					$zaznam = $item;
				}
		    }
	    }

	    return view('home')
		    ->with(compact('hlavicka'))
		    ->with(compact('zaznam'));
    }
}
