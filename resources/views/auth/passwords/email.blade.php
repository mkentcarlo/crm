@extends('layouts.login-template')

@section('content')
<div class="mb-30">
    <h3 class="text-center txt-dark mb-10">Reset Password</h3>
    <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
</div>	

<div class="form-wrap">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Enter email">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-gold  btn-rounded">Send Password Reset Link</button>
        </div>
    </form>
</div>
@endsection
