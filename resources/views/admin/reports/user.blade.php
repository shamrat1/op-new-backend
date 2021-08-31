@extends('layouts.fixed')
@section('title','User Report')
@section('style')
	<style>
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>
	</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">User Report @isset($user)
						of {{ Str::ucfirst($user->username) }}
					@endisset</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Report</a></li>
						<li class="breadcrumb-item"><a href="#">Users</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-3">
		<div class="row">
			<div class="col card">
                <div class="card-body">
					<form action="{{ route('report.user.filter') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <h5>Enter Username :</h5>
                            </div>
                            <div class="col-6">
								<input type="text" placeholder="EX: test123" name="username" class="form-control @error('username') invalid @enderror">
								@error('username')
									<small class="text-danger">{{ $message }}</small>
								@enderror
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block">Get Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
	@isset($user)
		<div class="ml-3">
		<div class="row">
			<div class="col card">
				<div class="card-header">
					<div class="card-title">Deposits</div>
				</div>
				<div class="card-body">
					<table class="" id="depositTable">
						<thead>
							<tr>
								<th>Amount</th>
								<th>From</th>
								<th>To</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($user->transactions as $item)
								
								@if ($item->type === "deposit")
									<tr>
										<td>{{ $item->amount }}</td>
										<td>{{ $item->mobile }}</td>
										<td>{{ $item->backend_mobile }}</td>
										<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="ml-3">
		<div class="row">
			<div class="col card">
				<div class="card-header">
					<div class="card-title">Withdraws</div>
				</div>
				<div class="card-body">
					<table class="" id="withdrawTable">
						<thead>
							<tr>
								<th>Amount</th>
								<th>From</th>
								<th>To</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($user->transactions as $item)
								
								@if ($item->type === "withdraw")
									<tr>
										<td>{{ $item->amount }}</td>
										<td>{{ $item->mobile }}</td>
										<td>{{ $item->backend_mobile }}</td>
										<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="ml-3">
		<div class="row">
			<div class="col card">
				<div class="card-header">
					<div class="card-title">On Bets</div>
				</div>
				<div class="card-body">
					<table class="" id="betTable">
						<thead>
							<tr>
								<th>Match</th>
								<th>Option</th>
								<th>Selected</th>
								<th>Amount</th>
								<th>Rate</th>
								<th>Status</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($user->placedBets as $item)
								<tr>
									<td>{{ $item->match->name }}</td>
									<td>{{ $item->betDetail->betsForMatch->betOption->name }}</td>
									<td>{{ $item->bet_name }}</td>
									<td>{{ $item->amount }}</td>
									<td>{{ $item->bet_value }}</td>
									<td>{{ $item->isCorrect($item->betDetail->id) ? "Win" : "Lose" }}</td>
									<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endisset
@endsection
@section('script')
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#depositTable').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'pdf'
				]
			} );
			$('#withdrawTable').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'pdf'
				]
			} );
			$('#betTable').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'pdf'
				]
			} );
		} );
	</script>
@endsection