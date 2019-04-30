<!DOCTYPE html>
<html>
<head>
	<title>Sales Invoice</title>
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
				<h5>SALES INVOICE</h5>
				<h6>UEN NO: 230215K</h6>
				<h6>SI NO.: <span style="color: red"><strong>0001</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%" class="bordered">
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
					
					<td>Payment Mode: </td>
					<td>Date: </td>
				</tr>
			</thead>
			
		</table>
		<table style="width: 100%;" class="bordered">
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
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td class="text-right">TOTAL</td>
					<td>&nbsp;</td>
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
</body>
</html>