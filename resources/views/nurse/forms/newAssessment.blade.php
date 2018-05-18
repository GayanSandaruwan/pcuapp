@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card card-default" >
                    <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Assessment Record <span class="fa fa-address-card"></span> </div>
                    <div class="card-body" style="padding-top: 10%">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/assessment/new') }}">
                            {{ csrf_field() }}

                            <div class="row justify-content-md-center mb-3">
                                <label for="admission_no" class="col-md-3">Addmission No</label>

                                <div class="col-md-6">
                                    <input id="admission_no" type="text" disabled class="form-control" name="admission_no" value="{{ $patient->admission_no}}" autofocus>
                                    <input id="patient_id" type="text" hidden class="form-control" name="patient_id" value="{{ $patient->id}}" autofocus>
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('complain') ? ' text-danger' : '' }} mb-3">
                                <label for="complain" class="col-md-3">Presenting complain</label>

                                <div class="col-md-6">
                                    <input id="complain" type="text" class="form-control" name="complain" value="{{ old('complain') }}" autofocus>

                                    @if ($errors->has('complain'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('complain') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('resp_rate') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3 ">Resp. Rate</label>

                                <div class="col-md-6">
                                    <input id="resp_rate" type="number" class="form-control" name="resp_rate" value="{{old('resp_rate')}}" min="0" max="300" required>

                                    @if ($errors->has('resp_rate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('resp_rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('spo2') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3 ">SPO2</label>

                                <div class="col-md-6">
                                    <input id="spo2" type="number" class="form-control" name="spo2" value="{{old('spo2')}}" min="0" max="100" required>

                                    @if($errors->has('spo2'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('spo2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center{{ $errors->has('heart_rate') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3 ">Heart Rate</label>

                                <div class="col-md-6">
                                    <input id="heart_rate" type="number" class="form-control" name="heart_rate" value="{{old('heart_rate')}}" min="0" max="300" required>

                                    @if ($errors->has('heart_rate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('heart_rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('systolic_bp') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3 ">Systolic bp</label>

                                <div class="col-md-6">
                                    <input id="systolic_bp" type="number" class="form-control" name="systolic_bp" value="{{old('systolic_bp')}}" min="0" max="300" required>

                                    @if ($errors->has('systolic_bp'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('systolic_bp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('resp_effort') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3">Resp. Effort</label>

                                <div class="col-md-6">
                                    <label class="btn btn-default" style="padding-left: 5%; padding-right: 5%" >
                                        <input checked="checked" name="resp_effort" id="resp_effort" value="mild" type="radio"> Mild
                                    </label>
                                    <label class="btn btn-info" style="padding-left: 3%; padding-right: 3%">
                                        <input name="resp_effort" id="resp_effort" value="moderate" type="radio"> Moderate
                                    </label>
                                    <label class="btn btn-danger" style="padding-left: 4%; padding-right: 4%">
                                        <input name="resp_effort" id="resp_effort" value="moderate" type="radio"> Severe
                                    </label>
                                    @if ($errors->has('resp_effort'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('resp_effort') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('o2_liters') ? ' text-danger' : '' }} mb-3">
                                <label for="name" class="col-md-3">O2 liters</label>

                                <div class="col-md-6">
                                    <label class="btn btn-danger" >
                                        <input checked="checked" name="o2_liters" id="o2_liters" value="<2L" type="radio"> < 2L
                                    </label>
                                    <label class="btn btn-default">
                                        <input name="o2_liters" id="o2_liters" value=">2L" type="radio"> >2L
                                    </label>
                                    @if ($errors->has('o2_liters'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('o2_liters') }}</strong>
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
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40"
                                 aria-valuemin="40" aria-valuemax="100" style="width:40%; background-color: #34b5ff; color: black"> Patient details added
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
