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
							<div class="row">
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
							</div>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Watch Description</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Brand: </td>
										<td>Strap Type: {{ $invoice->additional_fields->strap_type ?? null }}</td>
									</tr>
									</tr>
									<tr>
										<td>Model No: </td>
										<td>Case Material: {{ $invoice->additional_fields->case_material ?? null }}</td>
									</tr>
									<tr>
										<td>Serial No.: {{ $invoice->additional_fields->serial_no ?? null }} </td>
										<td>Within Warranty Period: {{ $invoice->additional_fields->within_warranty_period ? 'Yes' : 'No' }}</td>
									</tr>
									<tr>
										<td>Movement: {{ $invoice->additional_fields->movement ?? null }}</td>
										<td>Warranty Attached: {{ $invoice->additional_fields->warranty_attached ? 'Yes' : 'No' }}</td>
									</tr>
									<tr>
										<td>Functions: {{ $invoice->additional_fields->movement ?? null }}</td>
										<td>Bracelet Condition/Links: {{ $invoice->additional_fields->bracelet_condition ?? null }}</td>
									</tr>
								</tbody>
								<thead>
									<tr>
										<th colspan="2" class="text-center">Condition of Watch for Repair</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="2">Complete Case: {{ $invoice->additional_fields->complete_case ?? null }}</td>
									</tr>
									<tr>
										<td>Glass/Sapphire Crystal: {{ $invoice->additional_fields->sapphire_crystal ?? null }}</td>
										<td>Case Back: {{ $invoice->additional_fields->case_back ?? null }}</td>
									</tr>
									<tr>
										<td>Dial: {{ $invoice->additional_fields->dial ?? null }}</td>
										<td>Hands: {{ $invoice->additional_fields->hands ?? null }}</td>
									</tr>
									<tr>
										<td>Bezel: {{ $invoice->additional_fields->bezel ?? null }}</td>
										<td>Crown/Pushers: {{ $invoice->additional_fields->crown ?? null }}</td>
									</tr>
									<tr>
										<td>Bracelet/Strap: {{ $invoice->additional_fields->strap ?? null }}</td>
										<td>Clasp/Buckle: {{ $invoice->additional_fields->buckle ?? null }}</td>
									</tr>
								</tbody>
								<thead>
									<tr>
										<th colspan="2" class="text-center">Watch Service / Repair Information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Timing: {{ $invoice->additional_fields->timing ?? null }}</td>
										<td>Complete Service: {{ $invoice->additional_fields->complete_service ?? null }}</td>
									</tr>
									<tr>
										<td>Power Reserve: {{ $invoice->additional_fields->power_reserve ?? null }}</td>
										<td>Polish/Refurbishing: {{ $invoice->additional_fields->polish ?? null }}</td>
									</tr>
									<tr>
										<td>Keeps Stopping:  {{ $invoice->additional_fields->keeps_stopping ?? null }}</td>
										<td>Checking/Monitoring: {{ $invoice->additional_fields->checking ?? null }}</td>
									</tr>
									<tr>
										<td>Water Seepage: {{ $invoice->additional_fields->water_seepage ?? null }}</td>
										<td>Battery Change: {{ $invoice->additional_fields->battery_change ?? null }}</td>
									</tr>
									<tr>
										<td>Parts Broken: {{ $invoice->additional_fields->parts_broken ?? null }}</td>
										<td>Glass/Crystal Change: {{ $invoice->additional_fields->glass_change ?? null }}</td>
									</tr>
									<tr>
										<td>Parts Missing: {{ $invoice->additional_fields->parts_missing ?? null }}</td>
										<td>Strap Change: {{ $invoice->additional_fields->strap_change ?? null }}</td>
									</tr>
								</tbody>
								<thead>
									<tr>
										<th colspan="2" class="text-center">Service / Repair Quotation for Internal Use</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Service/Repair Cost: {{ $invoice->additional_fields->repair_cost ?? null }}</td>
										<td>Service/Repair Accepted: {{ $invoice->additional_fields->repair_accepted ? 'Yes' : 'No' }}</td>
									</tr>
									<tr>
										<td>Service/Repair Duration <small>(estimate)</small>: {{ $invoice->additional_fields->repair_duration ?? null }}</td>
										<td>Date of Acceptance: {{ $invoice->additional_fields->date_of_acceptance ?? null }}</td>
									</tr>
								</tbody>
							</table>
							<div class="mt-30">
								<!-- <div class="row">
									<div class="col-md-6">
										<label class="control-label">Serial No:</label>
										{{ $invoice->additional_fields->serial_no ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Movement:</label>
										{{ $invoice->additional_fields->movement ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Functions:</label>
										{{ $invoice->additional_fields->functions ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Strap Type:</label>
										{{ $invoice->additional_fields->strap_type ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Within Warranty Period:</label>
										{{ $invoice->additional_fields->within_warranty_period ? 'Yes' : 'No' }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Warranty Attached:</label>
										{{ $invoice->additional_fields->warranty_attached ? 'Yes' : 'No' }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Case Material:</label>
										{{ $invoice->additional_fields->case_material ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Bracelet Condition/Links:</label>
										{{ $invoice->additional_fields->bracelet_condition ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label class="control-label">Complete Case:</label>
										{{ $invoice->additional_fields->complete_case ?? null }}
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Glass/Sapphire Crystal:</label>
										{{ $invoice->additional_fields->sapphire_crystal ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Case Back:</label>
										{{ $invoice->additional_fields->case_back ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Dial:</label>
										{{ $invoice->additional_fields->dial ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Hands:</label>
										{{ $invoice->additional_fields->hands ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Bezel:</label>
										{{ $invoice->additional_fields->bezel ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Crown/Pushers:</label>
										{{ $invoice->additional_fields->crown ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Bracelet/Strap:</label>
										{{ $invoice->additional_fields->strap ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Clasp/Buckle:</label>
										{{ $invoice->additional_fields->buckle ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Timing:</label>
										{{ $invoice->additional_fields->timing ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Complete Service:</label>
										{{ $invoice->additional_fields->complete_service ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Power Reserve:</label>
										{{ $invoice->additional_fields->power_reserve ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Polish/Refurbishing:</label>
										{{ $invoice->additional_fields->polish ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Keeps Stopping:</label>
										{{ $invoice->additional_fields->keeps_stopping ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Checking/Monitoring:</label>
										{{ $invoice->additional_fields->checking ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Water Seepage:</label>
										{{ $invoice->additional_fields->water_seepage ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Battery Change:</label>
										{{ $invoice->additional_fields->battery_change ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Parts Broken:</label>
										{{ $invoice->additional_fields->parts_broken ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Glass/Crystal Change:</label>
										{{ $invoice->additional_fields->glass_change ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Parts Missing:</label>
										{{ $invoice->additional_fields->parts_missing ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Strap Change:</label>
										{{ $invoice->additional_fields->strap_change ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label class="control-label">Others:</label>
										{{ $invoice->additional_fields->others ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Service/Repair Cost:</label>
										{{ $invoice->additional_fields->repair_cost ?? null }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Service/Repair Duration:</label>
										{{ $invoice->additional_fields->repair_duration ?? null }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Service/Repair Accepted:</label>
										{{ $invoice->additional_fields->repair_accepted ? 'Yes' : 'No' }}
									</div>
									<div class="col-md-6">
										<label class="control-label">Date of Acceptance:</label>
										{{ $invoice->additional_fields->date_of_acceptance ?? null }}
									</div>
								</div> -->
								<div class="row mt-30">
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
	</div>
	<!-- /Row -->
@endsection		
