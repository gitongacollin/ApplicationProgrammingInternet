<div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">New Level</h4>
			</div>
			<form action="{{route ('postInsertLevel')}}" method="POST" id="frm-level-create">
				<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<select class="form-control" id="program_id" name="program_id"></select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" name="level" id="level" class="form-control" placeholder="Level">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" name="description" id="description" class="form-control" placeholder="Description">
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button type="submit" class="btn btn-success btn-save-level" type="button">Save</button>
			</div>
		</form>
		</div>
		
	</div>
	
</div>