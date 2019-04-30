<!DOCTYPE html>
<html>
<head>
	<title>Consign OUT Invoice</title>
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
				<h5>CONSIGNMENT INVOICE</h5>
				<h6>UEN NO: 230215K</h6>
				<h6>CI (OUT) NO.: <span style="color: red"><strong>0001</strong></span></h6>
			</div>
		</div>
		<table style="width: 100%" class="bordered">
			<thead>
				<tr>
					<td>Consignor: </td>
					<td>Phone: </td>
				</tr>
				<tr>
					<td>Address: </td>
					<td>Email: </td>
				</tr>
				<tr>
					
					<td>NIRC/PASSPORT NO: </td>
					<td>Date: </td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">Included: </td>
				</tr>
				<tr>
					<td colspan="2">Watch Condition: </td>
				</tr>
				<tr>
					<td>Remarks: </td>
					<td>Bracelet Conditions/Links: </td>
				</tr>
				</tr>
				<tr>
					<td>Consignment Period: </td>
					<td>Return Date: </td>
				</tr>
			
		</table>
		<table style="width: 100%;" class="bordered">
			<thead>
				<tr>
					<td class="text-center">ITEM</td>
					<td class="text-center">DDSCRIPTION (MODEL & SERIAL NO.)</td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<br>
		<p><strong>I hereby acknowledge receipt of the abovementioned product(s) and undertake to be responsible for the safe custody until such
time the product(s) are returned or full payment has been made.</strong></p>
		<ul>
			<li>I have checked, inspected and received the abovementioned product(s) in good order.</li>
			<li>Unsold product(s) must be returned in the same condition as it was first consigned.</li>
			<li>All contents/accessories pertaining to the unsold product(s) must be returned in the same condition as it was first consigned.</li>
			<li>I have read and concur with the General Consignment Terms and Agreement by Luxe Montre Pte. Ltd.</li>
			<li>The Original Copy of this Consignment Invoice MUST be presented upon confirmation of sales or return of unsold product(s).</li>
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
</body>
</html>