<!DOCTYPE html>
<html>
<head>
	<title>Purchase Invoice</title>
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
	<div style="width: 100%">
		<div class="row" style="background: #000">
			<div class="col-md-12 text-center">
				<img class="logo" src="https://singaporewebdevelopment.com/client/luxemontre/wp-content/uploads/2018/12/LM.png" alt="">
			</div>
			<div class="col-md-12 text-right">
				<h5 style="font-size:18px">PURCHASE INVOICE</h5>
				<h6 style="font-size:10px; margin-top:-10px">UEN NO: 230215K</h6>
				<h6 style="margin-top:25px">PI NO.: <span style="color: red; font-size: 20px !important; font-family: Arial !important"><strong>0001</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%" class="bordered">
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
					
					<td>NIRC/PASSPORT NO: </td>
					<td>Date: </td>
				</tr>
			</thead>
			<tbody>
				<tr class="noborder">
					<td>Remarks: </td>
					<td>Payment Mode: </td>
				</tr>
			</tbody>
		</table>
		<table style="width: 100%; margin-top: 25px" class="bordered">
			<thead>
				<tr>
					<td class="text-center">ITEM</td>
					<td class="text-center">DESCRIPTION (MODEL & SERIAL NO.)</td>
					<td class="text-center">AMOUNT (SGD)</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="text-right noborder">TOTAL</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<br>
		<p><strong>I agree to sell the above product(s) to Luxe Montre Pte. Ltd. on the following Terms and Conditions:</strong></p>
		<ul>
			<li>The product(s) are not counterfeit and/or stolen property.</li>
			<li>The product(s) belong to me.</li>
			<li>I hereby agree to sell the above product(s).</li>
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
				<strong>Seller's Signature</strong></td>
				</tr>
			</tbody>	
		</table>
		<div class="row">
			<div class="col-md-12 text-center">
			<p style="font-size:15px;font-weight:bold; margin-top:180px">LUXE MONTRE PTE. LTD <br>
			<small>www.luxemontre.sg <br>
			277 Orchard Road, #04 -07, Orchard Gateway, Singapore 238858 <br>
Tel: +65 6388 5555 | +65 8715 5555 | Email: service@luxemontre.sg</small></p>
			</div>
		</div>
</body>
</html>