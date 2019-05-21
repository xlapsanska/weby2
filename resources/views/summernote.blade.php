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

					    </tr>
					    </thead>
					    <tbody>
					    @foreach($mails as $mail)
							    <tr>
								    <td>{{ $mail->datum }}</td>
								    <td>{{ $mail->meno_studenta }}</td>
								    <td>{{ $mail->predmet_spravy }}</td>
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


	                    <form action="{{route('summernotePersist')}}" method="POST">
		                    {{ csrf_field() }}
		                    <textarea name="summernoteInput" class="summernote"></textarea>
		                    <br>
		                    <button type="submit">Submit</button>
	                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection