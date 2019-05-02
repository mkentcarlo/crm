@extends('layouts.admin.app')

@section('content')
<!-- Title -->	
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">Change Password</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="index.html">Dashboard</a></li>
		<li><a href="users.php">Users</a></li>
		<li class="active"><span>Change Password</span></li>
	  </ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->
<div class="row">
		<div class="col-sm-6">
			@if (\Session::has('success'))
			    <div class="alert alert-success">
			        <ul>
			            <li>{!! \Session::get('success') !!}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button></li>
			        </ul>
			    </div>
			@endif
			@if($errors->any())
			    <ul style="margin-bottom: 30px;">
			    @foreach ($errors->all() as $error)
			        <li>{{ $error }}</li>
			    @endforeach
			    </ul>
			@endif
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body row pt-0 pb-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body inbox-body pa-0">
								<div class="container-fluid mt-20 mb-20">
									<form class="user-info" method="POST" action="{{ url('users/change-password/'. $user->id) }}">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									<input name="id" value="{{$user->id}}" type="hidden" />
											<div class="form-group">
												<label class="control-label mb-10" for="exampleInputuname_1">Old Password</label>
												<div class="input-group">
												<input type="password" class="form-control" id="exampleInputuname_1" name="old_password">
												<div class="input-group-addon"><i class="icon-lock"></i></div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label mb-10" for="exampleInputuname_1">New Password</label>
												<div class="input-group">
												<input type="password" class="form-control" id="exampleInputuname_1" name="new_password">
												<div class="input-group-addon"><i class="icon-lock"></i></div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label mb-10" for="exampleInputuname_1">Repeat Password</label>
												<div class="input-group">
												<input type="password" class="form-control" id="exampleInputuname_1" name="password_confirm">
												<div class="input-group-addon"><i class="icon-lock"></i></div>
												</div>
											</div>
											<button class="btn btn-gold">Save</button> <a href="{{ url('/dashboard') }}" class="btn btn-default">Cancel</a>
										</form>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!-- Row -->
@endsection

