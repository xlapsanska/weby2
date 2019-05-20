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
                    <div class="card-header">@lang('result_admin.add_students')</div>

                    <div class="card-body">

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

                    <div class="card-body">

                        @php
                            echo    Form::open(array('action' => 'MailController@sendMail'));
                        @endphp

                        <label for="mailType">Vyberte typ odosielaneho mailu:</label>
                        <select class="form-control" id="mailType" name="mailType" onchange="setMailType(this)">
                            <option value="html">HTML</option>
                            <option value="plain_text">Plain text</option>
                        </select>

                        <div id="colorsFormular">
                            <h1>Formular</h1>
                            <p>Tento formulár slúži na nastavenie farby textu jednotlivých položiek emailu.</p>

                            @php
                                echo    Form::label('farbaPrijemcaMailu', 'Prijemca:');
                                echo    Form::select('farbaPrijemcaMailu', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaIpAdresa', 'ip adresa:');
                                echo    Form::select('farbaIpAdresa',array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaSshPort', 'ssh port:');
                                echo    Form::select('farbaSshPort', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaHttpPort', 'http port:');
                                echo    Form::select('farbaHttpPort', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaHTTPSPort', 'https port:');
                                echo    Form::select('farbaHTTPSPort', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaMisc1', 'misc1 port:');
                                echo    Form::select('farbaMisc1', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaMisc2', 'misc2 port:');
                                echo    Form::select('farbaMisc2', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaLogin', 'prihlasovacie meno:');
                                echo    Form::select('farbaLogin', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                                echo    Form::label('farbaHeslo', 'heslo:');
                                echo    Form::select('farbaHeslo', array('blue' => 'Modra', 'red' => 'Cervena', 'black' => 'Cierna'), 'black', array('class'=> 'form-control'));

                            @endphp

                        </div>

                        @php
                            echo    Form::label('odosielatel', 'Odosielatel:');
                            echo    Form::text('odosielatelMailu', null, array('class'=>'form-control'));

                            echo Form::submit('Send mail');
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