@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')
@include('fee.createFee')
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="col-md-3">
				{!! Form::open(['route' => ['showStudentPayment'], 'method' => 'GET', 'class' => 'search-payment']) !!}
					<input class="form-control" value="{{ $student_id }}" name="student_id" placeholder="Student ID" type="text" />
				{!! Form::close() !!}
			</div>
			<div class="col-md-3">
				<label class="eng-name">Name: <b class="student-name"> {{ $status->first_name." ".$status->last_name}}</b></label>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3" style="text-align: right;">
				<label class="date-invoice">Date: <b>{{ date('d-M-Y') }}</b></label>
			</div>
			<div class="col-md-3" style="text-align: right;">
				<label class="invoice-number">Receipt Number<sup>{{sprintf('%05d',$receipt_id+1)}}</sup>: <b></b></label>
			</div>
			</div>

			<form action="{{count($readStudentFee) !=0 ?route('extraPay') : route('savePayment') }}" method="POST" id="frmPayment">

				@csrf
			<div class="panel-body">
			<table style="margin-top: -12px;">
				<caption class="academicDetail"> 
					{{ $status->program }} / 
					Level-{{$status->level}} / 
					Shift-{{$status->shift}} / 
					Time-{{$status->time}} / 
					Batch-{{$status->batch}} / 
					Group-{{$status->group}}
				</caption>
				<thead>
					<tr>
						<th>Program</th>
						<th>Level</th>
						<th>School Fee(KSH)</th>
						<th>Amount(KSH)</th>
						<th>Dis(%)</th>
						<th>Paid(KSH)</th>
						<th>Balance(KSH)</th>
					</tr>
				</thead>
				<tr>
					<td>
						<select id="program_id" name="program_id" class="d">
							<option value="">---------Select-----------</option>
							@foreach($programs as $key=> $p)
                              <option value="{{ $p->program_id}}" {{ $p->program_id==$status->program_id? 'selected' : null}}>{{ $p->program }}</option>
                            @endforeach
						</select>
					</td>
					<td>
						<select id="Level_ID" class="d">
							<option value="">---------Select-----------</option>
							@foreach($levels as $key=> $l)
                              <option value="{{ $l->level_id}}"{{ $l->level_id==$status->level_id?'selected' : null}}>{{ $l->level }}</option>
                            @endforeach
						</select>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon create-fee" title="Create Fee" style="cursor: pointer;color: blue;padding: 0px 3px; border-right: none;">(KSH)
								</span>
						<input type="text" name="fee" id="Fee" value="{{ $studentfee->amount ?? 'NIL' }}" readonly>
						</div>


						<input type="hidden" name="fee_id" value="{{ $studentfee->fee_id ?? 'NIL' }}" id="fee_id" />
						<input type="hidden" name="student_id" value="{{ $student_id}}" id="student_id" />
						<input type="hidden" name="level_id" value="{{ $status->level_id }}" id="level_id" />
						<input type="hidden" name="user_id" value="{{ Auth::id() }}" id="user_id" />
						<input type="hidden" name="transact_date" value="{{ date('Y-m-d H:i:s') }}" id="TransacDate" />
						<input type="hidden" name="s_fee_id" id="s_fee_id">
					</td>
					<td>
						<input type="text" name="amount" id="Amount" required class="d" />
					</td>
					<td>
						<input type="text" name="discount" id="Discount" class="d" />
					</td>
					<td>
						<input type="text" name="paid" id="Paid" />
					</td>
					<td>
						<input type="text" name="balance" id="Lack" disabled="" />
					</td>
				</tr>
				<thead>
					<tr>
						<th colspan="2">Remark</th>
						<th colspan="2">Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2">
							<input type="text" name="remark" id="remark" />
						</td>
						<td colspan="5">
							<input type="text" name="description" id="description" />
						</td>
					</tr>
				</tbody>
			</table>
	</div>
	<div class="panel-footer" align="center" >
		<input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment" value="{{ count($readStudentFee)!=0 ? 'Extra Pay' : 'Save'}}">
		
		@if(count($readStudentFee)!=0)
		<a href="{{ route('printInvoice', $receipt_id) }}" class="btn btn-primary btn-sm" title="print" target="_blank"><i class="fa fa-print"></i>Print</a>
		@endif

		<input type="button" onclick="this.form.reset()" name="btn-go" class="btn btn-danger btn-reset " value="Reset">
		
	</div>
</form>
</div>

	@if(count($readStudentFee)!=0)
		@include('fee.list.studentFeeList')
		<input type="hidden" value="0" id="disabled" >
	@endif
</div>
@endsection


@section('view.scripts')
	@include('fee.script.calculate')
	@include('fee.script.payment')
@endsection