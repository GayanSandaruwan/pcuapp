@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Assessments <span class="fa fa-wheelchair"></span> </div>
                <div class="card-body" style="padding-top: 10%">
                    @foreach($assessments as $assessment)
                        <section id="dynamicContentWrapper-docsPanel" class="mb-5">
                            <div class="card border border-info z-depth-0">
                                <div class="card-body pb-0 text-center">
                                    <p>
                                        <strong>
                                            Name : {{$patient->name}}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong>
                                            Address : {{$patient->address}}
                                        </strong>
                                    </p>
                                    <form action="#" method="get" id="search-form" name="search-form" class="validate" target="_blank" novalidate="novalidate">

                                        <div class="row">
                                            <div class="col-lg-5 col-md-12">
                                                <div class="md-form">
                                                    <label for="date_created" class="">Date Created : {{$assessment->created_at}}</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="md-form">
                                                    <label for="complain" class="">Complain : {{$assessment->complain}}</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <a href="{{url("/nurse/assessment/print/")}}/{{$assessment->id}}" class="btn btn-outline-primary btn-md dc-panel-remove" id="docs-newsletter-removed">
                                                    View Reports<i class="fa fa-print ml-2"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#discharge-model">
                                                    <i class="fa fa-window-close ">Discharge</i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <div class="modal fade" id="discharge-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form id="modal-confirm-discharge" action="{{url("/nurse/patient/assessments/discharge")}}/{{$assessment->id}}" role="form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-content ">
                                        <div class="modal-header warning-color text-center">
                                            <h5 class="modal-title" id="exampleModalLabel" >Are you sure to discharge this patient ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row justify-content-md-center mb-3">
                                                <label for="name" class="col-md-3 ">Discharge note</label>

                                                <div class="col-md-6">
                                                    <textarea name="discharge_note" class="form-control rounded-0" id="discharge_note" rows="3"></textarea>
                                                    @if ($errors->has('discharge_note'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('discharge_note') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="row justify-content-md-center{{ $errors->has('condition') ? ' text-danger' : '' }} mb-3">
                                                    <label for="name" class="col-md-3">Condition</label>

                                                    <div class="col-md-6">
                                                        <label class="btn btn-info" >
                                                            <input name="condition" id="condition" value="false" type="radio"> Normal
                                                        </label>
                                                        <label class="btn btn-info">
                                                            <input name="condition" id="condition" value="true" type="radio"> Critical
                                                        </label>
                                                        @if ($errors->has('condition'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('condition') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">
                                                Discharge <i class="fa fa-window-close ml-2"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
