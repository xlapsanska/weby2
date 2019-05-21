<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WebTe2') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	{{--<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>--}}
	{{--<link href="{{ asset('css/signin.css') }}" rel="stylesheet">--}}
	{{--<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>--}}
	{{--<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>--}}

	{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">--}}
	{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
	{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>--}}
	{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>--}}
	{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">--}}
	{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>--}}
	{{--<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>--}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

	<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
  

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.min.css">

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" defer></script>
    <script src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js" defer></script>
    <script src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.js" defer></script>

    {{-- <script src ="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js" defer></script> --}}

    {{-- <script src="{!! asset('vendor/DataTables/datatables.js') !!}" defer></script> --}}
    <script type="text/javascript" src="{!! asset('js/datatable.js') !!}" defer></script>
    {{--<script type="text/javascript" src="{!! asset('js/script.js') !!}" defer></script>--}}
    {{-- <style>
        .print-btn {
    display: inline-block !important;
    font-weight: 400 !important;
    text-align: center !important;
    white-space: nowrap !important;
    vertical-align: middle !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
    user-select: none !important;
    border: 1px solid transparent !important;
    padding: .375rem .75rem !important;
    font-size: .9rem !important;
    line-height: 1.6 !important;
    border-radius: .25rem !important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
}

.print-btn-secondary {
    color: #fff !important;
    background-color: #6c757d !important;
    border-color: #6c757d !important;
}
    </style> --}}
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'WebTe2') }}
                </a>
	            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		            <span class="navbar-toggler-icon"></span>
	            </button>


	            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth

						@if(\Illuminate\Support\Facades\Auth::user()->isAdmin)
	                    <ul class="navbar-nav mr-auto">
		                    <li class="nav-item">
			                    <a class="nav-link" href="{{ route('home') }}">@lang('result_admin.division_tasks')</a>
		                    </li>
		                    <li class="nav-item">
			                    <a class="nav-link" href="{{ route('downloadPDF') }}">@lang('result_admin.download_pdf')</a>
		                    </li>
	                        {{--<li class="nav-item">--}}
	                            {{--<a class="nav-link" href="{{ route('resultAdmin-create') }}">@lang('result_admin.add_subject')</a>--}}
	                        {{--</li>--}}
		                    <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                        @lang('result_admin.tasks') 1
			                    </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
				                    <a class="dropdown-item" href="{{ route('resultAdmin-create') }}">@lang('result_admin.add_subject')</a>
				                    <a class="dropdown-item" href="{{ route('resultAdmin-index') }}">@lang('result_admin.all_subjects')</a>
			                    </div>
		                    </li>

	                        {{--<li class="nav-item">--}}
	                            {{--<a class="nav-link" href="{{ route('resultAdmin-index') }}">@lang('result_admin.all_subjects')</a>--}}
	                        {{--</li>--}}
		                    <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                    @lang('result_admin.tasks') 2
			                    </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				                    <a class="dropdown-item" href="{{ route('teamAdmin-create') }}">@lang('result_admin.add_students')</a>
				                    <a class="dropdown-item" href="{{ route('teamPointAll-create') }}">@lang('result_admin.add_points')</a>
			                    </div>
		                    </li>
		                    {{--<li class="nav-item">--}}
			                    {{--<a class="nav-link" href="{{ route('teamAdmin-create') }}">@lang('result_admin.add_students')</a>--}}
                            {{--</li>--}}
		                    {{--<li class="nav-item">--}}
			                    {{--<a class="nav-link" href="{{ route('teamPointAll-create') }}">@lang('result_admin.add_points')</a>--}}
		                    {{--</li>--}}
                            <li class="nav-item">
			                    <a class="nav-link" href="{{ route('mailAdmin-create') }}">@lang('result_admin.send_emails')</a>
		                    </li>

	                    </ul>
	                    @else
		                    <ul class="navbar-nav mr-auto">
			                    <li class="nav-item">
				                    <a class="nav-link" href="{{ route('home') }}">@lang('result_admin.division_tasks')</a>
			                    </li>
			                    <li class="nav-item">
				                    <a class="nav-link" href="{{ route('downloadPDF') }}">@lang('result_admin.download_pdf')</a>
			                    </li>
			                    <li class="nav-item">
				                    <a class="nav-link" href="{{ route('resultStudent-index') }}">@lang('result_admin.show_results')</a>
			                    </li>
			                    <li class="nav-item">
				                    <a class="nav-link" href="{{ route('pointStudent-create') }}">@lang('result_admin.add_points')</a>
			                    </li>

		                    </ul>
	                    @endif

	                @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
		                    <li class="nav-item">
			                    <a class="nav-link text-grey-800" href="locale/sk">{{ __('SK') }}</a>
		                    </li>
		                    <li class="nav-item  text-grey-800 mr-5">
			                    <a class="nav-link" href="locale/en">{{ __('EN') }}</a>
		                    </li>
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('result_admin.login')</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('result_admin.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
	                    @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
       
    </div>

    
</body>

</html>