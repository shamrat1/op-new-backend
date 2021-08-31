@extends('layouts.fixed')
@section('title','Show User')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Edit User Information</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<div class="ml-4">
	<div class="row">
		<div class="col-sm-8 col-md-9 col-lg-9 card card-outline card-warning">
			<div class="card-header">
				<div class="card-title">
					{{ $user->name }}
				</div>
				<div class="card-tools">
					Credits <span class="text-secondary text-danger">{{ $user->credit->amount }} </span>BDT
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						@if(count($user->roles) > 0)
						<h5>User Roles</h5>
						<ol>
							@foreach($user->roles as $role)
							<li>{{ $role->name }}</li>
							@endforeach
						</ol>
						@else
						<h5 class="text-warning">NO Roles defined</h5>
						@endif
					</div>
					<div class="col">
						<!-- {{-- <form class="form">
							<div class="form-group">
								<label>Give New Role</label>
								<select class="multi-role-select form-control" name="states[]" multiple="multiple">
									@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
						</form> --}} -->
					</div>
				</div>
				<hr>
				<h4>Bet History</h4>

				<div class="row">

					<table class="table table-responsive">
						<thead>
							<tr>
								<th>#</th>
								<th>Match Name</th>
								<th>Bet Option</th>
								<th data-priority="1">Amount</th>
								<th data-priority="2">Bet Name</th>
								<th data-priority="3">Bet Value</th>
								<th data-priority="4">Status</th>
								<th>Added</th>
							</tr>
						</thead>
						<tbody>
							@foreach($bets as $bet)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $bet->match->name }}</td>
									<td>{{ !empty($bet->betDetail) ? $bet->betDetail->betsForMatch->betOption->name : 'Bet Option Deleted.'}}</td>
									<td>{{ $bet->amount }}</td>
									<td>{{ $bet->bet_name }}</td>
									<td>{{ $bet->bet_value }}</td>
									@php
										$res = $bet->isCorrect($bet->betDetail->id)
									@endphp
									<td>@if ($res)
											<span class="text-success">WIN</span>
										@elseif($res == "not set")
											<span class="text-default">Result Not Set</span>
										@else
											<span class="text-danger">Lose</span>
										@endif
									</td>
									<td>{{ Carbon\Carbon::parse($bet->created_at)->format('d M Y h:i A') }}</td>
								</tr>
							@endforeach
						</tbody>
						
					</table>
				</div>

				<hr>
				<h4>Transaction History</h4>

				<div class="row">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th>#</th>
								<th>From</th>
								<th>To</th>
								<th>Method</th>
								<th>Transaction Type</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Added</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transactions as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->mobile }}</td>
									<td>{{ $item->backend_mobile }}</td>
									<td>{{ $item->payment_method }}</td>
									<td>{{ $item->type }}</td>
									<td>{{ $item->amount }}</td>
									<td>{{ $item->status }}</td>
									<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="8">{{ $transactions->links() }}</td>
							</tr>
						</tfoot>
					</table>
				</div>

			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col text-left text-muted">
						Joined {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
					</div>
					<!-- <div class="col text-right text-muted">
						@if($user->created_at === $user->updated_at)
						No Update yet
						@else
						Updated {{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
						@endif
					</div> -->
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.multi-role-select').select2();
	});
</script>
@endsection