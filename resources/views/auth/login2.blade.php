@extends('layouts.app')

@section('content')
	<div class="container-fluid">
	<div class="singin">
		<form method="POST" class="form-signin" action="{{ route('login') }}">
			@csrf

			<h1 class="mb-4 font-weight-normal text-center">Prihlásenie</h1>
			<input id="username" type="username" placeholder="@lang('result_admin.username')" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

			@if ($errors->has('username'))
				<span class="invalid-feedback" role="alert">
					                    <strong>{{ $errors->first('username') }}</strong>
					                </span>
			@endif

			<input id="password" type="password" placeholder="@lang('result_admin.password')" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

			@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror

			<div class="checkbox mb-4 text-center">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

					<label class="form-check-label" for="remember">
						@lang('result_admin.remember')
					</label>
				</div>
			</div>
			{{--</div>--}}

			<div class="form-group text-center">
				<button type="submit" class="btn btn-lg btn-primary btn-block">
					@lang('result_admin.login_button')
				</button>
				{{--<li class="nav-item">--}}
					{{--<a class="nav-link text-grey-800" href="locale/sk">{{ __('SK') }}</a>--}}
				{{--</li>--}}
				{{--<li class="nav-item  text-grey-800 mr-5">--}}
					{{--<a class="nav-link" href="locale/en">{{ __('EN') }}</a>--}}
				{{--</li>--}}
			</div>
		</form>
	</div>
	</div>


{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">@lang('result_admin.login')</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}">--}}
                        {{--@csrf--}}

	                    {{--<div class="form-group row">--}}
		                    {{--<label for="username" class="col-sm-4 col-form-label text-md-right">@lang('result_admin.username')</label>--}}
		                    {{--<div class="col-md-6">--}}
			                    {{--<input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>--}}
			                    {{--@if ($errors->has('username'))--}}
				                    {{--<span class="invalid-feedback" role="alert">--}}
					                    {{--<strong>{{ $errors->first('username') }}</strong>--}}
					                {{--</span>--}}
			                    {{--@endif--}}
		                    {{--</div>--}}
	                    {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">@lang('result_admin.password')</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

                                {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                            {{--@lang('result_admin.remember')--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--@lang('result_admin.login_button')--}}
                                {{--</button>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
