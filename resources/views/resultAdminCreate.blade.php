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

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('result_admin.add_results')</div>

                <div class="card-body">

                    @php
                    echo Form::open(array('url' => '/uploadfile','files'=>'true'));

                    @endphp
                    <div class="form-group">
                        <label for="year">@lang('result_admin.school_year')</label>
                        <select class="form-control" id="year" name="year">
                            <option value="2018/2019">2018/2019</option>
                            <option value="2017/2018">2017/2018</option>
                            <option value="2016/2017">2016/2017</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">@lang('result_admin.subject')</label>
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp"
                            placeholder="@lang('result_admin.subject_name')">

                    </div>
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
                    <!-- <form action="{{ route('resultAdmin-store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="year">Školský rok</label>
                            <select class="form-control" id="year" name="year">
                                <option value="2019">2018/2019</option>
                                <option value="2018">2017/2018</option>
                                <option value="2017">2016/2017</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Predmet</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                aria-describedby="emailHelp" placeholder="Zadajte názov predmetu">

                        </div>
                        <div class="form-group">
                        
                            <label for="file">Vyber súbor</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="separator">Oddelovač</label>
                            <select class="form-control" id="separator" name="separator">
                                <option value="c">, (čiarka)</option>
                                <option value="b">; (bodkočiarka)</option>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Odoslať</button>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection