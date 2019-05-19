<!DOCTYPE html>
<html>
<head>
	<title>Consign IN Invoice</title>
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
		
		table  {
			width: 100%;
		}

		table.bordered td,
		table.bordered th {
			border: 1px solid #000;
			padding: 5px;
		}
		table th {
			background: #d9d9d9;
			text-transform: uppercase;
			font-weight: normal;
		}
		.underline {
			display: inline-block;
			width: 300px;
			border-top: 1px solid #000;
		}
		body * {
			font-size: 13px;
			font-family: "Trajan";
		}
		tr.noborder td {
			border: none;
			border-bottom: 1px solid #000
		}
		td.noborder {
			border: none !important
		}
		@page {
			margin: 2cm;
			margin-top: 3cm;
		}
	</style>
</head>
<body>
	<div style="width: 100%" style="background: red">
		<div class="row">
			<!-- <div class="col-md-12 text-center">
				<img class="logo" src="https://singaporewebdevelopment.com/client/luxemontre/wp-content/uploads/2018/12/LM.png" alt="">
			</div> -->
			<div class="col-md-12 text-right">
				<h5 style="font-size:18px">CONSIGNMENT INVOICE</h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 230215K</h6>
				<h6 style="margin-top:25px">CI (IN) NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>000{{ $invoice->id }}</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%" class="bordered">
			@php
				$street_address =  $invoice->customer->street_address ?? null; 
				$city =  $invoice->customer->city ?? null; 
				$state =  $invoice->customer->state ?? null; 
				$country =  $invoice->customer->country ?? null; 
				$postal_code =  $invoice->customer->postal_code ?? null; 
			@endphp
			<thead>
				<tr class="noborder">
					<td>Consignor: {{ $invoice->customer->firstname .' '.$invoice->customer->lastname }}</td>
					<td>Phone: {{ $invoice->contact }}</td>
				</tr>
				<tr class="noborder">
					<td>Address: {{ $street_address.' '.$city.' '.$country.' ,'.$state.' '.$postal_code }}</td>
					<td>Email: {{ $invoice->customer->email }}</td>
				</tr>
				<tr class="noborder">
					
					<td>NIRC/PASSPORT NO: {{ $invoice->additional_fields->passport_no ?? null }}</td>
					<td>Date: {{ $invoice->created_at }}</td>
				</tr>
			</thead>
			<tbody>
			<tr><td colspan="2" class="noborder">Included:</td></tr>
				<tr><td colspan="2" class="noborder">Box: {{ $invoice->additional_fields->box ?? null }}</td></tr>
				<tr><td colspan="2" class="noborder">Guarantee Card: {{ $invoice->additional_fields->guarantee_card ?? null }}</td></tr>
				<tr><td colspan="2" class="noborder">Instructions: {{ $invoice->additional_fields->instructions ?? null }}</td></tr>
				<tr><td colspan="2" class="noborder">Others: {{ $invoice->additional_fields->others ?? null }}</td></tr>
				<tr class="noborder">
					<td colspan="2">Watch Condition: {{ $invoice->additional_fields->watch_condition ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Remarks: {{ $invoice->additional_fields->remarks ?? null }}</td>
					<td>Bracelet Conditions/Links: {{ $invoice->additional_fields->bracelet_condition ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Consignment Period: {{ $invoice->additional_fields->consignment_period ?? null }}</td>
					<td>Return Date: {{ $invoice->additional_fields->return_date ?? null }}</td>
				</tr>
			</tbody>
		</table>
		<table style="width: 100%;margin-top: 25px;" class="bordered">
			<thead>
				<tr>
					<td class="text-center">ITEM</td>
					<td class="text-center">DDSCRIPTION (MODEL & SERIAL NO.)</td>
					<td class="text-center">AMOUNT (SGD)</td>
				</tr>
			</thead>
			<tbody>
				@php($total = 0)
				@if($invoice->invoice_detail)
					@foreach($invoice->invoice_detail as $detail)
					<tr>
						<td class="noborder">{{ $detail->product_name }}</td>
						<td class="noborder">{{ $detail->brand_name }} - {{ $detail->category_name }}</td>
						<td class="noborder">{{ $detail->total_amount }}</td>
					</tr>
					@php($total += $detail->total_amount)
					@endforeach
				@endif
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder text-right">TOTAL</td>
					<td>${{ number_format($total, 2) }}</td>
				</tr>
			</tbody>
		</table>
		<br>
		<p><strong>I agree to consign the above product(s) to Luxe Montre Pte. Ltd. on the following Terms and Conditions:</strong></p>
		<ul>
			<li>The product(s) are not counterfeit, modified and/or stolen property.</li>
			<li>The product(s) belong to me.</li>
			<li>I hereby grant Luxe Montre Pte. Ltd. the exclusive right to market/sell my product(s) for a 60 day period.</li>
			<li>I have read and concur with the General Consignment Terms and Agreement by Luxe Montre Pte. Ltd.</li>
			<li>The Original Copy of this Consignment Invoice MUST be presented upon collection of sales payment, withdrawal or termination.</li>
		</ul>
			
			<br>
			<br>
			<br>
		<table>
			<tbody>
				<tr>
					<td><span class="underline">
				</span>
				<br>
				For and on behalf of <strong>Luxe Montre Pte. Ltd.</strong></td>
					<td><span class="underline">
				</span>
				<br>
				<strong>Consignee Signature</strong></td>
				</tr>
			</tbody>	
		</table>
		<!-- <div class="row">
			<div class="col-md-12 text-center">
			<p style="font-size:15px;font-weight:bold;margin-top:30px">LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div> -->
</body>
</html>