<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="updateModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" id="update_customer">
				{{ method_field('PUT') }}
	            {{ csrf_field() }}
	            <input id="id" type="hidden" class="form-control" name="id">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel1">Edit Customer</h4>
				</div>
				<div class="modal-body">
				<div class="tab-struct custom-tab-2">
					<ul role="tablist" class="nav nav-tabs" id="myTabs_15">
						<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="update_home_tab_15" href="#update_home_15"> <i class="zmdi zmdi-account mr-10"></i>Basic Information</a></li>
						<li role="presentation" class=""><a data-toggle="tab" id="update_profile_tab_15" role="tab" href="#update_profile_15" aria-expanded="false"><i class="zmdi zmdi-account-box mr-10"></i> Address</a></li>
					</ul>
					<div class="tab-content" id="update_myTabContent_15">
						<div id="update_home_15" class="tab-pane fade active in" role="tabpanel">
							<div class="form-group row">
								<div class="col-md-6">
									<label class="control-label mb-10" for="exampleInputuname_1">First Name</label>
									<div class="input-group">
									<input type="text" class="form-control" id="firstname" name="firstname">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label mb-10" for="exampleInputuname_1">Last Name</label>
									<div class="input-group">
									<input type="text" class="form-control" id="lastname" name="lastname">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-10" for="exampleInputuname_1">Email Address</label>
								<div class="input-group">
									<input type="text" class="form-control" id="email" name="email">
									<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-10" for="exampleInputuname_1">Contact Number</label>
								<div class="input-group">
								<input type="text" class="form-control" id="contact" name="contact">
								<div class="input-group-addon"><i class="icon-phone"></i></div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="control-label mb-10" for="exampleInputuname_1">Group</label>
									<div class="input-group">
										<select name="group_id" id="group_id" class="form-control">
											@foreach($groups as $group)
												<option value="{{ $group->id }}">{{ $group->name }}</option>
											@endforeach
										</select>
										<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div id="update_profile_15" class="tab-pane fade" role="tabpanel">
							<div class="row">
								<div class="col-md-12 ">
									<div class="form-group">
										<label class="control-label mb-10">Street</label>
										<input type="text" class="form-control" name="street_address" id="street_address">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">City</label>
										<input type="text" class="form-control" name="city" id="city">
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">State</label>
										<input type="text" class="form-control" name="state" id="state">
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Post Code</label>
										<input type="text" class="form-control" name="postal_code" id="postal_code">
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Country</label>
										<select class="form-control" name="country" id="country">
											<option>--Select your Country--</option>
											<option value="India">India</option>
											<option value="Sri Lanka">Sri Lanka</option>
											<option value="USA">USA</option>
										</select>
									</div>
								</div>
								<!--/span-->
							</div>
						</div>
						<div id="dropdown_29" class="tab-pane fade " role="tabpanel">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
						</div>
						<div id="dropdown_30" class="tab-pane fade" role="tabpanel">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater.</p>
						</div>
					</div>
				</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-gold waves-effect">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</form>	
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
