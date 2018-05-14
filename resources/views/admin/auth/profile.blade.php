@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Account</div>

                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="get" action="{{ url('/admin/register')}}">
                            {{ csrf_field() }}
                            <span style="color: #3c763d">Admin account successfully created</span>
                            <div class="form-group">
                                <label for="username-label" class="col-md-4 control-label">User Name : </label>
                                <div class="col-md-6">
                                    <label for="username" class="col-md-4 control-label">{{$admin->username}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name-label" class="col-md-4 control-label">Name : </label>
                                <div class="col-md-6">
                                    <label for="name" class="col-md-4 control-label">{{$admin->name}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status : </label>
                                <div class="col-md-6">
                                    <label for="status" class="col-md-4 control-label">Active</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-8">
                                    <button type="submit" class="btn btn-default" style="background-color: green; color: white">
                                        Add Another
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
