@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Nurses Accounts</div>

                    <div class="panel-body">

                            @foreach($nurses as $nurse)
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/update/nurse/accounts')}}">
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label for="username-label" class="col-md-4 control-label">User Name : </label>
                                    <input type="hidden" id="nurse_id" name="nurse_id" value="{{$nurse->id}}" id="nurse_id">
                                    <div class="col-md-6">
                                        <label for="username" class="col-md-4 control-label">{{$nurse->username}}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name-label" class="col-md-4 control-label">Name : </label>
                                    <div class="col-md-6">
                                        <label for="name" class="col-md-4 control-label">{{$nurse->name}}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-md-4 control-label">Status : </label>
                                    <div class="col-md-6">
                                        <label for="status" class="col-md-4 control-label">{{$nurse->status}}</label>
                                    </div>
                                </div>
                                @if(strcmp($nurse->status,"active")==0)
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-8">
                                        <button type="submit" class="btn btn-danger">
                                            De Activate
                                        </button>
                                    </div>
                                </div>
                                    @else
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-8">
                                            <button type="submit" class="btn btn-default" style="background-color: green; color: white">
                                                Activate
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
