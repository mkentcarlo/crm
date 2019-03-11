<div id="createModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="create_brand">
            {{ csrf_field() }}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title" id="myModalLabel">Add Brand</h5>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label mb-10">Name of Brand</label>
					<input type="text" class="form-control" name="name">
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