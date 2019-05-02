@extends('layouts.admin.app')

@section('content')	
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Edit Watch</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li><a href="index.html">Watches</a></li>
			<li class="active"><span>Edit Watch</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-wrap">
							<form action="{{ route('update.product', $product->id) }}" enctype="multipart/form-data" method="POST" id="productForm">
								<input type="hidden" name="_method" value="put">
								{{ csrf_field() }}
								<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>about product</h6>
								<hr class="light-grey-hr">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label mb-10">Product Name</label>
											<input type="text" id="title" name="title" value="{{ old('title', $product->title) }}" class="form-control">
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label mb-10">Short Description</label>
											<input type="text" id="short_description" name="short_description" value="{{ old('short_description', strip_tags($product->short_description)) }}" class="form-control">
										</div>
									</div>
									<!--/span-->
								</div>
								<!-- Row -->
								<div class="row">
									<div class="col-md-6">
										<label class="control-label mb-10">Select Brand</label>
										<select class="selectpicker" name="brand_id" data-style="form-control btn-default btn-outline" tabindex="-98">
											@foreach($brands as $brand)
												<option value="{{ $brand->term_id }}" {{ $product->brands[0]->term_id == $brand->term_id ? 'selected="selected"' : '' }}>{{ $brand->name }}</option>
											@endforeach
										</select>
									</div>
									<!--/span-->
									<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Category</label>
												<select class="selectpicker" name="category_id" data-style="form-control btn-default btn-outline" tabindex="-98">
													@foreach($categories as $category)
														<option value="{{ $category->term_id }}" {{ $product->categories[0]->term_id == $category->term_id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>	
													@endforeach
												</select>
											</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label mb-10">Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label mb-10">Regular Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label mb-10">Status</label>
											<div class="radio-list">
												<div class="radio-inline">
													<div class="radio radio-info">
														<input type="radio" name="status" id="radio2" value="draft" {{ ($product->status == 'draft') ? 'checked' : old('status', $product->status) == 'draft' || !$product->status ? 'checked' : '' }}>
														<label for="radio2">Draft</label>
													</div>
												</div>
												<div class="radio-inline pl-0">
													<div class="radio radio-info">
														<input type="radio" name="status" id="radio1" value="publish" {{ ($product->status == 'publish') ? 'checked' : old('status', $product->status) == 'publish' || !$product->status ? 'checked' : '' }}>
														<label for="radio1">Published</label>
													</div>
												</div>
												<div class="radio-inline">
													<div class="radio radio-info">
														<input type="radio" name="status" id="radio2" value="private" {{ ($product->status == 'private') ? 'checked' : old('status', $product->status) == 'private' || !$product->status ? 'checked' : '' }}>
														<label for="radio2">Private</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label mb-10">Sale Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label mb-10">Quantity</label>
											<input type="text" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}">
										</div>
									</div>
								</div>
								<div class="seprator-block"></div>
								<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-collection-image mr-10"></i>upload image</h6>
								<hr class="light-grey-hr">
								<div class="row">
									<div class="col-lg-4">
										<div class="img-upload-wrap">
											<img id="blah" src="/img/watch-image.PNG" alt="your image" />
										</div>
										<div class="fileupload btn btn-info btn-anim btn-gold mt-10 ml-50"><i class="fa fa-upload"></i><span class="btn-text">Upload cover image</span>
											<input type="file" class="upload" name="cover_image" id="imgInp">
  											
										</div>
									</div>
									<div class="col-lg-8">
										<div class="panel panel-inverse card-view">
											<div class="panel-heading">
												<div class="pull-left">
													<h6 class="panel-title">Watch Gallery Images</h6>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="panel-wrapper">
												<div class="panel-body">
											        <input id="file-input" type="file" multiple>
													<div id="preview">

														@for($x = 1;$x < sizeof($product->images); $x++)
														<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  file-box"><div class="file"><div class="image"><img height="100" src="{{ $product->images[$x]->src }}" ino="{{ $product->images[$x]->id }}"></div><div class="file-name text-center"><a title="Delete image" href="javascript:;" class="delete-gallery-img btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div></div>
														@endfor
													</div>
			                                    </div>
											</div>
										</div>
									</div>
								</div>
								<div class="seprator-block"></div>
								<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-calendar-note mr-10"></i>general info</h6>
								<hr class="light-grey-hr">
								
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CONDITION">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="GENDER">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CASE MATERIAL">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="BEZEL">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CASE BACK">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CASE DIAMETER">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="MOVEMENT">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="WATCH FEATURES">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="DIAL COLOUR">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CRYSTAL">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="BRACELET/STRAP">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="CLASP TYPE">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="INCLUDED">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Yes">
										</div>
									</div>
								</div>
								<div class="form-actions mt-15 mb-15">
									<button class="btn btn-gold btn-icon left-icon mr-10 pull-left" type="submit"> <i class="fa fa-check"></i> <span>save</span></button>
									<button type="button" class="btn btn-default pull-left">Cancel</button>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.products._script')
@endsection		