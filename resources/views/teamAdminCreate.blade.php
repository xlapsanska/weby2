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
            <div class="card">
                <div class="card-header">Pridanie tímov</div>

                <div class="card-body">

                    @php
                    echo Form::open(array('url' => '/uploadfileteam','files'=>'true'));

                    @endphp
                    <div class="form-group">
                        <label for="year">Školský rok</label>
                        <select class="form-control" id="year" name="year">
                            <option value="2018/2019">2018/2019</option>
                            <option value="2017/2018">2017/2018</option>
                            <option value="2016/2017">2016/2017</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Predmet</label>
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp"
                            placeholder="Zadajte názov predmetu">

                    </div>
                    <div class="form-group">
                        <label for="separator">Oddelovač</label>
                        <select class="form-control" id="separator" name="separator">
                            <option value=",">, (čiarka)</option>
                            <option value=";">; (bodkočiarka)</option>

                        </select>
                    </div>
                    @php
                    echo Form::file('image');
                    echo Form::submit('Upload File');
                    echo Form::close();
                    @endphp


                </div>
            </div>
        </div>
    </div>
</div>
@endsection