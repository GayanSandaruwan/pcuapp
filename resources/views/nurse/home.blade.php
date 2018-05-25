@extends('nurse.layout.auth')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 float-md-none mx-auto">
            <div class="card panel-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    You are logged in as Nurse!
                    @foreach($critical_patients as $critical_patient)
                        <section id="dynamicContentWrapper-docsPanel" class="mb-5" >
                            <div class="card border border-info z-depth-0">
                                <div class="card-body pb-0 text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <strong>
                                                    Name : {{$critical_patient["patient"]->name}}
                                                </strong>
                                            </p>
                                        </div>
                                       <div class="col-md-6"><p>
                                               <strong>
                                                   Address : {{$critical_patient["patient"]->address}}
                                               </strong>
                                           </p></div>
                                    </div>
                                    <p>
                                        <strong>
                                            Total Score : {{$critical_patient["score"]["total"]}}
                                        </strong>
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <strong>
                                                    Observation Frequency : {{$critical_patient["recomendation"]["observe_frequency"]}}
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <strong>
                                                    Recomended To : {{$critical_patient["recomendation"]["response"]}}
                                                </strong>
                                            </p>
                                        </div>
                                    </div>



                                    <form action="{{url("/nurse/assessment/new/")}}/{{$critical_patient["assessment"]->admission_id}}" method="get" id="search-form" name="search-form" class="validate" target="_blank" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input value="Add Assessment" name="add_assessment" id="add_assessment" class="btn btn-primary btn-md" type="submit">
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{url("/nurse/patient/assessments/")}}/{{$critical_patient["assessment"]->admission_id}}" class="btn btn-outline-primary btn-md dc-panel-remove" id="docs-newsletter-removed">
                                                    View Reports<i class="fa fa-list ml-2"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-green" data-toggle="modal" data-target="#discharge-model">
                                                    <i class="fa fa-window-close ">Discharge</i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="admission_no" class="">Admission No : {{$critical_patient["admission"]["admission_no"]}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="contact_no" class="">Contact No : {{$critical_patient["patient"]->contact_no}}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <!-- Modal -->
                        <div class="modal fade" id="discharge-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form id="modal-confirm-discharge" action="{{url("/nurse/patient/assessments/discharge")}}/{{$critical_patient["assessment"]->id}}" role="form" method="POST">
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
                                        <button type="submit" class="btn btn-primary">
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
