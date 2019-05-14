@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">{{ str_replace('_',' ', strtoupper($invoice)) }} Invoice</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>{{ str_replace('_',' ', strtoupper($invoice)) }} Invoice</span></a></li>
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
						{{ str_replace('_',' ', strtoupper($invoice)) }} Invoice 
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
						
							<div class="col-md-9 pt-40">
								<a href="{{ url('/invoice/create?invoice_type='. $invoice) }}" class="btn btn-gold pull-right">Add New Invoice</a>
							</div>
						</div>

						<div class="row">
						<div class="col-md-2 pt-15">
							<input type="hidden" id="current" value="{{ \Request::get('current') ? \Request::get('current') : '' }}">
							<label for="">Select Year</label>
							<select class="form-control" data-style="form-control btn-default btn-outline" tabindex="-98" id="select-year">
								<option value="">All</option>	
								@for($x=2019;$x<=2019;$x++)
								<option value="{{$x}}" {{ ($x == $year) ? 'selected="selected"' : ''}}>{{$x}}</option>	
								@endfor
							</select>
						</div>
						<div class="col-md-2 pt-15">
							<label for="">Select Month</label>
							<select class="form-control" data-style="form-control btn-default btn-outline" tabindex="-98" id="select-month">
								<option value="">All</option>	
								<option value="1" {{ (1 == $month) ? 'selected="selected"' : ''}}>January</option>
								<option value="2" {{ (2 == $month) ? 'selected="selected"' : ''}}>February</option>
								<option value="3" {{ (3 == $month) ? 'selected="selected"' : ''}}>March</option>
								<option value="4" {{ (4 == $month) ? 'selected="selected"' : ''}}>April</option>
								<option value="5" {{ (5 == $month) ? 'selected="selected"' : ''}}>May</option>
								<option value="6" {{ (6 == $month) ? 'selected="selected"' : ''}}>June</option>
								<option value="7" {{ (7 == $month) ? 'selected="selected"' : ''}}>July</option>
								<option value="8" {{ (8 == $month) ? 'selected="selected"' : ''}}>August</option>
								<option value="9" {{ (9 == $month) ? 'selected="selected"' : ''}}>September</option>
								<option value="10" {{ (10 == $month) ? 'selected="selected"' : ''}}>October</option>
								<option value="11" {{ (11 == $month) ? 'selected="selected"' : ''}}>November</option>
								<option value="12" {{ (12 == $month) ? 'selected="selected"' : ''}}>December</option>
							</select>
						</div>
						<div class="col-md-2 pt-15">
							<label for="">Custom date range</label>
							<input type="text" class="form-control daterange-datepicker" />

							<!-- <select class="form-control" data-style="form-control btn-default btn-outline" tabindex="-98" id="select-week">
								<option value="">All</option>	
								<option value="1" {{ (1 == $week) ? 'selected="selected"' : ''}}>First Week</option>	
								<option value="2" {{ (2 == $week) ? 'selected="selected"' : ''}}>Second Week</option>	
								<option value="3" {{ (3 == $week) ? 'selected="selected"' : ''}}>Third Week</option>	
								<option value="4" {{ (4 == $week) ? 'selected="selected"' : ''}}>Fourth Week</option>	
								<option value="5" {{ (5 == $week) ? 'selected="selected"' : ''}}>Fifth Week</option>	
							</select> -->
						</div>
						<div class="col-md-3 pt-15">
							<label for="">Current</label>
							<div class="btn-group btn-group-justified">
								<a class="btn btn-default {{ $current == 'week' ? 'btn-gold' : 'btn-outline' }} select-current" role="button" id="week">Week</a> <a class="btn btn-default {{ $current == 'month' ? 'btn-gold' : 'btn-outline' }} select-current" role="button" id="month">Month</a> <a class="btn btn-default {{ $current == 'year' ? 'btn-gold' : 'btn-outline' }} select-current" role="button" id="year">Year</a>
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