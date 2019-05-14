<!DOCTYPE html>
<html>
<head>
	<title>Sales Invoice</title>
	<!-- Custom CSS -->
	<style>
		@font-face {
		font-family: "Trajan";
	
		}
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
			font-family: "Trajan";
		}
		@import url({{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}); */ */
		
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
			border-bottom: 2px solid #000;
		}
		tr.noborder td {
			border: none;
			border-bottom: 1px solid #000
		}
		td.noborder {
			border: none !important
		}
	</style>
	
</head>
<body>
	<div style="width: 100%" style="background: red">
		
		<div class="row">
			<div class="col-md-12 text-center">
				<img class="logo" src="https://singaporewebdevelopment.com/client/luxemontre/wp-content/uploads/2018/12/LM.png" alt="">
			</div>
			<div class="col-md-12 text-right">
				<h5 style="font-size:18px">SALES INVOICE</h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 230215K</h6>
				<h6 style="margin-top:25px">SI NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>0000{{ $invoice->id }}</strong></span></h6>
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
					<td>Client: {{ $invoice->customer->firstname .' '.$invoice->customer->lastname }}</td>
					<td>Phone: {{ $invoice->contact }}</td>
				</tr>
				<tr class="noborder">
					<td>Address: {{ $street_address.' '.$city.' '.$country.' ,'.$state.' '.$postal_code }}</td>
					<td>Email: {{ $invoice->customer->email }}</td>
				</tr>
				<tr class="noborder">	
					<td>
						<p>Payment Mode: </p>
						<div style="margin-top: 15px;">
							Cash: ${{ isset($invoice->additional_fields->cash_amount) ? number_format($invoice->additional_fields->cash_amount, 2) : '0.00' }}
						</div>
						<div style="margin-top: 15px;">
							Cheque: ${{ isset($invoice->additional_fields->cheque_amount) ? number_format($invoice->additional_fields->cheque_amount, 2) : '0.00' }}
						</div>
					</td>
					<td>Date: {{ $invoice->created_at }}</td>
				</tr>
			</thead>
			
		</table>
		<table style="width: 100%;margin-top:25px" class="bordered">
			<thead>
				<tr>
					<td class="text-center">ITEM</td>
					<td class="text-center">DESCRIPTION (MODEL & SERIAL NO.)</td>
					<td class="text-center">AMOUNT (SGD)</td>
				</tr>
			</thead>
			<tbody>
				@php($total = 0)
				@if($invoice->invoice_detail)
					@foreach($invoice->invoice_detail as $detail)
					<tr>
						<td>{{ $detail->product_name }}</td>
						<td>{{ $detail->brand_name }} - {{ $detail->category_name }}</td>
						<td>{{ $detail->total_amount }}</td>
					</tr>
					@php($total += $detail->total_amount)
					@endforeach
				@endif
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder text-right">TOTAL</td>
					<td>{{ number_format($total, 2) }}</td>
				</tr>
			</tbody>
		</table>
		<br>
		<ul style="font-size: 10px;padding-left: 10px;">
			<li>Goods sold cannot be returned or refunded.</li>
			<li>Certified Pre-owned products are sold in “as is” condition.</li>
			<li>Certified Pre-owned watches from Luxe Montre comes with a 6-months warranty that covers internal movement defect.
Any damage from misuse, neglect, abuse or normal wear is exempted from this warranty.</li>
			<li>Warranty is provided by our company and not by the brand manufacturer or agent.</li>
			<li>Goods sold on this invoice come under the GST Gross Margin Scheme. Both the seller and buyer cannot claim any input tax on the goods.</li>
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
				<strong>Client's Signature</strong></td>
				</tr>
			</tbody>	
		</table>
		<div class="row">
			<div class="col-md-12 text-center">
			<p style="font-size:15px;font-weight:bold;margin-top:70px">LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div>
</body>
</html>