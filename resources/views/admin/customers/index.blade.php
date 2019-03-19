@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Customers</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li class="active"><span>Customers</span></li>
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
								<aside class="col-lg-3 col-md-4 pr-0">
									<div class="mt-20 mb-20 ml-15 mr-15">
										<button class="btn btn-block bg-gold" data-toggle="modal" data-target="#createModal">
										Add new customer
										</a>
									</div>
									<ul class="inbox-nav mb-30">
										<li class="active">
											<a href="#">All <span class="label label-warning ml-10 bg-gold">25</span></a>
										</li>
										<li>
											<a href="#">Retailer <span class="label label-warning ml-10 bg-gold">10</span></a>
										</li>
										<li>
											<a href="#">Wholesaler <span class="label label-warning ml-10 bg-gold">15</span></a>
										</li>
									</ul>
									
									<a class="txt-gold create-label pl-15 pb-5" href="javascript:void(0)" data-toggle="modal" data-target="#myModal_1"><i class="fa fa-download"></i> Download CSV</a>
									<a class="txt-gold create-label pl-15 pb-5" href="javascript:void(0)" data-toggle="modal" data-target="#myModal_1"><i class="fa fa-print"></i> Print All Customers</a>
								</aside>
								
								<aside class="col-lg-9 col-md-8 pl-0">
									<div class="panel pa-0">
									<div class="panel-wrapper collapse in">
									<div class="panel-body  pa-0">
										<form id="filterForm" method="POST" role="form">
											<div class="input-group pa-15"> 
												<input type="text" id="name" name="name" class="form-control" placeholder="Search Customers"><span class="input-group-btn">
												<button type="submit" class="btn  btn-gold"><i class="fa fa-search"></i></button>
												</span>										
											</div>
										</form>	
										<div class="table-responsive mb-30">
											<table id="customers-table" class="table  display table-hover mb-30" data-page-size="10">
												<thead>
													<tr>
														<th>No</th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Group</th>
														<th>Date Added</th>
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
	@include('admin.customers._script')
	@include('admin.customers.edit')
	@include('admin.customers.create')
@endsection	
	