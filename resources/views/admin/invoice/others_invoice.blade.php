<div class="panel panel-default card-view">
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="col-md-4">
					<!-- <div class="form-group">
						<label class="control-label mb-10">Invoice Type:</label>
						<select class="form-control" name="invoice_type" id="invoice_type">
							<option value="sales" {{ $invoiceType  == 'sales' ? 'selected="selected"' : '' }}>Sales</option>
							<option value="consign_in" {{ $invoiceType  == 'consign_in' ? 'selected="selected"' : '' }}>Consign IN</option>
							<option value="consign_out" {{ $invoiceType  == 'consign_out' ? 'selected="selected"' : '' }}>Consign OUT</option>
							<option value="purchase" {{ $invoiceType  == 'purchase' ? 'selected="selected"' : '' }}>Purchase</option>
							<option value="repair" {{ $invoiceType  == 'repair' ? 'selected="selected"' : '' }}>Repair</option>
							<option value="others" {{ $invoiceType  == 'others' ? 'selected="selected"' : '' }}>Others</option>
						</select>
					</div> -->
					<div class="form-group">
						<label class="control-label mb-10">Invoice Type:</label>
						<input type="radio"> In <input type="radio"> Out
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
								<tr>
									<td><input type="text" class="form-control" name="description[]"></td>
									<td><input type="text" class="form-control amount" name="amount[]"></td>
									<td><select class="form-control"><option>Cash</option><option>Cheque</option></select></td>
									<td class="text-center"><a href="javascript;" class="text-inverse delete pr-10" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a><a href="#" class="text-inverse pr-10 form-load add-row" title="Add row" id="1"><i class="zmdi zmdi-plus txt-warning"></i></a></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th class="text-right">TOTAL</th>
									<th class="overall-total">0.00</th>
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
