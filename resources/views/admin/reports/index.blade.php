@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Reports</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>Reports</span></a></li>
			</ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	
	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<!-- <div class="pull-left">
						<h6 class="panel-title txt-dark">Roles List</h6>
					</div> -->
					<div class="pull-left">
						Report List
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
					<div class="row">
						<div class="col-md-2 pt-15">
							<label for="">Select Year</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" tabindex="-98">
								<option>All</option>	
								<option value="">2018</option>
								<option value="">2017</option>
								<option value="">2016</option>
							</select>
						</div>
						<div class="col-md-2 pt-15">
							<label for="">Select Month</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" tabindex="-98">
								<option>All</option>	
								<option value="">January</option>
								<option value="">February</option>
								<option value="">March</option>
							</select>
						</div>
						<div class="col-md-2 pt-15">
							<label for="">Select Week</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" tabindex="-98">
								<option>All</option>	
								<option>First Week</option>	
								<option>Second Week</option>	
								<option>Third Week</option>	
								<option>Fourth Week</option>	
							</select>
						</div>
						<div class="col-md-3 pt-15">
							<label for="">Current</label>
							<div class="btn-group btn-group-justified">
								<a class="btn btn-default btn-gold" role="button">Week</a> <a class="btn btn-default btn-outline" role="button">Month</a> <a class="btn btn-default btn-outline" role="button">Year</a>
							</div>
						</div>
						<div class="col-md-1 pt-15">
						</div>
						<div class="col-md-2 pt-35">
							<div class="btn-group">
								<a class="btn btn-default btn-outline" role="button"><i class="fa fa-download"></i></a> <a class="btn btn-default btn-outline" role="button"><i class="fa fa-print"></i></a>
							</div>
						</div>
					</div>
						<div class="table-wrap">
							<div class="table-responsive">
								<div id="datable_1_wrapper" class="dataTables_wrapper">
									<table class="table display product-overview mb-30 dataTable" id="report-table" role="grid">
										<thead>
											<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">#Invoice</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Description</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Amount</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Status</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Issue Date</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Due Date</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
										</thead>
									</table>
								</div>	
							</div>
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
	@include('admin.reports._script')
@endsection	