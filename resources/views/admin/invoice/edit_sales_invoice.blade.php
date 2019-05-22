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
						<select class="form-control customer-dropdown" name="customer_id" id="customer_id" required="">
						<option value="">--please select--</option>	
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
							<option value="">--please select--</option>	
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
							<small id="short_description">This section only appears if there is watch selected.</small>
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
					<div class="col-md-12">
						<table class="table">
							<tbody><tr>
								<th>Total Amount:</th>
								<td>$<span id="subtotal">0.00</span></td>
							</tr>
							<!-- <tr>
								<td>Discount:</td>
								<td><input type="text" class="form-control" name="discount" id="discount" value="{{ $invoice->additional_fields->discount ?? null }}"></td>
							</tr>
							<tr>
								<td>Tax:</td>
								<td><input type="text" class="form-control" name="tax" id="tax" value="{{ $invoice->additional_fields->tax ?? null }}"></td>
							</tr> -->
							<tr>
								<td>Payment Method:</td>
								<td>
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('cash', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="cash" {{ ($invoice->additional_fields->payment_method) ? (in_array('cash', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Cash
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('credit_card', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="credit_card" {{ ($invoice->additional_fields->payment_method) ? (in_array('credit_card', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Credit Card
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('bank_transfer', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="bank_transfer" {{ ($invoice->additional_fields->payment_method) ? (in_array('bank_transfer', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Bank Transfer
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('pay_now', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="pay_now" {{ ($invoice->additional_fields->payment_method) ? (in_array('pay_now', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Pay Now
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('net', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="net" {{ ($invoice->additional_fields->payment_method) ? (in_array('net', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Net
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('others', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="others" {{ ($invoice->additional_fields->payment_method) ? (in_array('others', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Others
									<input type="checkbox" name="payment_method[]" class="payment_method {{ ($invoice->additional_fields->payment_method) ? (in_array('installment', $invoice->additional_fields->payment_method) ? 'checked': '') : '' }}" value="installment" {{ ($invoice->additional_fields->payment_method) ? (in_array('installment', $invoice->additional_fields->payment_method) ? 'checked="checked"': '') : '' }}> Installment 
									<div id="cash" class="mt-15" {{ ($invoice->additional_fields->payment_method) ? (in_array('cash', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
										<hr>
										<h5>Cash</h5>
										<label>Amount</label>
										<input type="text" name="cash_amount" class="form-control" value="{{ $invoice->additional_fields->cash_amount ?? null }}" id="cash_amount">
									</div>
									<div id="pay_now" class="mt-15 row" {{ ($invoice->additional_fields->payment_method) ? (in_array('pay_now', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
										<div class="col-md-12">
										<h5>Pay Now</h5>
										</div>
										<div class="col-md-6">
										
											<label>Name</label>
											<input type="text" name="pay_now_name" class="form-control" value="{{ $invoice->additional_fields->pay_now_name ?? null }}">
										</div>
										<div class="col-md-6">
											<label>Amount</label>
											<input type="text" name="pay_now_amount" class="form-control" value="{{ $invoice->additional_fields->pay_now_amount ?? null }}" id="pay_now_amount">
										</div>
									</div>
									<div id="bank_transfer" class="mt-15 row" {{ ($invoice->additional_fields->payment_method) ? (in_array('bank_transfer', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
									
										<div class="col-md-12">
										<h5>Bank Transfer</h5>
											<label>Amount</label>
											<input type="text" name="bank_transfer_amount" class="form-control" value="{{ $invoice->additional_fields->bank_transfer_amount ?? null }}" id="bank_transfer_amount">
										</div>
									</div>
									<div id="net" class="mt-15 row" {{ ($invoice->additional_fields->payment_method) ? (in_array('net', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
									
										<div class="col-md-12">
										<h5>Net</h5>
											<label>Amount</label>
											<input type="text" name="net_amount" class="form-control" value="{{ $invoice->additional_fields->net_amount ?? null }}" id="net_amount">
										</div>
									</div>
									<div id="others" class="mt-15 row" {{ ($invoice->additional_fields->payment_method) ? (in_array('others', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
									
										<div class="col-md-12">
											<h5>Others</h5>
										</div>
										<div class="col-md-6">
											<label>Specify</label>
											<input type="text" name="others_specify" class="form-control" value="{{ $invoice->additional_fields->others_specify ?? null }}">
										</div>
										<div class="col-md-6">
											<label>Amount</label>
											<input type="text" name="others_amount" class="form-control" value="{{ $invoice->additional_fields->others_amount ?? null }}" id="others_amount">
										</div>
									</div>
									<div id="installment" class="mt-15 row" {{ ($invoice->additional_fields->payment_method) ? (in_array('installment', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
									
										<div class="col-md-12">
											<h5>Installment</h5>
										</div>
										<div class="col-md-12 form-group">
											<label>Amount</label>
											<input type="text" name="installment_amount" class="form-control" value="{{ $invoice->additional_fields->installment_amount ?? null }}" id="installment_amount">
										</div>
										<div class="col-md-12 form-group">
											<label>Duration</label> <br>
											<input type="radio" name="installment_duration" value="6 months" {{ isset($invoice->additional_fields->installment_duration) && $invoice->additional_fields->installment_duration == '6 months' ? 'checked="checked"' : '' }}> 6 months 
											<input type="radio" name="installment_duration" value="12 months" {{ isset($invoice->additional_fields->installment_duration) && $invoice->additional_fields->installment_duration == '12 months' ? 'checked="checked"' : '' }}> 12 months 
											<input type="radio" name="installment_duration" value="24 months" {{ isset($invoice->additional_fields->installment_duration) && $invoice->additional_fields->installment_duration == '24 months' ? 'checked="checked"' : '' }}> 24 months
											<input type="radio" name="installment_duration" value="36 months" {{ isset($invoice->additional_fields->installment_duration) && $invoice->additional_fields->installment_duration == '36 months' ? 'checked="checked"' : '' }}> 36 months
										</div>
									</div>
									<div id="credit_card" class="mt-15" {{ ($invoice->additional_fields->payment_method) ? (in_array('credit_card', $invoice->additional_fields->payment_method) ? '': 'hidden') : 'hidden' }}>
									<hr>
									<h5>Credit Card</h5>	
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Card Type</th>
													<th>Bank Name</th>
													<th>Card Holder Name</th>
													<th>Card Number</th>
													<th>Amount</th>
													<th><button type="button" class="add-more-card btn btn-default btn-xs"><i class="fa fa-plus"></i></button></th>
												</tr>
											</thead>
											<tbody id="credit_card_holder">
												@if(!empty($invoice->additional_fields->card_info))
													@foreach($invoice->additional_fields->card_info as $cardInfo)
													<tr>
														<td><select type="text" name="card_type[]" class="form-control">
														<option value="amex" {{ $cardInfo->card_type == 'amex' ? 'selected="selected"' : '' }}>amex</option>
														<option value="visa" {{ $cardInfo->card_type == 'visa' ? 'selected="selected"' : '' }}>visa</option>
														<option value="master" {{ $cardInfo->card_type == 'master' ? 'selected="selected"' : '' }}>master</option>
														<option value="jcb" {{ $cardInfo->card_type == 'jcb' ? 'selected="selected"' : '' }}>jcb</option>
														<option value="china unionpay" {{ $cardInfo->card_type == 'china unionpay' ? 'selected="selected"' : '' }}>china unionpay</option>
													</select></td>
														<td><input type="text" name="bank_name[]" class="form-control" value="{{ $cardInfo->bank_name }}"></td>
														<td><input type="text" name="card_name[]" class="form-control" value="{{ $cardInfo->card_name }}"></td>
														<td><input type="text" name="card_number[]" class="form-control" value="{{ $cardInfo->card_number }}"></td>
														<td><input type="text" name="card_amount[]" class="form-control card_amount" value="{{ $cardInfo->card_amount }}"></td>
														<td><button type="button" class="remove-card btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
													</tr>
													@endforeach
												@else
												<tr>
													<td><select type="text" name="card_type[]" class="form-control">
														<option value="amex">amex</option>
														<option value="visa">visa</option>
														<option value="master">master</option>
														<option value="jcb">jcb</option>
														<option value="china unionpay">china unionpay</option>
													</select></td>
													<td><input type="text" name="bank_name[]" class="form-control"></td>
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
							<button class="btn btn-gold mr-15 btn-lg" type="submit" id="submit">Save</button>
							<button class="btn btn-default btn-lg">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
