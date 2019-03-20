<form id="create-user" class="user-info" method="POST" action="{{ url('users/store') }}">
{{ csrf_field() }}

<h6 class="txt-dark capitalize-font"><i class="fa fa-user-plus mr-10"></i>Create new user</h6>
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
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" />
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
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
        <div class="input-group">
        <input type="text" class="form-control" name="firstname" id="first_name" value="{{ old('firstname') }}">
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
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
        <div class="input-group">
        <input type="text" class="form-control" name="lastname" id="last_name" value="{{ old('lastname') }}">
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
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
    <div class="input-group">
    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
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
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
    <div class="input-group">
    <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">
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
        <!-- <div class="input-group">
            <div class="input-group-addon"><i class="icon-user"></i></div>
            <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
        </div> -->
        <div class="input-group">
        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
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
    <!-- <div class="input-group">
        <div class="input-group-addon"><i class="icon-user"></i></div>
        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Username">
    </div> -->
    <div class="input-group">
        <select name="role" class="form-control">
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    <div class="input-group-addon"><i class="icon-user"></i></div>
    </div>
    <span class="help-block"> Select your role </span>
    </div>
</div>
</form>