@extends('layouts.admin.app')

@section('content')

	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Users</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li class="active"><span>Users</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	
	<!-- Row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default card-view pa-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="contact-list">
							<div class="row">
								<aside class="col-lg-2 col-md-4 pr-0">
									<div class="mt-20 mb-20 ml-15 mr-15">
										<a href="#modalUserInfo" data-form-url="{{ url('users/create') }}" data-toggle="modal"  title="Compose" class="btn btn-gold btn-block form-load">
										Add new user
										</a>

										<!-- Modal -->
										<div aria-hidden="true" role="dialog" tabindex="-1" id="modalUserInfo" class="modal fade" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel1">User Information</h4>
													</div>
													<div class="modal-body" id="user-info">
														@include('admin.users.create-user-form')
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-gold waves-effect" id="submit-user">Save</button>
														<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->

									</div>
									<ul class="inbox-nav mb-30">
										<li class="active">
											<a href="#">All <span class="label label-warning ml-10 bg-gold">12</span></a>
										</li>
										<li>
										@foreach($roles as $role)
										<li>
											<a href="#" id="{{ $role->name }}" class="user-role">{{ $role->name }}<span class="label label-warning ml-10 bg-gold">{{ $role->users_count }}</span></a>
										</li>
										@endforeach
									</ul>
									
									<a class="txt-gold create-label pl-15 pb-5 export-users-csv" href="javascript:void(0)" ><i class="fa fa-download"></i> Download CSV</a>
									<a class="txt-gold create-label pl-15 pb-5 export-users-print" href="javascript:void(0)" ><i class="fa fa-print"></i> Print All Users</a>
									<div id="myModal_1" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h5 class="modal-title" id="myModalLabel">Add Role</h5>
												</div>
												<div class="modal-body">
													<form>
														<div class="form-group">
															<label class="control-label mb-10">Name of Role</label>
															<input type="text" class="form-control" placeholder="Type name">
														</div>
														<div class="form-group">
															<label class="control-label mb-10">Select Permissions</label>
															<select class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose">
																<optgroup label="Select Permission">
																	<option value="">Manage Users</option>
																	<option value="">Manage Customers</option>
																	<option value="">Manage Products</option>
																	<option value="">Manage Brands</option>
																	<option value="">Manage Invoices</option>
																	<option value="">Manage Reports</option>
																</optgroup>
															</select>
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-gold waves-effect" data-dismiss="modal">Save</button>
													<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
								</aside>
								
								<aside class="col-lg-10 col-md-8 pl-0">
									<div class="panel pa-0">
									<div class="panel-wrapper collapse in">
									<div class="panel-body  pa-0">
										<div class="input-group pa-15"> 
											<input type="text" id="search-user" name="search_user" class="form-control" placeholder="Search"><span class="input-group-btn">
											<button type="button" class="btn  btn-gold"><i class="fa fa-search"></i></button>
											</span>
										</div>
										<div class="table-responsive mb-30">
											<table id="users-table" class="table  display table-hover mb-30" data-page-size="10">
												<thead>
													<tr>
														<th>ID</th>
														<th>Username</th>
														<th>Email</th>
														<th>Name</th>
														<th>Phone</th>
														<!-- <th>Role</th> -->
														<th>Status</th>
														<th>Joining date</th>
														<th>Action</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									</div>
									</div>
								</aside>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
	@include('admin.users._script')
@endsection