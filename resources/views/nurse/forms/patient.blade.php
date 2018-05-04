@extends('nurse.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Patient <span class="fa fa-address-card"></span> </div>
                    <div class="panel-body" style="padding-top: 10%">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/patient/add') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('admission_no') ? ' has-error' : '' }}">
                                <label for="admission_no" class="col-md-4 control-label">Admission No</label>

                                <div class="col-md-6">
                                    <input id="admission_no" type="text" class="form-control" name="admission_no" value="{{ old('admission_no') }}" autofocus>

                                    @if ($errors->has('admission_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('admission_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="password" class="form-control" name="name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="grade" class="col-md-4 control-label">Birthday</label>

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

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>

                                </div>
                            </div>

                            <div class="form-group" style="padding:5% ">
                                <div class="progress" >
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="2"
                                         aria-valuemin="0" aria-valuemax="100" style="width:2%; background-color: #34b5ff; color: black">
                                        Filling patient details (info)
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
