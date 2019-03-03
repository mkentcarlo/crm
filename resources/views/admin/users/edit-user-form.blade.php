<form id="edit-user" class="user-info" method="POST" action="{{ url('users/update') }}">
{{ csrf_field() }}
<input name="id" value="{{$user->id}}" type="hidden" />
<h6 class="txt-dark capitalize-font"><i class="fa fa-user mr-10"></i>Edit user</h6>
<hr class="light-grey-hr">


@if(session('msg')!="")
<script>
    swal({   
			title: "{{session('msg')}}",   
            confirmButtonColor: "#2196F3",   
            type: "success", 
        });
</script>
@endif
<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label class="control-label mb-10" for="exampleInputuname_1">Username</label>
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
    <div class="input-group">
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username or old('username') }}" />
        <div class="input-group-addon"><i class="icon-user"></i></div>
    </div>
    @if ($errors->has('username'))
        <span class="help-block">
            <strong>{{ $errors->first('username') }}</strong>
        </span>
    @endif
</div>
<div class="form-group row">
    <div class="col-md-6{{ $errors->has('firstname') ? ' has-error' : '' }}">
        <label class="control-label mb-10" for="first_name">First Name</label>
        <div class="input-group">
        <input type="text" class="form-control" name="firstname" id="first_name" value="{{ $user->firstname or old('firstname') }}">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        </div>
        @if ($errors->has('firstname'))
            <span class="help-block">
                <strong>{{ $errors->first('firstname') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6{{ $errors->has('lastname') ? ' has-error' : '' }}">
        <label class="control-label mb-10" for="last_name">Last Name</label>
        <div class="input-group">
        <input type="text" class="form-control" name="lastname" id="last_name" value="{{ $user->lastname or old('lastname')  }}">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        </div>
        @if ($errors->has('lastname'))
            <span class="help-block">
                <strong>{{ $errors->first('lastname') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="control-label mb-10" for="exampleInputuname_1">Email Address</label>
    <div class="input-group">
    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email or old('email') }}">
    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
    </div>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
    <label class="control-label mb-10" for="contact">Contact Number</label>
    <div class="input-group">
    <input type="text" class="form-control" id="contact" name="contact" value="{{ $user->contact or old('contact') }}">
    <div class="input-group-addon"><i class="icon-phone"></i></div>
    </div>
    @if ($errors->has('contact'))
        <span class="help-block">
            <strong>{{ $errors->first('contact') }}</strong>
        </span>
    @endif
</div>
<div class="form-group row">
    <div class="col-md-6{{ $errors->has('position') ? ' has-error' : '' }}">
        <label class="control-label mb-10" for="position">Position</label>
        <div class="input-group">
        <input type="text" class="form-control" id="position" name="position" value="{{ $user->position or old('position') }}">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        </div>
        @if ($errors->has('position'))
            <span class="help-block">
                <strong>{{ $errors->first('position') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
    <label class="control-label mb-10" for="position">Role</label>
    <div class="input-group">
    <select name="" id="" class="form-control">
        <option>Administrator</option>
        <option>Editor</option>
        <option>Sales Person</option>
    </select>
    <div class="input-group-addon"><i class="icon-user"></i></div>
    </div>
    <span class="help-block"> Select your role </span>
    </div>
</div>
<div class="form-group row{{ $errors->has('position') ? ' has-error' : '' }}">
    <label class="control-label mb-10" for="position">Position</label>
    <div class="input-group">
    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position or old('position') }}">
    <div class="input-group-addon"><i class="icon-user"></i></div>
    @if ($errors->has('position'))
        <span class="help-block">
            <strong>{{ $errors->first('position') }}</strong>
        </span>
    @endif
</div>
</div>
<div class="form-group row">
    <div class="col-md-6">
    <label class="control-label mb-10" for="position">Role</label>
    <div class="input-group">
    <select name="status" class="form-control">
        <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Active</option>
        <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Inactive</option>
    </select>
    <div class="input-group-addon"><i class="icon-user"></i></div>
    </div>
    <span class="help-block"> Select your role </span>
    </div>
    <div class="col-md-6">
    <label class="control-label mb-10" for="position">Role</label>
    <div class="input-group">
    <select name="" id="" class="form-control">
        <option>Administrator</option>
        <option>Editor</option>
        <option>Sales Person</option>
    </select>
    <div class="input-group-addon"><i class="icon-user"></i></div>
    </div>
    <span class="help-block"> Select your role </span>
    </div>
</div>
</form>