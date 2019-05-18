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
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10">Asking Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="asking_price" name="asking_price" value="{{ old('asking_price', $product->asking_price ?? null) }}">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10">Selling Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price ?? null) }}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10">Buying Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="buying_price" name="buying_price" value="{{ old('buying_price', $product->buying_price ?? null) }}" readonly="readonly">
											</div>
										</div>	
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label mb-10">Status</label>
											<div class="radio-list">
												<div class="radio-inline">
													<div class="radio radio-default">
														<input type="radio" name="status" id="radio2" value="draft" {{ ($product->status == 'draft') ? 'checked' : old('status', $product->status) == 'draft' || !$product->status ? 'checked' : '' }}>
														<label for="radio2">Draft</label>
													</div>
												</div>
												<div class="radio-inline pl-0">
													<div class="radio radio-default">
														<input type="radio" name="status" id="radio1" value="publish" {{ ($product->status == 'publish') ? 'checked' : old('status', $product->status) == 'publish' || !$product->status ? 'checked' : '' }}>
														<label for="radio1">Published</label>
													</div>
												</div>
												<div class="radio-inline">
													<div class="radio radio-default">
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
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10">Regular Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10">Discounted Price</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="ti-money"></i></div>
												<input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
											</div>
										</div>	
									</div>
									<div class="col-md-2">
									<br>
									<br>
										<span style="font-style: italic">( For website display )</span>
									</div>
									<input type="hidden" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}">
								</div>
								<div class="seprator-block"></div>
								<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-collection-image mr-10"></i>upload image</h6>
								<hr class="light-grey-hr">
								<div class="row">
									<div class="col-lg-4 text-center">
										<div class="img-upload-wrap">
											<img id="blah" src="{{ ($product->featured_src) ? $product->featured_src : asset('img/img-placeholder.png') }}" alt="your image" height="100" />
										</div>
										<div class="fileupload btn btn-info btn-anim btn-gold mt-10"><i class="fa fa-upload"></i><span class="btn-text">Upload cover image</span>
											<input type="file" class="upload form-control" name="cover_image" id="imgInp">
  											
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
											        <input id="file-input" class="form-control" type="file" multiple>
															<br>
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
								<input type="hidden" class="form-control" placeholder="COST PRICE" name="cost_price" value="{ $product->cost_price ?? null }}">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="">MODEL REFERENCE</label>
											<input type="text" class="form-control" placeholder="MODEL REFERENCE" name="model_reference" value="{{ $product->model_reference ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CONDITION</label>
											<input type="text" class="form-control" placeholder="CONDITION" name="condition" value="{{ $product->condition ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">GENDER</label>
											<input type="text" class="form-control" placeholder="GENDER" name="gnder" value="{{ $product->gnder ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CASE MATERIAL</label>
											<input type="text" class="form-control" placeholder="CASE MATERIAL" name="case_material" value="{{ $product->case_material ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">BEZEL</label>
											<input type="text" class="form-control" placeholder="BEZEL" name="bezel" value="{{ $product->bezel ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CASE BACK</label>
											<input type="text" class="form-control" placeholder="CASE BACK" name="case_back" value="{{ $product->case_back ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CASE DIAMETER</label>
											<input type="text" class="form-control" placeholder="CASE DIAMETER" name="case_diameter" value="{{ $product->case_diameter ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">MOVEMENT</label>
											<input type="text" class="form-control" placeholder="MOVEMENT" name="movement" value="{{ $product->movement ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">WATCH FEATURES</label>
											<input type="text" class="form-control" placeholder="WATCH FEATURES" name="watch_features" value="{{ $product->watch_features ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">DIAL COLOUR</label>
											<input type="text" class="form-control" placeholder="DIAL COLOUR" name="dial_colour" value="{{ $product->dial_colour ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CRYSTAL</label>
											<input type="text" class="form-control" placeholder="CRYSTAL" name="crystal" value="{{ $product->crystal ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">BRACELET/STRAP</label>
											<input type="text" class="form-control" placeholder="BRACELET/STRAP" name="braceletstrap" value="{{ $product->braceletstrap ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CLASP TYPE</label>
											<input type="text" class="form-control" placeholder="CLASP TYPE" name="clasp_type" value="{{ $product->clasp_type ?? null }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
										<label for="">INCLUDED</label>
											<input type="text" class="form-control" placeholder="INCLUDED" name="included" value="{{ $product->included ?? null }}">
										</div>
									</div>
									<div class="col-sm-6">
										<label>Complication</label>
										<div class="form-group">
											<select name="complication" class="form-control">
												@for($x=1;$x<=10;$x++)
												<option value="{{ $x }}" {{ isset($product->complication) && $product->complication == $x ? 'selected="selected"' : '' }}>{{ $x }}</option>
												@endfor
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<label>New</label>
										<div class="radio radio-default">
											<input type="radio" name="new" value="Yes" {{ isset($product->new) && $product->new == 'Yes' ? 'checked="checked"' : '' }}>
											<label for="limited_editionyes">
												YES
											</label>
										</div>
										<div class="radio radio-default">
											<input type="radio" name="new" value="No" {{ isset($product->new) && $product->new == 'No' ? 'checked="checked"' : '' }}>
											<label for="limited_editionno">
												NO
											</label>
										</div>
										
									</div>
									<div class="col-sm-6">
										<label>Limited Edition</label>
										<div class="radio radio-default">
											<input type="radio" name="limited_edition" value="Yes" {{ isset($product->limited_edition) && $product->limited_edition == 'Yes' ? 'checked="checked"' : '' }}>
											<label for="limited_editionyes">
												YES
											</label>
										</div>
										<div class="radio radio-default">
											<input type="radio" name="limited_edition" value="No" {{ isset($product->limited_edition) && $product->limited_edition == 'No' ? 'checked="checked"' : '' }}>
											<label for="limited_editionyes">
												NO
											</label>
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