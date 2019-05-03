@extends('layouts.login-template')

@section('content')
<div class="mb-30">
    <img style="max-width: 100%" src="https://www.luxemontre.sg/wp-content/uploads/2018/12/LM.png" alt="">
    <h4 class="text-center">Luxe Montre CRM</h4>
    <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
</div>	
<div class="form-wrap">
    <form method="POST" action="{{ route('login') }}">
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
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
            <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('password.request') }}">forgot password ?</a>
            <div class="clearfix"></div>
            <input id="password" type="password" class="form-control" name="password" required placeholder="Enter pwd">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        
        <div class="form-group">
            <div class="checkbox checkbox-primary pr-10 pull-left">
                <input id="checkbox_2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="checkbox_2"> Keep me logged in</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-gold  btn-rounded">sign in</button>
        </div>
    </form>
</div>
@endsection
