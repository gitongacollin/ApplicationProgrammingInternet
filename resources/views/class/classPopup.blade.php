<div class="modal fade" id="choose-academic" role="dialog">
	<div class="modal-dialog modal-xs">
		<section class="panel panel-default">
			<header class="panel-heading">
				Choose Academic
			</header>
			<form action="#" method="POST" class="form-horizontal" id="frm-view-class">
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="for-group">
						<div class="col-sm-6">
							<label for="academic-year">Academic Year</label>
							<div class="input-group">
								<select name="academic_id" id="academic_id" class="form-control">
									<option value="">------Select------</option>
									@foreach($academics as $key => $y)
										<option value="{{ $y->academic_id }}">{{ $y->academic }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-academic"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-6">
							<label for="program">Course - Program</label>
							<div class="input-group">
								<select name="program_id" id="program_id" class="form-control">
									<option class="text-center" value="">Select</option>
									@foreach($programs as $key => $p)
										<option value="{{ $p->program_id }}">{{ $p->program }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-program"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-6">
							<label for="level">Level</label>
							<div class="input-group">
								<select name="level_id" id="level_id" class="form-control"></select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-level"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-6">
							<label for="shift">Shift</label>
							<div class="input-group">
								<select name="shift_id" id="shift_id" class="form-control">
									<option class="text-center" value="">Select</option>
									@foreach($shifts as $key => $shf)
										<option value="{{ $shf->shift_id }}">{{ $shf->shift }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-shift"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-6">
							<label for="time">Time</label>
							<div class="input-group">
								<select name="time_id" id="time_id" class="form-control">
									<option class="text-center" value="">Select</option>
									@foreach($times as $key => $tm)
										<option value="{{ $tm->time_id }}">{{ $tm->time }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-time"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-3">
							<label for="batch">Batch</label>
							<div class="input-group">
								<select name="batch_id" id="batch_id" class="form-control">
									<option class="text-center" value="">Select</option>
									@foreach($batches as $key => $bt)
										<option value="{{ $bt->batch_id }}">{{ $bt->batch }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-batch"></span>
								</div>
							</div>
						</div>
						{{------------------------------------}}
						<div class="col-sm-3">
							<label for="group">Group</label>
							<div class="input-group">
								<select name="group_id" id="group_id" class="form-control">
									<option class="text-center" value="">Select</option>
									@foreach($groups as $key => $g)
										<option value="{{ $g->group_id }}">{{ $g->group }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-group"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

			<form action="@" method="GET" id="frm-multi-class">
				<div class="panel panel-default">
					<div class="panel-heading">
						Class Information
						<button type="button" id="btn-go" class="btn btn-info btn-xs pull-right" style="margin-top: 5px;">Go</button>
					</div>
					<div class="panel-body" id="add-class-info" style="overflow-y: auto; height: 250px;"></div>
				</div>
			</form>
		</section>
	</div>
</div>