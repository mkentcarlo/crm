@extends('layouts.admin.app')

@section('content')
<!-- Title -->	
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">Edit Information</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="index.html">Dashboard</a></li>
		<li><a href="users.php">Users</a></li>
		<li class="active"><span>Edit Information</span></li>
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
												<form class="user-info" method="POST" action="{{ url('users/profile/'. $user->id) }}">
												{{ csrf_field() }}
												<input type="hidden" name="_method" value="PUT">
												<input name="id" value="{{$user->id}}" type="hidden" />
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Username</label>
															<div class="input-group">
															<input type="text" class="form-control" id="exampleInputuname_1" name="username" value="{{ $user->username }}">
															<div class="input-group-addon"><i class="icon-user"></i></div>
															</div>
															<span class="help-block"> Username should be unique </span>
														</div>
														<div class="form-group row">
															<div class="col-md-6">
																<label class="control-label mb-10" for="exampleInputuname_1">First Name</label>
																<div class="input-group">
																<input type="text" class="form-control" id="exampleInputuname_1" name="firstname" value="{{ $user->firstname }}">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																</div>
															</div>
															<div class="col-md-6">
																<label class="control-label mb-10" for="exampleInputuname_1">Last Name</label>
																<div class="input-group">
																<input type="text" class="form-control" id="exampleInputuname_1" name="lastname" value="{{ $user->lastname }}">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Email Address</label>
															<div class="input-group">
															<input type="text" class="form-control" id="exampleInputuname_1" name="email" value="{{ $user->email }}">
															<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
															</div>
															<span class="help-block"> Email should be valid </span>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Contact Number</label>
															<div class="input-group">
															<input type="text" class="form-control" id="exampleInputuname_1" name="contact" value="{{ $user->contact }}">
															<div class="input-group-addon"><i class="icon-phone"></i></div>
															</div>
														</div>
														<div class="form-group row">
															<div class="col-md-6">
															<label class="control-label mb-10" for="exampleInputuname_1">Position</label>
															<div class="input-group">
															<input type="text" class="form-control" id="exampleInputuname_1" name="position" value="{{ $user->position }}">
															<div class="input-group-addon"><i class="icon-user"></i></div>
															</div>
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
