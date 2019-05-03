@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Invoices</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>Invoices</span></a></li>
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
						Invoice List
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
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
						<div class="row">
							<div class="col-md-3 pt-15">
								<label for="">Enter Invoice #:</label>
								<input type="text" class="form-control" id="invoice_id">
							</div>
							<div class="col-md-3 pt-15">
								<label for="">Invoice Type:</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" tabindex="-98" id="select-invoice">
									<option value="">All</option>	
									<option value="consign_in">Consign IN</option>	
									<option value="consign_out">Consign OUT</option>	
									<option value="repair">Repairs</option>
									<option value="sale">Sale</option>
									<option value="purchase">Purchase</option>
								</select>
							</div>
						
							<div class="col-md-6 pt-40">
								<a href="{{ route('create.invoice') }}" class="btn btn-gold pull-right">Add New Invoice</a>
							</div>
						</div>
						<div class="table-wrap">
							<div class="table-responsive">
								<div id="datable_1_wrapper" class="dataTables_wrapper">
									<table class="table display product-overview mb-30 dataTable" id="invoice-table" role="grid">
										<thead>
											<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">#Invoice</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Description</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Amount</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Status</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Issue Date</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Due Date</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">View</th></tr>
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
	@include('admin.invoice._index_script')
@endsection	