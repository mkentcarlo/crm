@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Edit Invoice</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li><a href="index.html">Invoice Management</a></li>
			<li class="active"><span>Edit Invoice</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<div class="row">
		<div class="col-sm-12">
			<form method="POST" action="{{ route('update.invoice', $invoice->id) }}" id="invoice-form">
				{{ csrf_field() }}
				@if($invoiceType == 'sales')
					@include('admin.invoice.edit_sales_invoice')
					@include('admin.invoice._script')
				@elseif($invoiceType == 'consign_in' || $invoiceType == 'consign_out')
					@include('admin.invoice.edit_consign_invoice')
					@include('admin.invoice._edit_consign_script')
				@elseif($invoiceType == 'purchase')
					@include('admin.invoice.edit_purchase_invoice')
					@include('admin.invoice._edit_purchase_script')
				@elseif($invoiceType == 'repair')
					@include('admin.invoice.edit_repair_invoice')
					@include('admin.invoice._repair_script')
				@elseif($invoiceType == 'others')
					@include('admin.invoice.edit_others_invoice')
					@include('admin.invoice._other_script')	
				@else 
					@include('admin.invoice.edit_sales_invoice')
					@include('admin.invoice._script')	
				@endif
			</form>
		</div>
	</div>
@endsection

				