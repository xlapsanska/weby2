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
			        <div class="card mb-3">
				        <div class="card-header" id="headingOne{{ $team->id }}">
					        <div class="row">
						        <div class="col-md-5 btn text-left" data-toggle="collapse" data-target="#collapseOne{{ $team->id }}" aria-expanded="true" aria-controls="collapseOne{{ $team->id }}">
							        <h5 class="mb-0">
								        <a class="">
									        <span class="h6">{{ $team->subject }} {{ $team->year }}</span>
									        <span class="ml-2 h5">- </span>
									        @lang('result_admin.t2_team')
									        <span class="h5 font-weight-bold">: {{$team->team}}</span>
								        </a>
							        </h5>
						        </div>
						        <div class="col-md-7">
							        <div class="row d-flex justify-content-end align-items-center text-right">
								        <div class="col-md-4 mb-md-0 mb-2 ">
									        <p class="mb-0 text-right">@lang('result_admin.t2_points'):</p>
								        </div>
								        <div class="col-md-3 mb-md-0 mb-2">
									        <input type="number" class="form-control text-center" id="points" name="points" disabled placeholder="{{ $team->t_points }}">
								        </div>

							        <form class="col-md-5" action="{{route('teamPoint-csv')}}" method="post">
								        @csrf
								        <input type="hidden" id="team_fk" name="team_fk" value="{{ $team->id }}">
								        <div class="btn-group" role="group" aria-label="Basic example">
									        <button type="submit" class="btn btn-dark">
										        <i class="fas fa-file-export text-white"></i>
										        <span class="ml-2">CSV</span>
									        </button>
									        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseStatistic{{ $team->id }}" aria-expanded="false" aria-controls="collapseStatistic{{ $team->id }}">
										        <i class="fas fa-chart-pie text-white"></i>
										        <span class="ml-2">@lang('result_admin.t2_btn_statistics')</span>
									        </button>
								        </div>
							        </form>
							        </div>
						        </div>
					        </div>

				        </div>

				        <div id="collapseOne{{ $team->id }}" class="collapse show" aria-labelledby="headingOne{{ $team->id }}" data-parent="#accordion">
					        <div class="card-body">
						        <div class="collapse mb-3" id="collapseStatistic{{ $team->id }}">
							        <div class="card card-body">
								        <div class="row">
									        <div class="col-md-6">
										        <div class="row">
											        <div class="col-12">
												        <ul class="list-group">
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_student')
														        <p class="mb-0 h4">
														        <span class="badge badge-primary badge-pill">
															        {{ App\TeamPoint::countStudents($team->subject, $team->year)}}
														        </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_student_agree')
														        <p class="mb-0 h4">
														        <span class="badge badge-primary badge-pill">
															        {{ App\TeamPoint::countStudentsAgree($team->subject, $team->year, 1)}}
														        </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_student_disagree')
														        <p class="mb-0 h4">
														        <span class="badge badge-primary badge-pill">
														            {{ App\TeamPoint::countStudentsAgree($team->subject, $team->year, 0)}}
													            </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_student_notreply')
														        <p class="mb-0 h4">
													        <span class="badge badge-primary badge-pill">
													            {{ App\TeamPoint::countStudentsAgree($team->subject, $team->year, 2)}}
												            </span>
														        </p>
													        </li>
												        </ul>
											        </div>
											        <div class="col-12">
												        <div id="chart-div{{ $team->id }}"></div>
												        @php
													        $reasons = Lava::DataTable();
															$reasons->addStringColumn('Reasons')
																	->addNumberColumn('Percent')
																	->addRow(['súhlasiachich', App\TeamPoint::countStudentsAgree($team->subject, $team->year, 1)])
																	->addRow(['nesúhlasiachich', App\TeamPoint::countStudentsAgree($team->subject, $team->year, 0)])
																	->addRow(['ktorý sa nevyjadrili', App\TeamPoint::countStudentsAgree($team->subject, $team->year, 2)]);

															Lava::DonutChart('countStudents'.$team->id, $reasons, [
																'title' => 'Počet študentov'
															]);
												        @endphp
												        {!! Lava::render('DonutChart', 'countStudents'.$team->id, 'chart-div'.$team->id) !!}
											        </div>
										        </div>
									        </div>
									        <div class="col-md-6">
										        <div class="row">
											        <div class="col-12">
												        <ul class="list-group">
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_team')
														        <p class="mb-0 h4">
												        <span class="badge badge-primary badge-pill">
													        {{ App\TeamPoint::countTeams($team->subject, $team->year)}}
												        </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_team_close')
														        <p class="mb-0 h4">
												        <span class="badge badge-primary badge-pill">
													        {{ App\TeamPoint::countTeamsClose($team->subject, $team->year)}}
												        </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_team_need_reply')
														        <p class="mb-0 h4">
												        <span class="badge badge-primary badge-pill">
												            {{ App\TeamPoint::countTeamsResponseAdmin($team->subject, $team->year)}}
											            </span>
														        </p>
													        </li>
													        <li class="list-group-item d-flex justify-content-between align-items-center">
														        @lang('result_admin.t2_stat_count_team_student_notreply')
														        <p class="mb-0 h4">
												        <span class="badge badge-primary badge-pill">
												            {{ App\TeamPoint::countTeamsResponseStudents($team->subject, $team->year)}}
											            </span>
														        </p>
													        </li>
												        </ul>
											        </div>
											        <div class="col-12">
												        <div id="chart-div-team{{ $team->id }}"></div>
												        @php
													        $reasons = Lava::DataTable();
															$reasons->addStringColumn('Reasons')
																	->addNumberColumn('Percent')
																	->addRow(['uzavretých',  App\TeamPoint::countTeamsClose($team->subject, $team->year)])
																	->addRow(['ku ktorým sa treba vyjadriť', App\TeamPoint::countTeamsResponseAdmin($team->subject, $team->year)])
																	->addRow(['s nevyjadrenými študentami', App\TeamPoint::countTeamsResponseStudents($team->subject, $team->year)]);

															Lava::DonutChart('countTeams'.$team->id, $reasons, [
																'title' => 'Počet tímov'
															]);
												        @endphp
												        {!! Lava::render('DonutChart', 'countTeams'.$team->id, 'chart-div-team'.$team->id) !!}
											        </div>
										        </div>
									        </div>
								        </div>

							        </div>
						        </div>

						        @if(App\TeamPoint::teamCaptain($team->id))
									@if($team->agree == 2)
										<div class="row mb-3">
											<div class="col-2">
												<form action="{{route('pointStudent-agree')}}" method="post">
													@csrf
													<input type="hidden" id="team_fk" name="team_fk" value="{{ $team->id }}">
													<input type="hidden" id="student_id" name="student_id" value="{{ $team->s_id }}">
													<input type="hidden" id="agree" name="agree" value="1">
													<button type="submit" class="btn btn-block btn-dark">
														<i class="fas fa-thumbs-up text-white"></i>
														<span class="ml-2">@lang('result_admin.t2_btn_agree')</span>
													</button>
												</form>
											</div>
											<div class="col-2">
												<form action="{{route('pointStudent-agree')}}" method="post">
													@csrf
													<input type="hidden" id="team_fk" name="team_fk" value="{{ $team->id }}">
													<input type="hidden" id="student_id" name="student_id" value="{{ $team->s_id }}">
													<input type="hidden" id="agree" name="agree" value="0">
													<button type="submit" class="btn btn-block btn-dark">
														<i class="fas fa-thumbs-down text-white"></i>
														<span class="ml-2">@lang('result_admin.t2_btn_disagree')</span>
													</button>
												</form>
											</div>
										</div>
									@else
										<div class="row mb-3">
											<div class="col-12 text-right">
												<p class="h6 mb-0 text-success">
													@if($team->agree == 1)
														<i class="fas fa-thumbs-up text-success"></i>
														<span class="text-success">@lang('result_admin.t2_msg_student_agree')</span>
													@else
														<i class="fas fa-thumbs-down text-danger"></i>
														<span class="text-danger">@lang('result_admin.t2_msg_student_disagree')</span>
													@endif
												</p>
											</div>
										</div>
							        @endif
						        @endif
						        <form action="{{route('pointStudent-store')}}" method="post">
							        @csrf
							        <input type="hidden" id="team_fk" name="team_fk" value="{{ $team->id }}">
							        <input type="hidden" id="student_auth" name="student_auth" value="{{ $student->id }}">
							        <input type="hidden" id="team_points" name="team_points" value="{{ $team->t_points }}">
							        <input type="hidden" id="team_student_count" name="team_student_count" value="{{ count($student_teams[$team->id]) }}">

							        @if(!App\TeamPoint::teamCaptain($team->id))
								        <div class="row mb-2">
									        <div class="col-3">
										        <button type="submit" class="btn btn-block btn-dark" value="0">
											        <span>@lang('result_admin.t2_btn_add_points')</span>
										        </button>
									        </div>
								        </div>
							        @endif
							        <div class="row">
							        <div class="col-12">
								        <table class="table">
									        <thead>
									        <tr>
										        <th>@lang('result_admin.t2_name')</th>
										        <th>E-mail</th>
										        <th class="text-center">@lang('result_admin.t2_points')</th>
										        <th class="text-center">@lang('result_admin.t2_agree')</th>
									        </tr>
									        </thead>
									        <tbody>
										        @php
											        $i = 0;
										        @endphp
										        @foreach($student_teams[$team->id] as $student_team)
											        <tr>
														<td>{{$student_team->name}}</td>
													    <td>{{$student_team->email}}</td>
												        <td class="text-center">
												            @if(App\TeamPoint::teamCaptain($student_team->id))
														        <input type="text" class="form-control text-center" id="points" name="points" disabled placeholder="{{ $student_team->points }}">
													        @else
														        <input type="hidden" id="student_id-{{ $i }}" name="student_id-{{ $i }}" value="{{ $student_team->s_id }}">
														        <input type="number" min="0" step="1" class="form-control text-center" id="points-{{ $i }}" name="points-{{ $i++ }}" placeholder="{{ $student_team->points }}">
													        @endif
											            </td>
													        <td class="text-center">
														        @if(intval($student_team->agree) == 0)
															        <i class="fas fa-times text-danger"></i>
															    @elseif(intval($student_team->agree) == 1)
															        <i class="fas fa-check text-success"></i>
														        @else
															        <i class="fas fa-question text-dark"></i>
														        @endif
													        </td>
												        </tr>
										        @endforeach
									        </tbody>
								        </table>
							        </div>

						        </div>
						        </form>
					        </div>
				        </div>
			        </div>

				@endforeach


	        </div>
        </div>
    </div>
</div>
@endsection