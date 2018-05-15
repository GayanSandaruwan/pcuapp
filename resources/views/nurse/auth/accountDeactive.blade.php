@extends('nurse.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-color: red">Account Disabled</div>

                    <div class="panel-body">
                         <span style="color: red">This Account is deactivated. Please contact an administrator if you should be in the system anymore</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
