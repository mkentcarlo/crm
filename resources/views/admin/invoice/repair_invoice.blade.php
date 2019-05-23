<div class="panel panel-default card-view">
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Invoice Type:</label>
						<input type="hidden" name="invoice_type" value="{{ $invoiceType }}">
						{{ str_replace('_',' ', strtoupper($invoiceType))}}
					</div>
					<div class="form-group">
						<label class="control-label mb-10">Status:</label>
						<select class="form-control" name="status" id="status">
							<option value="1">Pending</option>
							<option value="6">Proceeded</option>
							<option value="7">Rejected</option>
						</select>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6">
					<label class="control-label mb-10">Select Customer:</label>
						<select class="form-control customer-dropdown" name="customer_id" id="customer_id" required="required">
						<option value="">--please select--</option>	
						@foreach($customers as $customer)
						<option value="{{ $customer->id }}" data-email="{{ $customer->email }}" data-contact="{{ $customer->contact }}">{{ $customer->lastname .' '. $customer->firstname }}</option>
						@endforeach
						</select>
					<div id="customer-info" style="display: none;">
						<p class="mt-20" id="street_address">795 Folsom Ave, Suite 600</p>
						<p id="code_state_country">San Francisco, CA 94107</p>
						<p id="phone">P:(133) 456-7890</p>
						<p id="email">jsmith@email.com</p>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr class="light-grey-hr mt-30">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Select Watch:</label>
						<select class="form-control select2 product-dropdown" id="product_id" name="product_id" required="required">
							<option value="">--please select--</option>	
							@foreach($products as $product)
							<option value="{{ $product['id'] }}" data-title="{{ $product['name'] }}" data-desc="{{ $product['short_description'] }}" data-brand="{{ $product['brands'] }}" data-acf="{{$product['acf_search']}}">{{ $product['name'] }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6 mb-30">
					<p hidden id="category_name"></p>
					<div class="row" id="product-info" style="display: none;">
						<input type="hidden" name="product_name" id="p_product_name">
						<input type="hidden" name="brand_name" id="p_brand_name">
						<input type="hidden" name="category_name" id="p_category_name">
						<input type="hidden" name="featured_src" id="p_product_image">
						<input type="hidden" name="price" id="p_product_price">
						<div class="col-md-4 bg-dark" id="product_image">
							<img style="width: 100%" src="https://www.luxemontre.sg/wp-content/uploads/2019/01/Rolex-Yacht-Master-II-in-18K-White-Gold-M116689-Standing-2-500x493.png" alt="">
						</div>
						<div class="col-md-8">
							<h3 id="product_name">M116689</h3>
							<small id="short_description">This section only appears if there is watch selected.</small>
							<hr class="light-grey-hr mb-10">
							<h5 id="brand_name">ROLEX</h5>
							<h3 class="txt-gold mt-20">$<span id="product_price">20,000.00</span></h3>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Serial No:</label>
							<input type="text" name="serial_no" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Movement:</label>
							<input type="text" name="movement" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label mb-10">Functions:</label>
							<input type="text" name="functions" class="form-control">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label mb-10">Strap Type:</label>
								<input type="text" name="strap_type" class="form-control">
							</div>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Within Warranty Period:</label>
							<div class="radio radio-info">
								<input type="radio" name="within_warranty_period" value="Yes"> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="within_warranty_period" value="No" checked> <label>No</label>	
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Warranty Attached:</label>
							<div class="radio radio-info">
								<input type="radio" name="warranty_attached" value="Yes"> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="warranty_attached" value="No" checked> <label>No</label>	
							</div>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Case Material:</label>
							<input type="text" name="case_material" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bracelet Condition/Links:</label>
							<input type="text" name="bracelet_condition" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label mb-10">Complete Case:</label>
							<input type="text" name="complete_case" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Glass/Sapphire Crystal:</label>
							<input type="text" name="sapphire_crystal" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Case Back:</label>
							<input type="text" name="case_back" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Dial:</label>
							<input type="text" name="dial" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Hands:</label>
							<input type="text" name="hands" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bezel:</label>
							<input type="text" name="bezel" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Crown/Pushers:</label>
							<input type="text" name="crown" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bracelet/Strap:</label>
							<input type="text" name="strap" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Clasp/Buckle:</label>
							<input type="text" name="buckle" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Timing:</label>
							<input type="text" name="timing" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Complete Service:</label>
							<input type="text" name="complete_service" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Power Reserve:</label>
							<input type="text" name="power_reserve" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Polish/Refurbishing:</label>
							<input type="text" name="polish" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Keeps Stopping:</label>
							<input type="text" name="keeps_stopping" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Checking/Monitoring:</label>
							<input type="text" name="checking" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Water Seepage:</label>
							<input type="text" name="water_seepage" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Battery Change:</label>
							<input type="text" name="battery_change" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Parts Broken:</label>
							<input type="text" name="parts_broken" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Glass/Crystal Change:</label>
							<input type="text" name="glass_change" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Parts Missing:</label>
							<input type="text" name="parts_missing" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Strap Change:</label>
							<input type="text" name="strap_change" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label mb-10">Others:</label>
							<input type="text" name="others" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Service/Repair Cost:</label>
							<input type="text" name="repair_cost" class="form-control">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Service/Repair Duration:</label>
							<input type="text" name="repair_duration" class="form-control">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Service/Repair Accepted:</label>
							<div class="radio radio-info">
								<input type="radio" name="repair_accepted" value="Yes"> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="repair_accepted" value="No" checked> <label>No</label>	
							</div>
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label mb-10">Date of Acceptance:</label>
							<div class="input-group date datepicker">
								<input type="text" class="form-control" name="date_of_acceptance">
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label mb-10">Due Date:</label>
							<div class="input-group date datepicker">
								<input type="text" class="form-control" name="due_date">
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>	
					</div>
					</div>
					<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Watch Accepted By:</label>
							<input type="text" class="form-control" name="watch_accepted_by" value="">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Watch Sent By:</label>
							<input type="text" class="form-control" name="watch_sent_by" value="">
						</div>	
					</div>
					</div>
					<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Watch Returned By:</label>
							<input type="text" class="form-control" name="watch_returned_by" value="">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Watch Collected By:</label>
							<input type="text" class="form-control" name="watch_collected_by" value="">
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-30">
						<div class="text-center">
							<button class="btn btn-gold mr-15 btn-lg" type="submit">Save</button>
							<button class="btn btn-default btn-lg">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
