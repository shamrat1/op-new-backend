@extends('layouts.fixed')
@section('title','All Withdraws')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Withdraws</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Withdraws</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
	<div class="col card">
				<div class="card-body">
				<form action="{{ route('withdraw.index') }}" method="get">
					<div class="row">
						<div class="col">
							<label for="">Sites Number</label>
							<input type="text" value="{{ request('to') }}" placeholder="Sites mobile" name="to" class="form-control">
						</div>
						<div class="col">
							<label for="">Username</label>
							<input type="text" value="{{ request('username') }}" class="form-control" name="username" placeholder="Username">
						</div>
						<div class="col">
							<label for="">Amount Greater Than</label>
							<input type="text" value="{{ request('credit') }}" class="form-control" name="credit" placeholder="Amount more than">
						</div>
						<div class="col">
							<label for="">Requested At</label>
							<input type="date" value="{{ request('requested_at') }}" class="form-control" name="requested_at" >
						</div>
						<div class="col">
							<label for="">Status</label>
							<select name="status" class="form-control" id="">
								<option value="" >Select Status</option>
								<option value="pending" @if(request('status') == "pending") selected="selected" @endif>Pending</option>
								<option value="accepted" @if(request('status') == "accepted") selected="selected" @endif>Accepted</option>
								<option value="canceled" @if(request('status') == "canceled") selected="selected" @endif>Canceled</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col text-center">
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-search"></i></button>
							<a href="{{ route('deposit.index') }}" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
						</div>
					</div>
					</form>
				</div>
			</div>
		<div class="card card-primary card-outline col">
			<div class="card-header">
				<div class="card-title">Recent Withdraws <br>
					<small class="text-danger">*ATWB ( AT The Time of Withdraw Balance )</small>
				</div>
				<div class="card-tools">
					<!-- <button class="btn btn-primary"><i class="fas fa-plus"></i></button> -->
					<h5>Balance: {{ $balance }}</h5>
				</div>	
			</div>

			<div class="card-body" style="overflow-x:auto;">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th style="width: 10%">Current Balance</th>
							<th style="width: 5%">amount</th>
							<th>To</th>
							<th>Method</th>
							<th style="width: 5%">From</th>
							<th>Sent</th>
							{{-- <th>status</th> --}}
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($withdraws as $item)
						<tr>
							<td>{{ ($withdraws->total()-$loop->index)-(($withdraws->currentpage()-1) * $withdraws->perpage() ) }}</td>
							<td>{{ $item->user->username }}</td>
							<td><span class="text-danger">{{ $item->user->credit->amount }}</span><br/><span class="text-primary">{{ $item->txn_id }}</span></td>
							<td>{{ $item->amount }}</td>
							<td>
								@php
									$userMobile = $item->user->mobile;
								@endphp
								@if ($userMobile != null)
									<span class="text-primary">{{ $item->user->mobile }}</span><br>
									<span class="{{ $item->user->mobile == $item->mobile ? 'text-success' : 'text-danger' }}">{{ $item->mobile }}</span>
								@else
									<span class="text-danger">{{ $item->mobile }}</span>
								@endif
								</td>
							<td>{{ $item->payment_method."--".$item->payment_type }}</td>
							<td>{{ $item->backend_mobile }}</td>
							{{-- <td>{{ $item->txn_id }}</td> --}}
							<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
							{{-- <td>{{ $item->status }}</td> --}}
							<td>
								@if ($item->status === "pending" || $item->status === "accepted")
									<form action="{{ route('withdraw.update') }}" method="POST" id="form-{{ $item->id }}">
										@csrf
										<input type="hidden" name="id" value="{{ $item->id }}">
										<select name="status" id="status" class="form-control" data-id="{{ $item->id }}">
											<option value="pending" {{ $item->status == "pending" ? 'selected' : '' }}>Pending</option>
											<option value="approved" >Approved</option>
											<option value="accepted" {{ $item->status == "accepted" ? 'selected' : '' }}>Accepted</option>
											<option value="canceled">Canceled</option>
										</select>
									</form>
								@else
									<span class="badge badge-warning">{{$item->status}}</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3"></td>
							<td>Total: {{ $withdraws->sum('amount') }}</td>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="7"></td>
							<td colspan="3">{{ $withdraws->links() }}</td>
						</tr>
					</tfoot>
				</table>
			</div>

		</div>
	</div>
@endsection
@section('plugin-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('plugin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
@section('script')
	<script>
		$(document).on('change','#status',function (e) {
			var id = $(this).data('id');
			var val = $(this).val();
			if (val == "approved") {
				$.confirm({
					icon:"fas fa-exclamation-triangle",
					title:"<h5 class='text-warning'>Warning!</h5>",
					content:"<form action='{{ route('withdraw.update') }}' class='withdrawForm' method='POST'>" +
							'@csrf'+
							'<input type="hidden" name="id" value="'+id+'">'+
							'<div class="form-group">' +
							'<label>Enter Money Sent from No</label>' +
							'<input type="text" name="backend_number" placeholder="Phone Number" class="name form-control" required />' +
							'<input type="hidden" name="status" value="'+val+'"/>' +
							'</div>' +
							'</form>',
					buttons:{
						Save:{
						btnClass: 'btn-warning',
						action: function(){
							$('.withdrawForm').submit()
							}
						},
						Cancel: function(){
							// close pop up
						}
					}
				})
			}else{
				$('#form-'+id).submit();
			}
		})
	</script>
@endsection