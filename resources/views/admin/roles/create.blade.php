<div id="createModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="create_role">
	            {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myModalLabel">Add Role</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label mb-10">Name Of Role</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label class="control-label mb-10">Select Permissions</label>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Users</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.user"> View<br/>
								<input type="checkbox" name="permission[]" value="create.user"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.user"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.user"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Customers</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.customer"> View<br/>
								<input type="checkbox" name="permission[]" value="create.customer"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.customer"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.customer"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Products</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.product"> View<br/>
								<input type="checkbox" name="permission[]" value="create.product"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.product"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.product"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Brands</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.brand"> View<br/>
								<input type="checkbox" name="permission[]" value="create.brand"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.brand"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.brand"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Categories</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.category"> View<br/>
								<input type="checkbox" name="permission[]" value="create.category"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.category"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.category"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Invoices</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.invoice"> View<br/>
								<input type="checkbox" name="permission[]" value="create.invoice"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.invoice"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.invoice"> Delete<br/>
							</div>
						</div>
						<div style="margin-left: 16px;margin-bottom: 8px;">
							<label>Manage Reports</label>
							<div style="margin-left: 8px;">
								<input type="checkbox" name="permission[]" value="view.report"> View<br/>
								<input type="checkbox" name="permission[]" value="create.report"> Create<br/>
								<input type="checkbox" name="permission[]" value="edit.report"> Edit<br/>
								<input type="checkbox" name="permission[]" value="delete.report"> Delete<br/>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-gold waves-effect">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>