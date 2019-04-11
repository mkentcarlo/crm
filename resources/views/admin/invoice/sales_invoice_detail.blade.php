@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Invoice Details</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>Invoice Management</span></a></li>
				<li class="active"><span>Invoice Details</span></li>
			</ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->

	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-wrap">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label mb-10">Invoice Type: {{ str_replace('_',' ', strtoupper($invoice->invoice_type)) }}</label>
								</div>
								<div class="form-group">
									<label class="control-label mb-10">Invoice #: {{ $invoice->id }}</label>
								</div>
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-6">
								<label class="control-label mb-10">Customer: <strong>{{ $invoice->customer->lastname .' '. $invoice->customer->firstname }}</strong></label>
								<p>{{ $invoice->customer->street_address . ' ' . $invoice->customer->city }}</p>
								<p>{{ $invoice->customer->country .', '.$invoice->customer->state. ' '. $invoice->customer->postal_code }}</p>
								<p>P: {{ $invoice->customer->contact }}</p>
								<p>{{ $invoice->customer->email }}</p>
							</div>
							<div class="clearfix">
								<table class="table display product-overview mb-30 dataTable" role="grid">
									<thead>
										<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending" style="width: 222px;">Image</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending" style="width: 250px;">Watch Name</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 411px;">Brand</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 411px;">Category</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending" style="width: 118px;">Price</th>
										<th>Qty</th>
										<th>Sub Total</th></tr>
									</thead>
									<tbody>
										@if($invoice->invoice_detail)
											@foreach($invoice->invoice_detail as $detail)
											<tr>
												<td><img src="{{ $detail->featured_src }}" width="80"></td><td>{{ $detail->product_name }}</td>
												<td>{{ $detail->brand_name }}</td><td>{{ $detail->category_name }}</td><td>{{ $detail->price }}</td><td><span>{{ $detail->quantity }}</span></td><td>$<span>{{ $detail->total_amount }}</span></td>
											</tr>
											@endforeach
										@endif	
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-md-6">
									<table class="table">
										<tbody><tr>
											<th>Total Amount:</th>
											<td>$ {{ ($invoice->total_amount) ? number_format($invoice->total_amount, 2) : '0.00' }} </td>
										</tr>
										<tr>
											<td>Discount:</td>
											<td>${{ $invoice->additional_fields->discount ? number_format($invoice->additional_fields->discount, 2) : '0.00' }}</td>
										</tr>
										<tr>
											<td>Tax:</td>
											<td>${{ $invoice->additional_fields->tax ? number_format($invoice->additional_fields->tax, 2) : '0.00' }}</td>
										</tr>
										<tr>
											<td>Payment Method:</td>
											<td>
												
												<div>
													<label>Cash:</label> 
													@if($invoice->additional_fields->payment_method && in_array('cash', $invoice->additional_fields->payment_method))
														${{ $invoice->additional_fields->cash_amount ? number_format($invoice->additional_fields->cash_amount, 2) : '0.00' }}
													@endif	
												</div>
														
												<div>
													<label>Credit Card:</label>
													<div>
														@if($invoice->additional_fields->payment_method && in_array('credit_card', $invoice->additional_fields->payment_method))
															@if(!empty($invoice->additional_fields->card_info))
																@foreach($invoice->additional_fields->card_info as $cardInfo)
																<div class="card-holder ml-15 mt-15">
																	<label>Card Name:</label> {{ $cardInfo->card_name }} <br/>
																	<label>Card Number:</label> {{ $cardInfo->card_number }} <br/>
																	<label>Amount:</label> ${{ ($cardInfo->card_amount) ? number_format($cardInfo->card_amount, 2) : '0.00' }}
																</div>
																@endforeach
															@endif
														@endif		
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>Remarks:</td>
											<td>{{ $invoice->additional_fields->remarks ?? null }}</td>
										</tr>
										<tr>
											<td>Overall Total:</td>
											<td><h5 class="txt-gold">$90,000.00</h5></td>
										</tr>
									</tbody></table>
								</div>
								<div class="col-md-12">
									<button class="btn btn-default">Print</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
@endsection		
