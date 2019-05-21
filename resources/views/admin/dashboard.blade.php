@extends('layouts.admin.app')

@section('content')

<!-- Row -->
<div class="row mt-30">
	
	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<a href="{{url('brands')}}">
		<div class="panel panel-default card-view pa-0 bg-gold">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 txt-light data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($brands) }}</span></span>
									<span class="weight-500 uppercase-font block">All Brands</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 txt-light data-wrap-right">
									<i class="fa fa-tags data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<a href="{{url('products')}}">
		<div class="panel panel-default card-view pa-0 bg-gold">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 txt-light data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($watches) }}</span></span>
									<span class="weight-500 uppercase-font block">All Watches</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 txt-light data-wrap-right">
									<i class="fa fa-clock-o data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<a href="javascript:;">
		<div class="panel panel-default card-view pa-0 bg-gold">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 txt-light data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($inquiries) }}</span></span>
									<span class="weight-500 uppercase-font block">All Enquiries</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 txt-light data-wrap-right">
									<i class="fa fa-envelope-square data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<a href="{{url('customers')}}">
		<div class="panel panel-default card-view pa-0 bg-gold">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 txt-light data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($customers) }}</span></span>
									<span class="weight-500 uppercase-font block">All Customers</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 txt-light data-wrap-right">
									<i class="fa fa-group data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
</div>
<!-- /Row -->

<!-- Row -->
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
		<a href="{{url('invoice')}}">
		<div class="panel panel-default card-view pa-0">
			
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($sales) }}</span></span>
									<span class="weight-500 uppercase-font block">Sales</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="fa fa-dollar data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a href="{{url('invoice?invoice_type=purchase')}}">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($purchase) }}</span></span>
									<span class="weight-500 uppercase-font block">Purchases</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="fa fa-money data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a href="{{url('invoice?invoice_type=consign_in')}}">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($consignments) }}</span></span>
									<span class="weight-500 uppercase-font block">Consignments In</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="icon-layers data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a href="{{url('invoice?invoice_type=consign_out')}}">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($consignments) }}</span></span>
									<span class="weight-500 uppercase-font block">Consignments Out</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="icon-layers data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a href="{{url('invoice?invoice_type=repair')}}">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($repair) }}</span></span>
									<span class="weight-500 uppercase-font block">Services & Repairs</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="fa fa-cogs data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a href="{{url('invoice?invoice_type=others')}}">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="block counter"><span class="counter-anim">{{ count($repair) }}</span></span>
									<span class="weight-500 uppercase-font block">Others</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="fa fa-money data-right-rep-icon"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	
	<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Recent Transactions</h6>
				</div>
				<div class="pull-right">
					<a class="btn btn-sm txt-light bg-gold" href="{{ route('view.invoice') }}">View All</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<table class="table display product-overview mb-30 dataTable nowrap" id="transaction-table" style="width:100%">
						<thead>
							<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">#Invoice</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Description</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Amount</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Status</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Issue Date</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Due Date</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">View</th></tr>
						</thead>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>	
<!-- Row -->
	@include('admin._script')
@endsection
