@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Body</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

	                {{--@if(Auth::user()->isAdmin)--}}
		                    {{--Vitaj {{ Auth::user()->name  }}--}}
	                {{--@else--}}


						{{--<table>--}}
							{{--<tr>--}}
								{{--@foreach($hlavicka as $h)--}}
									{{--<th>{{ $h }}</th>--}}
								{{--@endforeach--}}
							{{--</tr>--}}

							{{--<tr>--}}
								{{--@foreach($zaznam as $z)--}}
									{{--<td>{{ $z }}</td>--}}
								{{--@endforeach--}}
							{{--</tr>--}}

						{{--</table>--}}
	                {{--@endif--}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
