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
                                        <div class="text-center font-weight-bold">
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                                <input name="b_461480655ccce528d909d3f42_0e60d6d505" tabindex="-1" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-12">
                                                <div class="md-form">
                                                    <label for="admission_no" class="">Date Created : {{$assessment->created_at}}</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="md-form">
                                                    <label for="contact_no" class="">Contact: {{$assessment->complain}}</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <a href="{{url("/nurse/assessment/print/")}}/{{$assessment->id}}" class="btn btn-outline-primary btn-md dc-panel-remove" id="docs-newsletter-removed">
                                                    View Reports<i class="fa fa-print ml-2"></i>
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
