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
	</style>
</head>
<body>
	<div style="width: 100%" style="background: red">
		<div class="row" style="background: #000">
			<div class="col-md-12 text-center">
				<img class="logo" src="https://singaporewebdevelopment.com/client/luxemontre/wp-content/uploads/2018/12/LM.png" alt="">
			</div>
			<div class="col-md-12 text-right">
				<h5 style="font-size:18px">SERVICE AND REPAIR SLIP</h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 230215K</h6>
				<h6 style="margin-top:25px">SERVICE NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>0001</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%">
			<thead>
				<tr class="noborder">
					<td>Client: </td>
					<td>Phone: </td>
				</tr>
				<tr class="noborder">
					<td>Address: </td>
					<td>Email: </td>
				</tr>
				<tr class="noborder">
					
					<td>Date: </td>
				</tr>
			</thead>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Watch Description</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Brand: </td>
					<td>Strap Type: {{ $invoice->additional_fields->strap_type ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Model No: </td>
					<td>Case Material: </td>
				</tr>
				<tr class="noborder">
					<td>Serial No.:  </td>
					<td>Within Warranty Period: </td>
				</tr>
				<tr class="noborder">
					<td>Movement: </td>
					<td>Warranty Attached: </td>
				</tr>
				<tr class="noborder">
					<td>Functions: </td>
					<td>Bracelet Condition/Links: </td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Condition of Watch for Repair</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td colspan="2">Complete Case: </td>
				</tr>
				<tr class="noborder">
					<td>Glass/Sapphire Crystal: </td>
					<td>Case Back: </td>
				</tr>
				<tr class="noborder">
					<td>Dial: </td>
					<td>Hands: </td>
				</tr>
				<tr class="noborder">
					<td>Bezel: </td>
					<td>Crown/Pushers: {{ $invoice->additional_fields->crown ?? null }}</td>
				</tr>
				<tr class="noborder">
					<td>Bracelet/Strap: </td>
					<td>Clasp/Buckle: </td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Watch Service / Repair Information</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Timing: </td>
					<td>Complete Service: </td>
				</tr>
				<tr class="noborder">
					<td>Power Reserve: </td>
					<td>Polish/Refurbishing: </td>
				</tr>
				<tr class="noborder">
					<td>Keeps Stopping:  </td>
					<td>Checking/Monitoring: </td>
				</tr class="noborder">
				<tr class="noborder">
					<td>Water Seepage: </td>
					<td>Battery Change: </td>
				</tr>
				<tr class="noborder">
					<td>Parts Broken: </td>
					<td>Glass/Crystal Change: </td>
				</tr class="noborder">
				<tr class="noborder">
					<td>Parts Missing: </td>
					<td>Strap Change: </td>
				</tr>
			</tbody>
			<thead>
				<tr class="noborder">
					<th colspan="2" class="text-center">Service / Repair Quotation for Internal Use</th>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Service/Repair Cost: </td>
					<td>Service/Repair Accepted: </td>
				</tr>
				<tr class="noborder">
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
	<div class="row">
			<div class="col-md-12 text-center">
			<p style="font-size:15px;font-weight:bold; margin-top:20px">LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div>
</body>
</html>