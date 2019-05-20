@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>

            @endif
        </div>

    </div>
</div>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            @foreach($results as $result)
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                            <div class="col">
	                            <h2 class="h5">{{$result->subject . " - " . $result->year }}</h2>
                            </div>
                    </div>
                    
                </div>

                <div class="card-body">

                    @php
                    if (file_exists('../storage/app/public/'.$result->csv)) {
                        $data = array_map('str_getcsv', file('../storage/app/public/'.$result->csv));
                        // $data = $result->csv;
                        $separ = $result->separ;
                        if($separ == ";"){
                            $csv = array_map(function($data){ return str_getcsv($data, ";");}
                        , file("../storage/app/public/".$result->csv));
                        }
                        elseif($separ == ","){
                            $csv = array_map(function($data){ return str_getcsv($data, ",");}
                        , file("../storage/app/public/".$result->csv));
                        }
                    }
                    else {
                    	$csv = array();
                    }
                    @endphp
                
                    <table  class=" table" style="display: block !important; overflow: scroll !important; overflow-x: auto !important;">
	                    <thead>
                            <tr>
	                            @foreach($csv[0] as $c)
		                            <th>{{ $c }}</th>
                                 @endforeach
                            </tr>
                    </thead>
	                    <tbody>
	                        @php
		                        $i = 0;
	                        @endphp

	                        @foreach($csv as $c)
	                            @if($i++ > 0)
		                            @if (in_array(\Illuminate\Support\Facades\Auth::user()->ais_id, $c))
		                                <tr>
		                                    @foreach($c as $c2)
				                                <td>{{ $c2 }}</td>
				                            @endforeach
		                                </tr>
		                            @endif
	                            @endif
						    @endforeach
	                    </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection