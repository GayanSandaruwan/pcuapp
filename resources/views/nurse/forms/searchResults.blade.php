@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Patients <span class="fa fa-wheelchair"></span> </div>
                <div class="card-body" style="padding-top: 10%">
                    <div class="row justify-content-md-center{{ $errors->has('search') ? ' text-danger' : '' }} mb-3">
                        <form class="form-inline md-form form-sm active-cyan active-cyan-6" role="form" method="POST" action="{{ url('/nurse/search') }}">
                            {{ csrf_field() }}
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" id="search" name="search" placeholder="Name or Admission number" aria-label="Search">
                            <div class="col-md-8">
                                <button class="btn btn-outline-warning col-md-8" style="border-radius: 50px;" type="submit">Search</button>

                                @if ($errors->has('search'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('search') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </form>

                    </div>
                    @foreach($patients as $patient)
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
                                <form action="{{url("/nurse/assessment/new/")}}/{{$patient->admission_id}}" method="get" id="search-form" name="search-form" class="validate" target="_blank" novalidate="novalidate">
                                    <div class="text-center font-weight-bold">
                                        <div id="mce-responses" class="clear">
                                            <div class="response p-4" id="mce-error-response" style="display:none">

                                            </div>
                                            <div class="response p-4" id="mce-success-response" style="display:none">

                                            </div>
                                        </div>
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                            <input name="b_461480655ccce528d909d3f42_0e60d6d505" tabindex="-1" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="md-form">
                                                <label for="admission_no" class="">Admission No : {{$patient->admission_no}}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="md-form">
                                                <label for="contact_no" class="">Contact No : {{$patient->contact_no}}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <input value="Add Assessment" name="add_assessment" id="add_assessment" class="btn btn-primary btn-md" type="submit">
                                            <a href="{{url("/nurse/patient/assessments/")}}/{{$patient->admission_id}}" class="btn btn-outline-primary btn-md dc-panel-remove" id="docs-newsletter-removed">
                                                View Reports<i class="fa fa-list ml-2"></i>
                                            </a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
