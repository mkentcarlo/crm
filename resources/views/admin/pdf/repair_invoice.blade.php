<!DOCTYPE html>
<html>
<head>
	<title>Repair Invoice</title>
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
		}
		table th {
			background: #d9d9d9;
			text-transform: uppercase;
			font-weight: normal;
		}
	</style>
</head>
<body>
	<div style="width: 100%" style="background: red">
		<div class="row" style="background: #000">
			<div class="col-md-12 text-center">
			<img class="logo" src="{{ asset('img/LM.png') }}" alt="">
			<p>LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-right">
				<h5>SERVICE AND REPAIR SLIP</h5>
				<h6>UEN NO: 230215K</h6>
				<h6>SERVICE NO.: <span style="color: red"><strong>0001</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%">
			<thead>
				<tr>
					<td>Client: </td>
					<td>Phone: </td>
				</tr>
				<tr>
					<td>Address: </td>
					<td>Email: </td>
				</tr>
				<tr>
					
					<td>Date: </td>
				</tr>
			</thead>
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
					<td>Case Material: </td>
				</tr>
				<tr>
					<td>Serial No.:  </td>
					<td>Within Warranty Period: </td>
				</tr>
				<tr>
					<td>Movement: </td>
					<td>Warranty Attached: </td>
				</tr>
				<tr>
					<td>Functions: </td>
					<td>Bracelet Condition/Links: </td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2" class="text-center">Condition of Watch for Repair</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">Complete Case: </td>
				</tr>
				<tr>
					<td>Glass/Sapphire Crystal: </td>
					<td>Case Back: </td>
				</tr>
				<tr>
					<td>Dial: </td>
					<td>Hands: </td>
				</tr>
				<tr>
					<td>Bezel: </td>
					<td>Crown/Pushers: {{ $invoice->additional_fields->crown ?? null }}</td>
				</tr>
				<tr>
					<td>Bracelet/Strap: </td>
					<td>Clasp/Buckle: </td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2" class="text-center">Watch Service / Repair Information</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Timing: </td>
					<td>Complete Service: </td>
				</tr>
				<tr>
					<td>Power Reserve: </td>
					<td>Polish/Refurbishing: </td>
				</tr>
				<tr>
					<td>Keeps Stopping:  </td>
					<td>Checking/Monitoring: </td>
				</tr>
				<tr>
					<td>Water Seepage: </td>
					<td>Battery Change: </td>
				</tr>
				<tr>
					<td>Parts Broken: </td>
					<td>Glass/Crystal Change: </td>
				</tr>
				<tr>
					<td>Parts Missing: </td>
					<td>Strap Change: </td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2" class="text-center">Service / Repair Quotation for Internal Use</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Service/Repair Cost: </td>
					<td>Service/Repair Accepted: </td>
				</tr>
				<tr>
					<td>Service/Repair Duration <small>(estimate)</small>: </td>
					<td>Date of Acceptance: </td>
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
					<td><strong>Watch Accepted By</strong>:<br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>&nbsp;</td>
					<td><strong>Watch Accepted By</strong>:<br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><strong>Watch Accepted By</strong>:<br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>&nbsp;</td>
					<td><strong>Watch Accepted By</strong>:<br> <small style="font-size: 11px !important;">On behalf of Luxe Montre/Date</small> <br> </td>
					<td>&nbsp;</td>
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
</body>
</html>