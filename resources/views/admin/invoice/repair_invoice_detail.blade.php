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
									<p>795 Folsom Ave, Suite 600</p>
									<p>San Francisco, CA 94107</p>
									<p>P:(133) 456-7890</p>
									<p>jsmith@email.com</p>
								</div>
							</div>
							<div class="mt-30">
								<div class="row">
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
								</div>
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
