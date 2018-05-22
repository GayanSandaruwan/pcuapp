@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Patient <span class="fa fa-wheelchair"></span> </div>
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
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
