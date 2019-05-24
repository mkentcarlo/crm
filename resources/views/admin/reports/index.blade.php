@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">{{ $invoiceType=='others' ? 'In vs Out' : str_replace('_',' ', ucfirst($invoiceType)) }} Report</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>{{ $invoiceType=='others' ? 'In vs Out' : str_replace('_',' ', ucfirst($invoiceType)) }} Report</span></a></li>
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
						{{ $invoiceType=='others' ? 'In vs Out' : str_replace('_',' ', ucfirst($invoiceType)) }} Report
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
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
								<a class="btn btn-default btn-outline export-reports-csv" role="button"><i class="fa fa-download"></i></a> <a class="btn btn-default btn-outline export-reports-print" role="button"><i class="fa fa-print"></i></a>
							</div>
						</div>
					</div>
					<div class="row summary-report mt-25 mb-25">
						<div class="col-md-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
                                <div class="panel-body sm-data-box-1">
									<span class="uppercase-font weight-500 font-20 block text-center txt-dark">SUMMARY {{ $invoiceType=='others' ? 'In vs Out' : str_replace('_',' ', ucfirst($invoiceType)) }} REPORT {{($date_string) ? ' FOR '.$date_string : ''}}</span>	
									<div class="cus-sat-stat weight-500 txt-gold text-center mt-5 mb-10">
										$<span class="counter-anim">{{number_format($invoiceType != 'others' ? $total->sum('total_amount') : $total_overall , 2)}}</span>
									</div>
									@if ($invoiceType != 'others')
									@if ($invoiceType == 'purchase')
									<hr class="light-grey-hr row mt-10 mb-15">
										<div class="row">
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($cash_total, 2)}}</span></span><span class="block txt-grey">Cash</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($bank_transfer_total, 2)}}</span></span><span class="block txt-grey">Bank Transfer</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($cheque_total, 2)}}</span></span><span class="block txt-grey">Cheque</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									@else
										<hr class="light-grey-hr row mt-10 mb-15">
										<div class="row">
											<div class="col-md-3 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($cash_total, 2)}}</span></span><span class="block txt-grey">Cash</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-3 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($card_total, 2)}}</span></span><span class="block txt-grey">Credit Card</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-3 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($paynow_total, 2)}}</span></span><span class="block txt-grey">Pay Now</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-3 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($bank_transfer_total, 2)}}</span></span><span class="block txt-grey">Bank Transfer</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
										<hr class="light-grey-hr row mt-10 mb-15">
										<div class="row">
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($net_total, 2)}}</span></span><span class="block txt-grey">Nets</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($installment_total, 2)}}</span></span><span class="block txt-grey">Installments</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="">
													<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
													<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($others_total, 2)}}</span></span><span class="block txt-grey">Others</span></span>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
										<hr class="light-grey-hr row mt-10 mb-15">
										<div class="row">
											<div class="col-md-12 text-center">
												<button class="btn btn-gold view-invoices">View Invoices</button>
											</div>
										</div>
									@endif
									<div id="reports-table-container" style="display: none">
										<table class="table display nowrap mb-30" id="report-table" role="grid" style="width: 100% !important">
											<thead>
												<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">#Invoice</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Description</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Amount</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Status</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Issue Date</th><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Due Date</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
											</thead>
										</table>
									</div>
									@else
									<div class="text-center">{{strtoupper($profit_or_loss)}}</small>
									<hr class="light-grey-hr row mt-10 mb-15">
									<div class="row">
										<div class="col-md-4 text-center">
											<div class="">
												<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($sales->sum('total_amount'), 2)}}</span></span><span class="block txt-grey">Sales</span></span>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="col-md-4 text-center">
											<div class="">
												<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($purchases->sum('total_amount'), 2)}}</span></span><span class="block txt-grey">Purchases</span></span>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="col-md-4 text-center">
											<div class="">
												<span class="clabels clabels-lg inline-block bg-blue mr-10"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><span class="block font-20 weight-500 mb-5">$<span class="counter-anim">{{number_format($others->sum('total_amount'), 2)}}</span></span><span class="block txt-grey">Others</span></span>
												<div class="clearfix"></div>
											</div>
										</div>
										
									</div>
									
									@endif
								</div>
                            </div>
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