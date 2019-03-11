@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Watches</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li class="active"><span>Watches</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body row pt-0">
						<form id="filterForm" method="POST" role="form">
							<div class="row">
								<div class="col-md-4">
								<div class="input-group pa-15 pr-0 pt-35"> 
										<input type="text" id="name" name="name" class="form-control" placeholder="Search"><span class="input-group-btn">
										<button type="submit" class="btn  btn-gold" id="search"><i class="fa fa-search"></i></button>
										</span> 
								</div>
								</div>
								<div class="col-md-3 pt-15">
									<label for="">Select Brand</label>
									<select class="selectpicker" id="select-brand" data-style="form-control btn-default btn-outline">
										<option value="">All</option>	
										@foreach($brands as $brand)
											<option value="{{ $brand->name }}">{{ $brand->name }}</option>	
										@endforeach
									</select>
								</div>
								<div class="col-md-3 pt-15">
									<label for="">Select Gender</label>
									<select class="selectpicker" id="select-cat" data-style="form-control btn-default btn-outline" tabindex="-98">
										<option value="">All</option>	
										@foreach($categories as $category)
											<option value="{{ $category->name }}">{{ $category->name }}</option>	
										@endforeach
									</select>
								</div>
								<div class="col-md-2 pt-35">
									<a class="btn btn-gold" href="{{ route('create.product') }}">Add New Watch</a>
								</div>

							</div>
							
							<div class="table-wrap">
								<div class="table-responsive">
									<div id="datable_1_wrapper" class="dataTables_wrapper">
										<table class="table display product-overview mb-30 dataTable" id="products-table" role="grid">
											<thead>
												<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending">Image</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending">Watch Name</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Brand</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Category</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending">Price</th>
												<th>Status</th>
												<th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending">Date Added</th>
												<th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Row -->

	@include('admin.products._script')
@endsection	