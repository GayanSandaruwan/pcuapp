@extends('nurse.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 float-md-none mx-auto">
                <div class="card card-default">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nurse/password/reset') }}">
                            {{ csrf_field() }}

                            <div class="row justify-content-md-center mb-3{{ $errors->has('password') ? ' text-danger' : '' }}">
                                <label for="message" class="col-md-3" style="font-family: bold">Enter new password</label>
                            </div>

                            <div class="row justify-content-md-center mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
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

                            <div class="row justify-content-md-center mb-3{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-3">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center mb-3">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
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
