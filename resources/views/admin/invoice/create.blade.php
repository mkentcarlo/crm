@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Add Invoice</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li><a href="index.html">Invoice Management</a></li>
			<li class="active"><span>Add Invoice</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<div class="row">
		<div class="col-sm-12">
			<form method="POST" action="{{ route('store.invoice') }}" id="invoice-form">
				{{ csrf_field() }}
				@if($invoiceType == 'sales')
					@include('admin.invoice.sales_invoice')
					@include('admin.invoice._script')
				@elseif($invoiceType == 'consign_in' || $invoiceType == 'consign_out')
					@include('admin.invoice.consign_invoice')
					@include('admin.invoice._consign_script')
				@elseif($invoiceType == 'purchase')
					@include('admin.invoice.purchase_invoice')
					@include('admin.invoice._purchase_script')
				@elseif($invoiceType == 'repair')
					@include('admin.invoice.repair_invoice')
					@include('admin.invoice._repair_script')
				@elseif($invoiceType == 'others')
					@include('admin.invoice.others_invoice')
					@include('admin.invoice._other_script')	
				@else 
					@include('admin.invoice.sales_invoice')
					@include('admin.invoice._script')	
				@endif
			</form>
		</div>
	</div>
@endsection

				