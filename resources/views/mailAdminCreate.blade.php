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
            </div>

        </div>
    </div>
    <div class="container">

        <div class="row justify-content-center">
	        <div class="col-md-10 text-right">
		        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			        List Send E-mail
		        </button>
	        </div>
        </div>
	    <div class="row justify-content-center">
		    <div class="collapse col-md-10" id="collapseExample">
			    <div class="card card-body">

				    @php
				        $mails = \Illuminate\Support\Facades\DB::table("mails_info")->get();
				    @endphp
				    <table class="myTable table"
				           style="display: block !important; overflow: scroll !important; overflow-x: auto !important;">
					    <thead>
					    <tr>

							    <th>@lang('result_admin.date')</th>
							    <th>@lang('result_admin.name')</th>
							    <th>@lang('result_admin.subject_email')</th>
						    <th>Sablona</th>

					    </tr>
					    </thead>
					    <tbody>
					    @foreach($mails as $mail)
							    <tr>
								    <td>{{ $mail->datum }}</td>
								    <td>{{ $mail->meno_studenta }}</td>
								    <td>{{ $mail->predmet_spravy }}</td>
								    <td>{{ $mail->id_sablona }}</td>
							    </tr>
					    @endforeach
					    </tbody>
				    </table>

			    </div>
		    </div>
	    </div>
        <div class="row justify-content-center">


            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">E-mail</div>
                    <div class="card-body">
                        <h1>@lang('result_admin.password_generate')</h1>


                        @php
                            echo Form::open(array('url' => '/mailUpload','files'=>'true'));

                        @endphp
                        <div class="form-group">
                            <label for="separator">@lang('result_admin.delimeter')</label>
                            <select class="form-control" id="separator" name="separator">
                                <option value=",">@lang('result_admin.comma')</option>
                                <option value=";">@lang('result_admin.semicolon')</option>

                            </select>
                        </div>
                        @php
                            echo Form::file('image');
                            echo Form::submit('Upload File');
                            echo Form::close();
                        @endphp
                        {{--@csrf--}}
                    </div>
	                <hr>

                    <div class="card-body">

                        @php
                            echo  Form::open(array('action' => 'MailController@sendMail','files'=>'true'));

                        @endphp


                        <div id="colorsFormular">
                            <h1 class="mt-4">@lang('result_admin.mail_form')</h1>
                            <p>@lang('result_admin.form_purpose')</p>


	                        <label for="mailType">@lang('result_admin.email_type')</label>
	                        <select class="form-control" id="mailType" name="mailType" onchange="setMailType(this)">
		                        <option value="html">HTML</option>
		                        <option value="plain_text">Plain text</option>
	                        </select>

	                        <div class="form-group">
		                        <label for="separator">@lang('result_admin.delimeter')</label>
		                        <select class="form-control" id="separator" name="separator">
			                        <option value=",">@lang('result_admin.comma')</option>
			                        <option value=";">@lang('result_admin.semicolon')</option>

		                        </select>
                            </div>
                            <h3>@lang('result_admin.csv_mail')</h3>
                            @php
                                    
	                                 echo Form::file('image');
                            @endphp
                                    {{--echo    Form::label('subject', 'Predmet správy:');--}}
                                    {{--echo    Form::text('subject', null, array('class'=>'form-control'));--}}
                                   {{----}}
								   {{--echo    Form::label('farbaPrijemcaMailu', 'Príjemca:');--}}
								   {{--echo    Form::select('farbaPrijemcaMailu', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaIpAdresa', 'ip adresa:');--}}
								   {{--echo    Form::select('farbaIpAdresa',array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaSshPort', 'ssh port:');--}}
								   {{--echo    Form::select('farbaSshPort', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaHttpPort', 'http port:');--}}
								   {{--echo    Form::select('farbaHttpPort', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaHTTPSPort', 'https port:');--}}
								   {{--echo    Form::select('farbaHTTPSPort', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaMisc1', 'misc1 port:');--}}
								   {{--echo    Form::select('farbaMisc1', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaMisc2', 'misc2 port:');--}}
								   {{--echo    Form::select('farbaMisc2', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaLogin', 'prihlasovacie meno:');--}}
								   {{--echo    Form::select('farbaLogin', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}

								   {{--echo    Form::label('farbaHeslo', 'heslo:');--}}
								   {{--echo    Form::select('farbaHeslo', array('blue' => 'Modrá', 'red' => 'Červená', 'black' => 'Čierna'), 'black', array('class'=> 'form-control'));--}}


	                        <div class="form-group row mt-3">
		                        <div class="col-md-4">
			                        <input id="subject" type="text" placeholder="Predmet správy" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
		                        </div>
		                        <div class="col-md-4">
			                        <input id="email" type="email" placeholder="E-mail odosielatela" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

			                        @if ($errors->has('email'))
				                        <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
			                        @endif
		                        </div>
		                        <div class="col-md-4">
			                        <input id="odosielatelMailu" type="text" placeholder="Meno odosielatela" class="form-control" name="odosielatelMailu" value="{{ old('odosielatelMailu') }}" required autofocus>
		                        </div>
	                        </div>

								<div class="form-group row mt-3">
									<div class="col-md-3">
									   <label for="sablona">Šablóna</label>
										<select class="form-control" id="sablona" name="sablona">
											<option value="1">Šablona 1</option>
											<option value="2">Šablona 2</option>
											<option value="3">Šablona 3</option>
										</select>
									</div>
									<div class="col-md-3">
										<label for="colorText">Farba textu</label>
										<select class="form-control" id="colorText" name="colorText">
											<option value="black">Čierna</option>
											<option value="blue">Modrá</option>
											<option value="red">Červená</option>
											<option value="yellow">Žltá</option>
											<option value="white">Biela</option>
											<option value="green">Zelená</option>
										</select>
									</div>
									<div class="col-md-3">
										<label for="colorTextBlock">Farba textu v bloku</label>
										<select class="form-control" id="colorTextBlock" name="colorTextBlock">
											<option value="white">Biela</option>
											<option value="blue">Modrá</option>
											<option value="red">Červená</option>
											<option value="black">Čierna</option>
											<option value="yellow">Žltá</option>
											<option value="green">Zelená</option>

										</select>
									</div>
									<div class="col-md-3">
										<label for="colorBlock">Farba blokov</label>
										<select class="form-control" id="colorBlock" name="colorBlock">

											<option value="black">Čierna</option>
											<option value="blue">Modrá</option>
											<option value="red">Červená</option>
											<option value="yellow">Žltá</option>
											<option value="white">Biela</option>
											<option value="green">Zelená</option>
										</select>
									</div>
								</div>

	                        @php
		                        echo Form::submit('Odoslať email');
	                        @endphp
								<div class="form-group row mt-5">
									<div class="col-md-4 text-center">
										<h3>Šablóna 1</h3>
										<img src="{!! asset('img/sablona1.png') !!}" alt="Sablona 1" width="100%">
									</div>
									<div class="col-md-4 text-center">
										<h3>Šablóna 2</h3>
										<img src="{!! asset('img/sablona2.png') !!}" alt="Sablona 2" width="100%">
									</div>
									<div class="col-md-4 text-center">
										<h3>Šablóna 3</h3>
										<img src="{!! asset('img/sablona3.png') !!}" alt="Sablona 3" width="100%">
									</div>
								</div>

							</div>


								{{--echo    Form::label('odosielatel', 'Odosielatel:');--}}
								{{--echo    Form::text('odosielatelMailu', null, array('class'=>'form-control'));--}}
							@php

								echo Form::close();
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function setMailType(selectTag) {
            console.log("Selected value is: " + selectTag.options[selectTag.selectedIndex].value);
            var form = document.getElementById("colorsFormular");
            if(selectTag.options[selectTag.selectedIndex].value == "plain_text"){
                console.log("Hidden");
                form.style.display = "none";
            }else{
                console.log("Block");
                form.style.display = "block";
            }
        }
    </script>
@endsection