@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-7 float-md-none mx-auto">
                <div class="card card-default" >
                    <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Select date range for patient register <span class="fa fa-calendar-alt"></span> </div>
                    <div class="card-body" style="padding-top: 10%">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/patient/admission/register') }}">
                            {{ csrf_field() }}


                            <div class="row justify-content-md-center{{ $errors->has('birthday') ? ' text-danger' : '' }} mb-3">
                                <label for="grade" class="col-md-3">Start Date (From)</label>

                                <div class="col-md-6">
                                    {{--<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-start-date="-12y">--}}

                                    <input type="text" class="form-control datepicker1" id='start_date' name='start_date' placeholder="dd/mm/yyyy" value="{{old('birthday')}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    $('.datepicker1').datepicker({
                                        format: 'dd-mm-yyyy',
                                        startDate: '-10y',
                                        autoclose : true
                                    });
                                </script>

                            </div>
                            <div class="row justify-content-md-center{{ $errors->has('end_date') ? ' text-danger' : '' }} mb-3">
                                <label for="grade" class="col-md-3">End Date (To)</label>

                                <div class="col-md-6">
                                    {{--<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-start-date="-12y">--}}

                                    <input type="text" class="form-control datepicker2" id='end_date' name='end_date' placeholder="dd/mm/yyyy" value="{{old('end_date')}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    $('.datepicker2').datepicker({
                                        format: 'dd-mm-yyyy',
                                        startDate: '-10y',
                                        autoclose : true
                                    });
                                </script>

                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
