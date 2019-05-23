<!DOCTYPE html>
<html>
<head>
	<title>Other Invoice {{ str_pad( $invoice->id, 4, "0", STR_PAD_LEFT ) }}</title>
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
			border-bottom: 2px solid #000;
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
				<h5><strong style="font-size:18px">OTHER INVOICE</strong></h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 201817415K</h6>
				<h6 style="margin-top:25px">OI NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>{{ str_pad( $invoice->id, 4, "0", STR_PAD_LEFT ) }}</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%" class="bordered">
			<thead>
				<tr class="noborder" colspan="2">
					<td>Invoice Type: {{ isset($invoice->additional_fields->in_out) ? strtoupper($invoice->additional_fields->in_out) : '' }}</td>
				</tr>
			</thead>
		</table>
		<table style="width: 100%;margin-top: 25px;" class="bordered">
			<thead>
				<tr>
					<td class="text-center">DESCRIPTION</td>
					<td class="text-center">PAYMENT MODE</td>
					<td class="text-center">AMOUNT (SGD)</td>
				</tr>
			</thead>
			<tbody>
				@php($total=0)
				@if(!empty($invoice->additional_fields->in_out_data))
				@foreach($invoice->additional_fields->in_out_data as $row)
				<tr>
					<td class="noborder">{{ $row->description }}</td>
					<td class="noborder">{{ $row->payment_mode }}</td>
					<td class="noborder text-center">${{ number_format($row->amount, 2) }}</td>
				</tr>
				@php($total += $row->amount)
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
					<td class="text-center">${{ number_format($total, 2) }}</td>
				</tr>
			</tbody>
		</table>
		<br>
		<!-- <table>
			<tbody>
				<tr>
					<td><span class="underline">
				</span>
				<br>
				For and on behalf of <strong>Luxe Montre Pte. Ltd.</strong></td>
					<td><span class="underline">
				</span>
				<br>
				<strong>Signature</strong></td>
				</tr>
			</tbody>	
		</table> -->
</body>
</html>