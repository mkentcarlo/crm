<div class="panel panel-default card-view">
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Invoice Type:</label>
						<select class="form-control" name="invoice_type" id="invoice_type">
							<option value="sales" {{ ($invoice->invoice_type == 'sales') ? 'selected="selected"' : ($invoiceType  == 'sales' ? 'selected="selected"' : '') }}>Sales</option>
							<option value="consign_in" {{ ($invoice->invoice_type == 'consign_in') ? 'selected="selected"' : ($invoiceType  == 'consign_in' ? 'selected="selected"' : '') }}>Consign IN</option>
							<option value="consign_out" {{ ($invoice->invoice_type == 'consign_out') ? 'selected="selected"' : ($invoiceType  == 'consign_out' ? 'selected="selected"' : '') }}>Consign OUT</option>
							<option value="purchase" {{ ($invoice->invoice_type == 'purchase') ? 'selected="selected"' : ($invoiceType  == 'purchase' ? 'selected="selected"' : '') }}>Purchase</option>
							<option value="repair" {{ ($invoice->invoice_type == 'repair') ? 'selected="selected"' : ($invoiceType  == 'repair' ? 'selected="selected"' : '') }}>Repair</option>
						</select>
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
						<option value="{{ $customer->id }}" {{ $invoice->customer->id == $customer->id ? 'selected="selected"' : '' }}>{{ $customer->lastname .' '. $customer->firstname }}</option>
						@endforeach
						</select>
					<p class="mt-20" id="street_address">795 Folsom Ave, Suite 600</p>
					<p>San Francisco, CA 94107</p>
					<p>P:(133) 456-7890</p>
					<p>jsmith@email.com</p>
				</div>
				<div class="clearfix"></div>
				<hr class="light-grey-hr mt-30">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Select Watch:</label>
						<select class="form-control select2" id="product_id">
							@foreach($products as $product)
							<option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label class="control-label mb-10">Quantity:</label>
							<input type="text" class="form-control" id="quantity" value="1">
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
										<td>{{ $detail->brand_name }}</td><td>{{ $detail->category_name }}</td><td>{{ $detail->price }}</td><td class="quantity"><input type="hidden" name="in_quantity[]" value="{{ $detail->quantity }}"><span>{{ $detail->quantity }}</span></td><td class="subtotal"><input type="hidden" name="in_sub_total_amount[]" value="{{ $detail->total_amount }}">$<span>{{ $detail->total_amount }}</span></td><td><a href="javascript:void(0)" class="delete-product-invoice" data-toggle="tooltip" data-original-title="Delete" ino="{{ $detail->id }}"><i class="zmdi zmdi-delete txt-warning"></i></a></td>
									</tr>
									@endforeach
								@endif
							</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-6">
						<table class="table">
							<tbody><tr>
								<th>Total Amount:</th>
								<td>$<span id="subtotal">0.00</span></td>
							</tr>
							<tr>
								<td>Discount:</td>
								<td><input type="text" class="form-control" name="discount" id="discount" value="{{ $invoice->additional_fields->discount ?? null }}"></td>
							</tr>
							<tr>
								<td>Tax:</td>
								<td><input type="text" class="form-control" name="tax" id="tax" value="{{ $invoice->additional_fields->tax ?? null }}"></td>
							</tr>
							<tr>
								<td>Payment Method:</td>
								<td>
									<input type="checkbox" name="payment_method[]" class="payment_method" value="cash" {{ ($invoice->additional_fields->payment_method) ? (in_array('cash', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Cash
									<input type="checkbox" name="payment_method[]" class="payment_method" value="credit_card" {{ ($invoice->additional_fields->payment_method) ? (in_array('credit_card', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Credit Card
									<div id="cash" class="mt-15" {{ ($invoice->additional_fields->payment_method) ? (in_array('cash', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
										<label>Cash $</label>
										<input type="text" name="cash_amount" class="form-control" value="{{ $invoice->additional_fields->cash_amount ?? null }}">
									</div>
									<div id="credit_card" class="mt-15" {{ ($invoice->additional_fields->payment_method) ? (in_array('credit_card', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
										<label>Credit Card</label> <button type="button" class="add-more-card">Add more</button>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Card Name</th>
													<th>Card Number</th>
													<th>Amount</th>
													<th><button type="button" class="add-more-card btn btn-default btn-xs"><i class="fa fa-plus"></i></button></th>
												</tr>
											</thead>
											<tbody id="credit_card_holder">
												@if(!empty($invoice->additional_fields->card_info))
													@foreach($invoice->additional_fields->card_info as $cardInfo)
													<tr>
														<td><input type="text" name="card_name[]" class="form-control" value="{{ $cardInfo->card_name }}"></td>
														<td><input type="text" name="card_number[]" class="form-control" value="{{ $cardInfo->card_number }}"></td>
														<td><input type="text" name="card_amount[]" class="form-control" value="{{ $cardInfo->card_amount }}"></td>
														<td><button type="button" class="remove-card btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
													</tr>
													@endforeach
												@else
												<tr>
													<td><input type="text" name="card_name[]" class="form-control"></td>
													<td><input type="text" name="card_number[]" class="form-control"></td>
													<td><input type="text" name="card_amount[]" class="form-control"></td>
													<td></td>
												</tr>
												@endif
											</tbody>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<td>Overall Total:</td>
								<td><h5 class="txt-gold"><input type="hidden" name="total_amount" value="{{ $invoice->total_amount ?? null }}" class="total_amount">$<span class="total_amount">{{ $invoice->total_amount ?  $invoice->total_amount: '0.00' }}</span></h5></td>
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
