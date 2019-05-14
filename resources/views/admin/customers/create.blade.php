<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="createModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="create_customer">
	            {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel1">Add New Customer</h4>
				</div>
				<div class="modal-body">
				<div class="tab-struct custom-tab-2">
					<ul role="tablist" class="nav nav-tabs" id="myTabs_15">
						<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_15" href="#home_15"> <i class="zmdi zmdi-account mr-10"></i>Basic Information</a></li>
						<li role="presentation" class=""><a data-toggle="tab" id="profile_tab_15" role="tab" href="#profile_15" aria-expanded="false"><i class="zmdi zmdi-account-box mr-10"></i> Address</a></li>
					</ul>
					<div class="tab-content" id="myTabContent_15">
						<div id="home_15" class="tab-pane fade active in" role="tabpanel">
							<div class="form-group row">
								<div class="col-md-6">
									<label class="control-label mb-10" for="exampleInputuname_1">First Name</label>
									<div class="input-group">
									<input type="text" class="form-control" id="exampleInputuname_1" name="firstname">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
								<div class="col-md-6">
									<label class="control-label mb-10" for="exampleInputuname_1">Last Name</label>
									<div class="input-group">
									<input type="text" class="form-control" id="exampleInputuname_1" name="lastname">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-10" for="exampleInputuname_1">Email Address</label>
								<div class="input-group">
									<input type="text" class="form-control" id="exampleInputuname_1" name="email">
									<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-10" for="exampleInputuname_1">Contact Number</label>
								<div class="input-group">
								<input type="text" class="form-control" id="exampleInputuname_1" name="contact">
								<div class="input-group-addon"><i class="icon-phone"></i></div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="control-label mb-10" for="exampleInputuname_1">Group</label>
									<div class="input-group">
										<select name="group_id" id="" class="form-control">
											@foreach($groups as $group)
												<option value="{{ $group->id }}">{{ $group->name }}</option>
											@endforeach
										</select>
										<div class="input-group-addon"><i class="icon-user"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div id="profile_15" class="tab-pane fade" role="tabpanel">
							<div class="row">
								<div class="col-md-12 ">
									<div class="form-group">
										<label class="control-label mb-10">Street</label>
										<input type="text" class="form-control" name="street_address">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">City</label>
										<input type="text" class="form-control" name="city">
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">State</label>
										<input type="text" class="form-control" name="state">
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Post Code</label>
										<input type="text" class="form-control" name="postal_code">
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Country</label>
										<select name="country" id="country" class="form-control">
										@foreach($countries as $country)
											<option value="{{ $country }}" {{ $country == 'Singapore' ? 'selected="selected"' : '' }}>{{ $country }}</option>
										@endforeach
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
