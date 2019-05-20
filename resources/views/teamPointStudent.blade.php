@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>

            @endif
	            @if($message = Session::get('error'))
		            <div class="alert alert-danger">
			            <p>{{$message}}</p>
		            </div>
	           @endif
        </div>

    </div>
</div>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">

	        <div id="accordion">

		        @foreach($teams as $team)

			        <div class="card mb-2">
				        <div class="card-header" id="headingOne{{ $team->id }}">
					        <div class="row">
						        <div class="col-md-5 btn text-left" data-toggle="collapse" data-target="#collapseOne{{ $team->id }}" aria-expanded="true" aria-controls="collapseOne{{ $team->id }}">
							        <h5 class="mb-0">
								        <a class="">
									        <span class="ml-2 h5">Tím: </span><span class="h5 font-weight-bold">{{$team->team}}</span>
								        </a>
							        </h5>
						        </div>
						        <div class="col-md-7">
								        <form  class="row  d-flex justify-content-center align-items-center" action="{{route('teamPoint-store')}}" method="post">
									        @csrf
									        <div class="col-md-3 mb-md-0 mb-2 ">
										        <p class="mb-0 text-right">Body:</p>
										    </div>
									        <div class="col-md-3 mb-md-0 mb-2">
										        <input type="hidden" id="team_fk" name="team_fk" value="{{ $team->id }}">
										        {{-- <input type="hidden" id="points_team" name="points_team" value="{{ $team->team }}">--}}
										        <input type="text" class="form-control text-center" id="points" name="points" placeholder="{{ $team->points }}">
									        </div>
									        <div class="col-md-6">
										        <button type="submit" class="btn btn-block btn-primary">Zapísať</button>
									        </div>
								        </form>
						        </div>
					        </div>

				        </div>

				        <div id="collapseOne{{ $team->id }}" class="collapse show" aria-labelledby="headingOne{{ $team->id }}" data-parent="#accordion">
					        <div class="card-body">
						        @if(intval($team->studentsAgree) == 1)
							        <form  class="row mb-2" action="{{route('teamPoint-store')}}" method="post">
								        @csrf
								        <div class="col-md-2">
									        <button type="submit" class="btn btn-block btn-dark" value="1">
										        <i class="fas fa-thumbs-up text-white"></i>
										        <span class="ml-2">Súhasím</span>
									        </button>
								        </div>
								        <div class="col-md-2">
									        <button type="submit" class="btn btn-block btn-dark" value="0">
										        <i class="fas fa-thumbs-down text-white"></i>
										        <span class="ml-2">Nesúhasím</span>
									        </button>
								        </div>
							        </form>
						        @endif
						        <div class="row">
							        <div class="col-12">
								        <table class="table">
									        <thead>
									        <tr>
										        <th>Meno</th>
										        <th>E-mail</th>
										        <th class="text-center">Body</th>
										        <th class="text-center">Súhlas</th>
									        </tr>
									        </thead>
									        <tbody>
									        @foreach($teams_users as $user)
										        @if($user->team == $team->team)
											        <tr>
												        <td>{{$user->name}}</td>
												        <td>{{$user->email}}</td>
												        <td class="text-center">{{$user->points}}</td>
												        <td class="text-center">
													        @if(intval($user->agree) == 0)
														        <i class="fas fa-times text-danger"></i>
													        @else
														        <i class="fas fa-check text-success"></i>
													        @endif
												        </td>
											        </tr>
										        @endif
									        @endforeach
									        </tbody>
								        </table>
							        </div>

						        </div>


					        </div>
				        </div>
			        </div>

				@endforeach


	        </div>
        </div>
    </div>
</div>
@endsection