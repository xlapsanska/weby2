@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('result_admin.division_tasks')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
	                    <table class="table">
		                    <thead>
		                    <tr>
			                    <th scope="col">#</th>
			                    <th scope="col">@lang('result_admin.full_name')</th>
			                    <th class="text-center" scope="col">@lang('result_admin.tasks') 1</th>
			                    <th class="text-center" scope="col">@lang('result_admin.tasks') 2</th>
			                    <th class="text-center" scope="col">@lang('result_admin.tasks') 3</th>
			                    <th class="text-center" scope="col">@lang('result_admin.language_add')</th>
			                    <th class="text-center" scope="col">@lang('result_admin.login')</th>
			                    <th class="text-center" scope="col">@lang('result_admin.distribution_privileges')</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <tr>
			                    <th scope="row">1</th>
			                    <td class="text-left">Dominik Janecký</td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
		                    </tr>
		                    <tr>
			                    <th scope="row">2</th>
			                    <td class="text-left">Lea Lapšanská</td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
		                    </tr>
		                    <tr>
			                    <th scope="row">3</th>
			                    <td class="text-left">Štefan Daňo</td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
		                    </tr>
		                    <tr>
			                    <th scope="row">4</th>
			                    <td class="text-left">Paulína Kluvancová</td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
		                    </tr>
		                    <tr>
			                    <th scope="row">5</th>
			                    <td class="text-left">Miloš Medo</td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
			                    <td class="text-center"></td>
			                    <td class="text-center"></td>
		                    </tr>
		                    </tbody>
	                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
