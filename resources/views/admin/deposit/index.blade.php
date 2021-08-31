@extends('layouts.fixed')
@section('title','All Deposits')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Deposits</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Deposits</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-2">
			<div class="col card">
				<div class="card-body">
				<form action="{{ route('deposit.index') }}" method="get">
					<div class="row">
						<div class="col">
							<label for="">Number Sent To</label>
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
							<label for="">Deposited After</label>
							<input type="date" value="{{ request('created_at') }}" class="form-control" name="created_at" >
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
				<div class="row">
					<div class="col">
						<div class="card-title">Recent Deposits</div>
					</div>
					<div class="col">
						<a href="{{ route('deposit.cancel.bulk') }}" class="btn btn-warning btn-sm">Cancel Deposits Pasted one Hour Pending</a>
					</div>
					<div class="card-tools">
						<h5>Balance: {{ $balance }}</h5>
					</div>	
				</div>
			</div>

			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Added</th>
							<th>Username</th>
							<th>Method</th>
							<th>To</th>
							<th>From</th>
							<th>Amount</th>
							<th>status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($deposits as $item)
						<tr>
							<td>{{ ($deposits->total()-$loop->index)-(($deposits->currentpage()-1) * $deposits->perpage() ) }}</td>
							<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>

							<td>{{ $item->user->username }}</td>
							<td>{{ $item->payment_method."--".$item->payment_type }}</td>
							<td>{{ $item->backend_mobile }}</td>
							<td>{{ $item->mobile }}</td>
							<td>{{ $item->amount }}</td>

							<td>
								@if ($item->status === "approved" || $item->status === "canceled")
									<span class="badge badge-warning">{{$item->status}}</span>
								@else
									<form action="{{ route('deposit.update',$item->id) }}" method="post" id="form-{{ $item->id }}">
										@csrf
										@method('PUT')
										<select name="status" id="status" class="form-control" data-id="{{ $item->id }}">
											<option value="pending" selected>Pending</option>
											<option value="approved">Approved</option>
											<option value="canceled">Canceled</option>
										</select>
									</form>
								@endif
								
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6"></td>
							<td>Total: {{ $deposits->where('status','approved')->sum('amount') }}</td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="7"></td>
							<td colspan="2">{{ $deposits->links() }}</td>
						</tr>
					</tfoot>
				</table>
			</div>

		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('change','#status',function(e){
				var id = $(this).data('id');
				var val = $(this).val();
				$('#form-'+id).submit();
			});
		});
	</script>
@endsection