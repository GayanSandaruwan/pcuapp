@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 float-md-none mx-auto">
                <div class="card card-default">
                    <div class="card-header success-color white-text">Login : Nurse</div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/login') }}">
                            {{ csrf_field() }}

                            <div class="row justify-content-md-center mb-3{{ $errors->has('username') ? ' text-danger' : '' }}">
                                <label for="username" class="col-md-3">User Name</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center mb-3{{ $errors->has('password') ? ' text-danger' : '' }}">
                                <label for="password" class="col-md-3">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center mb-3">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center mb-3">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
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
