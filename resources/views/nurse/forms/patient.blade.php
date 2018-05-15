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
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" id='birthday' name='birthday' value="{{old('birthday')}}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    $('#birthday').datepicker({
                                        format: 'mm/dd/yyyy',
                                        startDate: '-12y'
                                    });
                                </script>
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
                                    <label class="btn btn-info" >
                                        <input checked="checked" name="area" id="area" value="male" type="radio"> Colombo
                                    </label>
                                    <label class="btn btn-info">
                                        <input name="area" id="area" value="area" type="radio"> Colombo Muni
                                    </label>
                                    <label class="btn btn-info" >
                                        <input checked="checked" name="area" id="area" value="male" type="radio">Out
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
