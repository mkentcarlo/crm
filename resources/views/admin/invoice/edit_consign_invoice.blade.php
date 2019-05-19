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
							
							@if($invoiceType == 'consign_in')
							<option value="4" {{ $invoice->status  == 4 ? 'selected="selected"' : '' }}>Sold</option>
							<option value="5" {{ $invoice->status  == 5 ? 'selected="selected"' : '' }}>Returned</option>
							@else 
							<option value="2" {{ $invoice->status  == 2 ? 'selected="selected"' : '' }}>Unpaid</option>
							<option value="3" {{ $invoice->status  == 3 ? 'selected="selected"' : '' }}>Paid</option>
							@endif
						</select>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6">
					<label class="control-label mb-10">Select Customer:</label>
						<select class="form-control customer-dropdown" name="customer_id" id="customer_id">
						@foreach($customers as $customer)
						<option value="{{ $customer->id }}" data-email="{{ $customer->email }}" data-contact="{{ $customer->contact }}" {{ $invoice->customer->id == $customer->id ? 'selected="selected"' : '' }}>{{ $customer->lastname .' '. $customer->firstname }}</option>
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
						<select class="form-control select2 product-dropdown" id="product_id">
							@foreach($products as $product)
							<option value="{{ $product['id'] }}" data-title="{{ $product['name'] }}" data-desc="{{ $product['short_description'] }}" data-brand="{{ $product['brands'] }}" data-acf="{{$product['acf_search']}}">{{ $product['name'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label class="control-label mb-10">Quantity:</label>
							<input type="text" class="form-control" id="quantity" value="1" readonly="readonly">
						</div>
						<div class="col-md-6 mt-30">
							<a href="#" class="btn btn-gold btn-block" id="add_quantity">Add</a>
						</div>
						
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6">
					<p hidden id="category_name"></p>
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
				<div class="clearfix">
					<table class="table display product-overview mb-30 dataTable" role="grid">
							<thead>
								<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Photo: activate to sort column descending" style="width: 222px;">Image</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending" style="width: 250px;">Watch Name</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 411px;">Brand</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 411px;">Category</th><th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending" style="width: 118px;">Price</th>
								<th>Qty</th>
								<th>Sub Total</th>
								<th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 158px;">Remove</th></tr>
							</thead>
							<tbody>
								@if($invoice->invoice_detail)
									<input type="text" name="remove_ids" id="remove_ids" hidden>
									@foreach($invoice->invoice_detail as $detail)
									<tr id="{{ $detail->product_id }}">
										<td><input type="hidden" name="in_detail_id[]" value="{{ $detail->id }}"><img src="{{ $detail->featured_src }}" width="80"></td><td>{{ $detail->product_name }}</td>
										<td>{{ $detail->brand_name }}</td><td>{{ $detail->category_name }}</td><td><input type='text' name='in_product_price[]' class='in-product-price' value="{{ $detail->price }}"></td></td><td class="quantity"><input type="hidden" name="in_quantity[]" value="{{ $detail->quantity }}"><span>{{ $detail->quantity }}</span></td><td class="subtotal"><input type="hidden" name="in_sub_total_amount[]" value="{{ $detail->total_amount }}">$<span>{{ $detail->total_amount }}</span></td><td><a href="javascript:void(0)" class="delete-product-invoice" data-toggle="tooltip" data-original-title="Delete" ino="{{ $detail->id }}"><i class="zmdi zmdi-delete txt-warning"></i></a></td>
									</tr>
									@endforeach
								@endif
							</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-6">
						<table class="table">
							<tbody>
							<tr>
								<td>NRIC/Passport No:</td>
								<td><input type="text" class="form-control" name="passport_no" value="{{ $invoice->additional_fields->passport_no ?? null }}"></td>
							</tr>
							<tr>
								<td>Watch Condition:</td>
								<td><input type="text" class="form-control" name="watch_condition" value="{{ $invoice->additional_fields->watch_condition ?? null }}"></td>
							</tr>
							<tr>
								<td>Bracelet Condition/Links:</td>
								<td><input type="text" class="form-control" name="bracelet_condition" value="{{ $invoice->additional_fields->bracelet_condition ?? null }}"></td>
							</tr>
							<tr>
								<td>Consignment Period:</td>
								<td><input type="text" class="form-control" name="consignment_period" value="{{ $invoice->additional_fields->consignment_period ?? null }}"></td>
							</tr>
							<tr>
								<td>Return Date:</td>
								<td>
								<div class="input-group date datepicker">
									<input type="text" class="form-control" value="{{ $invoice->additional_fields->return_date ?? null }}" name="return_date">
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
								</div>
								</td>
							</tr>
							<tr>
								<td>Included:</td>
								<td>
									<input type="checkbox" name="included[]" class="included" value="box" {{ ($invoice->additional_fields->included) ? (in_array('box', $invoice->additional_fields->included) ? 'checked="checked"': '') : '' }}> Box
									<input type="checkbox" name="included[]" class="included" value="guarantee_card" {{ ($invoice->additional_fields->included) ? (in_array('guarantee_card', $invoice->additional_fields->included) ? 'checked="checked"': '') : '' }}> Guarantee Card
									<input type="checkbox" name="included[]" class="included" value="instructions" {{ ($invoice->additional_fields->included) ? (in_array('instructions', $invoice->additional_fields->included) ? 'checked="checked"': '') : '' }}> Instructions
									<input type="checkbox" name="included[]" class="included" value="others" {{ ($invoice->additional_fields->included) ? (in_array('others', $invoice->additional_fields->included) ? 'checked="checked"': '') : '' }}> Others
									<div id="box" class="mt-15" {{ ($invoice->additional_fields->included) ? (in_array('box', $invoice->additional_fields->included) ? '': 'hidden') : 'hidden' }}>
										<label>Box</label>
										<input type="text" name="box" class="form-control" value="{{ $invoice->additional_fields->box ?? null }}">
									</div>
									<div id="guarantee_card" class="mt-15" {{ ($invoice->additional_fields->included) ? (in_array('guarantee_card', $invoice->additional_fields->included) ? '': 'hidden') : 'hidden' }}>
										<label>Guarantee Card</label>
										<input type="text" name="guarantee_card" class="form-control" value="{{ $invoice->additional_fields->guarantee_card ?? null }}">
									</div>
									<div id="instructions" class="mt-15" {{ ($invoice->additional_fields->included) ? (in_array('instructions', $invoice->additional_fields->included) ? '': 'hidden') : 'hidden' }}>
										<label>Instructions</label>
										<input type="text" name="instructions" class="form-control" value="{{ $invoice->additional_fields->instructions ?? null }}">
									</div>
									<div id="others" class="mt-15" {{ ($invoice->additional_fields->included) ? (in_array('others', $invoice->additional_fields->included) ? '': 'hidden') : 'hidden' }}>
										<label>Others</label>
										<input type="text" name="others" class="form-control" value="{{ $invoice->additional_fields->others ?? null }}">
									</div>
								</td>
							</tr>
							<tr>
								<td>Overall Total:</td>
								<td><h5 class="txt-gold"><input type="text" name="total_amount" value="{{ $invoice->total_amount ?? null }}" class="total_amount">$<span class="total_amount">0.00</span></h5></td>
							</tr>
							<tr>
								<td>Remarks:</td>
								<td><input type="text" class="form-control" name="remarks" value="{{ $invoice->additional_fields->remarks ?? null }}"></td>
							</tr>
						</tbody></table>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<button class="btn btn-gold mr-15 btn-lg" type="submit">Save</button>
							<button class="btn btn-default btn-lg">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
