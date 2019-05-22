<!DOCTYPE html>
<html>
<head>
	<title>Repair Invoice {{ str_pad( $invoice->id, 4, "0", STR_PAD_LEFT ) }}</title>
	<!-- Custom CSS -->
	<style>
		.logo {
			max-width: 200px;
		}
		.text-center {
			text-align: center
		} 
		.text-right {
			text-align: right
		} 
		body * {
			font-size: 13px;
		}
		@import url({{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }});
		
		table td,
		table th {
			border: 1px solid #000;
			/* padding: 5px; */
		}
		table th {
			background: #d9d9d9;
			text-transform: uppercase;
			font-weight: normal;
		}
		tr.noborder td {
			border: none;
			border-bottom: 1px solid #000
		}
		td.noborder {
			border: none !important
		}
		body * {
			font-size: 13px;
			font-family: "Trajan";
		}
		@page {
			margin: 2cm;
			margin-top: 3cm;
		}
	</style>
</head>
<body>
	<div style="width: 100%" style="background: red">
		<div class="row" style="background: #000">
			<!-- <div class="col-md-12 text-center">
				<img class="logo" src="https://singaporewebdevelopment.com/client/luxemontre/wp-content/uploads/2018/12/LM.png" alt="">
			</div> -->
			<div class="col-md-12 text-right">
				<h5 style="font-size:18px">SERVICE AND REPAIR SLIP</h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 201817415K</h6>
				<h6 style="margin-top:25px">SERVICE NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>{{ str_pad( $invoice->id, 4, "0", STR_PAD_LEFT ) }}</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%">
			@php
				$street_address =  $invoice->customer->street_address ?? null; 
				$city =  $invoice->customer->city ?? null; 
				$state =  $invoice->customer->state ?? null; 
				$country =  $invoice->customer->country ?? null; 
				$postal_code =  $invoice->customer->postal_code ?? null; 
			@endphp
			<thead>
				<tr class="noborder">
					<td>Client: {{ $invoice->customer->firstname .' '.$invoice->customer->lastname }}</td>
					<td>Phone: {{ $invoice->customer->contact }}</td>
				</tr>
				<tr class="noborder">
					<td>Address: {{ $street_address.' '.$city.' '.$country.' ,'.$state.' '.$postal_code }}</td>
					<td>Email: {{ $invoice->customer->email }}</td>
				</tr>
				<tr class="noborder">
					
					<td>Date: {{ date('d/m/Y H:i', strtotime($invoice->created_at)) }}</td>
					<td>&nbsp;</td>
				</tr>
			</thead>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Watch Description</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Brand: {{ isset($invoice->invoice_detail) ? $invoice->invoice_detail[0]->brand_name : '' }}</td>
					<td>Strap Type: {{ $invoice->additional_fields->strap_type ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Model No: {{ isset($invoice->invoice_detail) ? $invoice->invoice_detail[0]->product_id : '' }}</td>
					<td>Case Material: {{ $invoice->additional_fields->case_material ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Serial No.:  {{ $invoice->additional_fields->serial_no ?? null }}</td>
					<td>Within Warranty Period: </td>
				</tr>
				<tr class="noborder">
					<td>Movement: {{ $invoice->additional_fields->movement ?? null }}</td>
					<td>Warranty Attached: </td>
				</tr>
				<tr class="noborder">
					<td>Functions: {{ $invoice->additional_fields->functions ?? null }}</td>
					<td>Bracelet Condition/Links: {{ $invoice->additional_fields->bracelet_condition ?? null }}</td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Condition of Watch for Repair</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td colspan="2">Complete Case: {{ $invoice->additional_fields->complete_case ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Glass/Sapphire Crystal: {{ $invoice->additional_fields->sapphire_crystal ?? null }}</td>
					<td>Case Back: {{ $invoice->additional_fields->case_back ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Dial: {{ $invoice->additional_fields->dial ?? null }}</td>
					<td>Hands: {{ $invoice->additional_fields->hands ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Bezel: {{ $invoice->additional_fields->bezel ?? null }}</td>
					<td>Crown/Pushers: {{ $invoice->additional_fields->crown ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Bracelet/Strap: {{ $invoice->additional_fields->strap ?? null }}</td>
					<td>Clasp/Buckle: {{ $invoice->additional_fields->buckle ?? null }}</td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Watch Service / Repair Information</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Timing: {{ $invoice->additional_fields->timing ?? null }}</td>
					<td>Complete Service: {{ $invoice->additional_fields->complete_service ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Power Reserve: {{ $invoice->additional_fields->power_reserve ?? null }}</td>
					<td>Polish/Refurbishing: {{ $invoice->additional_fields->polish ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Keeps Stopping:  {{ $invoice->additional_fields->keeps_stopping ?? null }}</td>
					<td>Checking/Monitoring: {{ $invoice->additional_fields->checking ?? null }}</td>
				</tr class="noborder">
				<tr class="noborder">
					<td>Water Seepage: {{ $invoice->additional_fields->water_seepage ?? null }}</td>
					<td>Battery Change: {{ $invoice->additional_fields->battery_change ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Parts Broken: {{ $invoice->additional_fields->parts_broken ?? null }}</td>
					<td>Glass/Crystal Change: {{ $invoice->additional_fields->glass_change ?? null }}</td>
				</tr class="noborder">
				<tr class="noborder">
					<td>Parts Missing: {{ $invoice->additional_fields->parts_missing ?? null }}</td>
					<td>Strap Change: {{ $invoice->additional_fields->strap_change ?? null }}</td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Service / Repair Quotation for Internal Use</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Service/Repair Cost: {{ $invoice->additional_fields->repair_cost ?? null }}</td>
					<td>Service/Repair Accepted: {{ $invoice->additional_fields->repair_accepted == 'Yes' ? 'Yes' : 'No' }}</td>
				</tr>
				<tr class="noborder">
					<td>Service/Repair Duration <small>(estimate)</small>: {{ $invoice->additional_fields->repair_duration ?? null }}</td>
					<!-- <td>Date of Acceptance: {{ $invoice->additional_fields->date_of_acceptance ?? null }}</td> -->
				</tr>
			</tbody>
			
		</table>
		<table style="width: 100%">
			<thead>
				<tr>
					<th class="text-center" colspan="4">Authorization for dispatch and collection of watch</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong>Watch Accepted By</strong>: <br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>{{ $invoice->additional_fields->watch_accepted_by ?? null }}</td>
					<td><strong>Watch Sent By</strong>: <br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>{{ $invoice->additional_fields->watch_sent_by ?? null }}</td>
				</tr>
				<tr>
					<td><strong>Watch Returned By</strong>: <br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>{{ $invoice->additional_fields->watch_returned_by ?? null }}</td>
					<td><strong>Watch Collected By</strong>: <br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>{{ $invoice->additional_fields->watch_collected_by ?? null }}</td>
				</tr>
				<tr>
					<td style="font-size: 10px;" colspan="4">
					<ul style="font-size: 10px; margin: 0; padding-left: 15px;line-height: 15px;"><li style="font-size: 10px;">The Original Copy of this Service And Repair Slip MUST be presented upon the collection of watch. Please contact us in writing if it is misplaced or lost. </li> <br>
<li style="font-size: 10px;">In the absence of the Original Copy of this Service And Repair Slip, a Letter of Authorization from the abovementioned client and NRIC is REQUIRED.</li>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- <div class="row">
			<div class="col-md-12 text-center">
			<p style="font-size:15px;font-weight:bold; margin-top:20px">LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div> -->
</body>
</html>