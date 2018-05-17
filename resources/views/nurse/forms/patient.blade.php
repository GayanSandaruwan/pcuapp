@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card card-default" >
                    <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Patient <span class="fa fa-wheelchair"></span> </div>
                    <div class="card-body" style="padding-top: 10%">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/patient/add') }}">
                            {{ csrf_field() }}

                            <div class="row justify-content-md-center{{ $errors->has('admission_no') ? ' text-danger' : '' }} mb-3">
                                <label for="admission_no" class="col-md-3">Admission No</label>

                                <div class="col-md-6">
                                    <input id="admission_no" type="text" class="form-control" name="admission_no" value="{{ old('admission_no') }}" autofocus>

                                    @if ($errors->has('admission_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('admission_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('name') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3 ">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('birthday') ? ' text-danger' : '' }} mb-3">
                                <label for="grade" class="col-md-3">Birthday</label>

                                <div class="col-md-6">
                                    {{--<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-start-date="-12y">--}}

                                    <input type="text" class="form-control datepicker" id='birthday' name='birthday' placeholder="dd/mm/yyyy" value="{{old('birthday')}}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>

                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    $('.datepicker').datepicker({
                                        format: 'dd-mm-yyyy',
                                        startDate: '-10y',
                                        autoclose : true
                                    });
                                </script>

                            </div>
                          <!-- Button trigger modal -->
                            <div class="row justify-content-md-center{{ $errors->has('birthday') ? ' text-danger' : '' }} mb-3">
                                <div class="col-md-6 offset-md-3">
                                <button type="button" class="btn btn-green" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-calendar-alt ">Calc Birthday from Age</i>
                                </button>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Birthday from age</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-md-center mb-3">
                                                <label for="name" class="col-md-3 ">Years</label>

                                                <div class="col-md-6">
                                                    <input id="years" type="number" class="form-control" name="years" value="{{old('years')}}">

                                                    @if ($errors->has('years'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('years') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mb-3">
                                                <label for="name" class="col-md-3 ">Months</label>

                                                <div class="col-md-6">
                                                    <input id="months" type="number" class="form-control" name="months" value="{{old('months')}}">

                                                    @if ($errors->has('months'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('months') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mb-3">
                                                <label for="name" class="col-md-3 ">Days</label>

                                                <div class="col-md-6">
                                                    <input id="days" type="number" class="form-control" name="days" value="{{old('days')}}">

                                                    @if ($errors->has('days'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('days') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="set_birthday" data-dismiss="modal" class="btn btn-primary">Save changes</button>
                                        </div>
                                        <script type="text/javascript">
                                            $('#set_birthday').click(function(){
                                                var years = document.getElementById("years").value;
                                                var months = document.getElementById("months").value;
                                                var days = document.getElementById("days").value;
                                                if(years === ''){
                                                    years = 0;
                                                }
                                                if(months === ''){
                                                    months = 0;
                                                }
                                                if(days === ''){
                                                    days = 0;
                                                }
                                                var birthday = new Date();
                                                var now = new Date();
                                                birthday.setFullYear(now.getFullYear()-years);
                                                birthday.setMonth(now.getMonth() - months);
                                                birthday.setDate(now.getDate() - days);

                                                var month = String(birthday.getMonth() + 1);
                                                var day = String(birthday.getDate());
                                                var year = String(birthday.getFullYear());

                                                if (month.length < 2) month = '0' + month;
                                                if (day.length < 2) day = '0' + day;
                                                var birthday_str = day+"-"+month+"-"+year;
                                                $('#birthday').val(birthday_str);
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('gender') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3">Gender</label>

                                <div class="col-md-6">
                                    <label class="btn btn-info" >
                                        <input checked="checked" name="gender" id="gender" value="male" type="radio"> Male
                                    </label>
                                    <label class="btn btn-info">
                                        <input name="gender" id="gender" value="female" type="radio"> Female
                                    </label>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('address') ? ' text-danger' : '' }} mb-3">
                                <label for="address" class="col-md-3">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{old('address')}}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('area') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3">Area</label>

                                <div class="col-md-6">
                                    <label class="btn btn-info" style="padding-left: 3%; padding-right: 3%" >
                                        <input checked="checked" name="area" id="area" value="colombo" type="radio"> Colombo
                                    </label>
                                    <label class="btn btn-info" style="padding-left: 3%; padding-right: 3%">
                                        <input name="area" id="area" value="colombo municipal" type="radio"> Col. Muni.
                                    </label>
                                    <label class="btn btn-info" style="padding-left: 5%; padding-right: 5%" >
                                        <input checked="checked" name="area" id="area" value="out" type="radio">Out
                                    </label>
                                    @if ($errors->has('area'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>

                                </div>
                            </div>



                        </form>
                    </div>
                    <div class="card-footer text-muted success-color white-text">
                            <div class="progress" >
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="2"
                                     aria-valuemin="0" aria-valuemax="100" style="width:2%; background-color: #34b5ff; color: black">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
