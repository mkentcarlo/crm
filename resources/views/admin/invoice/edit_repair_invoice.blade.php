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
							<option value="1" {{ $invoice->status  == 1 ? 'selected="selected"' : '' }}>Pending</option>
							<option value="2" {{ $invoice->status  == 2 ? 'selected="selected"' : '' }}>Unpaid</option>
							<option value="3" {{ $invoice->status  == 3 ? 'selected="selected"' : '' }}>Paid</option>
						</select>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6">
					<label class="control-label mb-10">Select Customer:</label>
						<select class="form-control select2" name="customer_id" id="customer_id">
						@foreach($customers as $customer)
						<option value="{{ $customer->id }}">{{ $customer->lastname .' '. $customer->firstname }}</option>
						@endforeach
						</select>
					<p class="mt-20" id="street_address">795 Folsom Ave, Suite 600</p>
					<p id="code_state_country">San Francisco, CA 94107</p>
					<p id="phone">P:(133) 456-7890</p>
					<p id="email">jsmith@email.com</p>
				</div>
				<div class="clearfix"></div>
				<hr class="light-grey-hr mt-30">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Select Watch:</label>
						<select class="form-control select2" name="product_id" id="product_id">
							@foreach($products as $product)
							<option value="{{ $product['id'] }}" {{ $invoice->invoice_detail[0]->product_id == $product['id'] ? 'selected="selected"' : '' }}>{{ $product['name'] }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6 mb-30">
					<p hidden id="category_name"></p>
					<input type="hidden" name="product_name" id="p_product_name">
					<input type="hidden" name="brand_name" id="p_brand_name">
					<input type="hidden" name="category_name" id="p_category_name">
					<input type="hidden" name="featured_src" id="p_product_image">
					<input type="hidden" name="price" id="p_product_price">
					<div class="row">
						<div class="col-md-4 bg-dark" id="product_image">
							<img style="width: 100%" src="https://www.luxemontre.sg/wp-content/uploads/2019/01/Rolex-Yacht-Master-II-in-18K-White-Gold-M116689-Standing-2-500x493.png" alt="">
						</div>
						<div class="col-md-8">
							<h3 id="product_name">M116689</h3>
							<small>This section only appears if there is watch selected.</small>
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
							<input type="text" name="serial_no" class="form-control" value="{{ $invoice->additional_fields->serial_no ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Movement:</label>
							<input type="text" name="movement" class="form-control" value="{{ $invoice->additional_fields->movement ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label mb-10">Functions:</label>
							<input type="text" name="functions" class="form-control" value="{{ $invoice->additional_fields->functions ?? null }}">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label mb-10">Strap Type:</label>
								<input type="text" name="strap_type" class="form-control" value="{{ $invoice->additional_fields->strap_type ?? null }}">
							</div>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Within Warranty Period:</label>
							<div class="radio radio-info">
								<input type="radio" name="within_warranty_period" value="Yes" {{ $invoice->additional_fields->within_warranty_period == 'Yes' ? 'checked="checked"' : '' }}> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="within_warranty_period" value="No" {{ $invoice->additional_fields->within_warranty_period == 'No' ? 'checked="checked"' : '' }}> <label>No</label>	
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Warranty Attached:</label>
							<div class="radio radio-info">
								<input type="radio" name="warranty_attached" value="Yes" {{ $invoice->additional_fields->warranty_attached == 'Yes' ? 'checked="checked"' : '' }}> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="warranty_attached" value="No" {{ $invoice->additional_fields->warranty_attached == 'No' ? 'checked="checked"' : '' }}> <label>No</label>	
							</div>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Case Material:</label>
							<input type="text" name="case_material" class="form-control" value="{{ $invoice->additional_fields->case_material ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bracelet Condition/Links:</label>
							<input type="text" name="bracelet_condition" class="form-control" value="{{ $invoice->additional_fields->bracelet_condition ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label mb-10">Complete Case:</label>
							<input type="text" name="complete_case" class="form-control" value="{{ $invoice->additional_fields->complete_case ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Glass/Sapphire Crystal:</label>
							<input type="text" name="sapphire_crystal" class="form-control" value="{{ $invoice->additional_fields->sapphire_crystal ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Case Back:</label>
							<input type="text" name="case_back" class="form-control" value="{{ $invoice->additional_fields->case_back ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Dial:</label>
							<input type="text" name="dial" class="form-control" value="{{ $invoice->additional_fields->dial ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Hands:</label>
							<input type="text" name="hands" class="form-control" value="{{ $invoice->additional_fields->hands ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bezel:</label>
							<input type="text" name="bezel" class="form-control" value="{{ $invoice->additional_fields->bezel ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Crown/Pushers:</label>
							<input type="text" name="crown" class="form-control" value="{{ $invoice->additional_fields->crown ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Bracelet/Strap:</label>
							<input type="text" name="strap" class="form-control" value="{{ $invoice->additional_fields->strap ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Clasp/Buckle:</label>
							<input type="text" name="buckle" class="form-control" value="{{ $invoice->additional_fields->buckle ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Timing:</label>
							<input type="text" name="timing" class="form-control" value="{{ $invoice->additional_fields->timing ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Complete Service:</label>
							<input type="text" name="complete_service" class="form-control" value="{{ $invoice->additional_fields->complete_service ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Power Reserve:</label>
							<input type="text" name="power_reserve" class="form-control" value="{{ $invoice->additional_fields->power_reserve ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Polish/Refurbishing:</label>
							<input type="text" name="polish" class="form-control" value="{{ $invoice->additional_fields->polish ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Keeps Stopping:</label>
							<input type="text" name="keeps_stopping" class="form-control" value="{{ $invoice->additional_fields->keeps_stopping ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Checking/Monitoring:</label>
							<input type="text" name="checking" class="form-control" value="{{ $invoice->additional_fields->checking ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Water Seepage:</label>
							<input type="text" name="water_seepage" class="form-control" value="{{ $invoice->additional_fields->water_seepage ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Battery Change:</label>
							<input type="text" name="battery_change" class="form-control" value="{{ $invoice->additional_fields->battery_change ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Parts Broken:</label>
							<input type="text" name="parts_broken" class="form-control" value="{{ $invoice->additional_fields->parts_broken ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Glass/Crystal Change:</label>
							<input type="text" name="glass_change" class="form-control" value="{{ $invoice->additional_fields->glass_change ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Parts Missing:</label>
							<input type="text" name="parts_missing" class="form-control" value="{{ $invoice->additional_fields->parts_missing ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Strap Change:</label>
							<input type="text" name="strap_change" class="form-control" value="{{ $invoice->additional_fields->strap_change ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label mb-10">Others:</label>
							<input type="text" name="others" class="form-control" value="{{ $invoice->additional_fields->others ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Service/Repair Cost:</label>
							<input type="text" name="repair_cost" class="form-control" value="{{ $invoice->additional_fields->repair_cost ?? null }}">
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Service/Repair Duration:</label>
							<input type="text" name="repair_duration" class="form-control" value="{{ $invoice->additional_fields->repair_duration ?? null }}">
						</div>	
					</div>
				</div>
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10 d-block">Service/Repair Accepted:</label>
							<div class="radio radio-info">
								<input type="radio" name="repair_accepted" value="Yes" {{ $invoice->additional_fields->repair_accepted == 'Yes' ? 'checked="checked"' : '' }}> <label>Yes</label>
							</div>
							<div class="radio radio-info">
								<input type="radio" name="repair_accepted" value="No" {{ $invoice->additional_fields->repair_accepted == 'No' ? 'checked="checked"' : '' }}> <label>No</label>	
							</div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Date of Acceptance:</label>
							<div class="input-group date datepicker">
								<input type="text" class="form-control" name="date_of_acceptance" value="{{ $invoice->additional_fields->date_of_acceptance ?? null }}">
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
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
