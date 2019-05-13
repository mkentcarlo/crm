<div class="panel panel-default card-view">
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label mb-10">Invoice Type:</label>
						<input type="hidden" name="invoice_type" value="{{ $invoiceType }}">
						<input type="radio" name="in_out" value="in" {{ $invoice->additional_fields->in_out == 'in' ? 'checked="checked"' : '' }}> In <input type="radio" name="in_out" value="out" {{ $invoice->additional_fields->in_out == 'out' ? 'checked="checked"' : '' }}> Out
					</div>
				</div>
				<div class="clearfix"></div>
				<hr class="light-grey-hr mt-30">
				<div class="col-md-2"></div>
				<div class="clearfix">
					<table class="table table-bordered display product-overview mb-30 other-invoice" role="grid">
							<thead>
								<th>Description</th>
								<th width="150">Amount</th>
								<th>Payment Mode</th>
								<th>Action</th>
							</thead>
							<tbody>
								@if($invoice->additional_fields->in_out_data)
									@foreach($invoice->additional_fields->in_out_data as $data)
									<tr>
										<td><input type="text" class="form-control" name="description[]" value="{{ $data->description ?? null }}"></td>
										<td><input type="text" class="form-control amount" name="amount[]" value="{{ $data->amount ?? 0 }}"></td>
										<td><select class="form-control" name="payment_mode[]"><option value="cash" {{ $data->payment_mode == 'cash' ? 'selected="selected"' : '' }}>Cash</option><option value="cheque" {{ $data->payment_mode == 'cheque' ? 'selected="selected"' : '' }}>Cheque</option></select></td>
										<td class="text-center"><a href="javascript;" class="text-inverse delete pr-10" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a><a href="#" class="text-inverse pr-10 form-load add-row" title="Add row" id="1"><i class="zmdi zmdi-plus txt-warning"></i></a></td>
									</tr>
									@endforeach
								@else
									<tr>
										<td><input type="text" class="form-control" name="description[]"></td>
										<td><input type="text" class="form-control amount" name="amount[]"></td>
										<td><select class="form-control" name="payment_mode[]"><option value="cash">Cash</option><option value="cheque">Cheque</option></select></td>
										<td class="text-center"><a href="javascript;" class="text-inverse delete pr-10" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a><a href="#" class="text-inverse pr-10 form-load add-row" title="Add row" id="1"><i class="zmdi zmdi-plus txt-warning"></i></a></td>
									</tr>
								@endif	
							</tbody>
							<tfoot>
								<tr>
									<input type="hidden" name="total" class="overall-total" value="{{ $invoice->total_amount}}">
									<th></th>
									<th class="text-right">TOTAL</th>
									<th class="overall-total">{{ number_format($invoice->total_amount, 2)}}</th>
									<th></th>
								</tr>
							</tfoot>
					</table>
				</div>
					<div class="col-md-12">
						<div class="pull-left">
							<button class="btn btn-gold mr-15 btn-lg" type="submit">Save</button>
							<button class="btn btn-default btn-lg">Cancel</button>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
