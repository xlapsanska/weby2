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
                    @php
                        $count = 1;
                    @endphp
                    <div class="card mb-1">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    {{ $result->subject }}
                                </div>
                                <div class="col">
                                    <form action="{{route('deleteSubject', ['id' =>  $result->subject ]) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger float-right">
                                            Vymazať
                                        </button>
                                    </form>
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

                            <table class="myTable table"
                                   style="display: block !important; overflow: scroll !important; overflow-x: auto !important;">
                                {{--<a href="{{ URL::to('/pdf/'.$result->id) }}">Export PDF</a>--}}
                                <p>{{ $result->id }}</p>
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
                                        <tr>
                                            @foreach($c as $c2)
                                                <td>{{ $c2 }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            @php
                                $count++;
                            @endphp


                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection