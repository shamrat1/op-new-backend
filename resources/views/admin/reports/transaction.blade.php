@extends('layouts.fixed')
@section('title','Transaction Report')
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
                    <h1 class="m-0 text-dark">Transaction Report {{ Carbon\Carbon::now()->format('d M Y h:i A') }}</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Report</a></li>
						<li class="breadcrumb-item"><a href="#">Transactions</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-3">
		<div class="row">
			<div class="col card">
                <div class="card-body">
					<form action="{{ route('report.transaction.filter') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="date" placeholder="From Date" name="from" required class="form-control @error('from') invalid @enderror">
								@error('from')
									<small class="text-danger">{{ $message }}</small>
								@enderror
                            </div>
                            <div class="col">
								<input type="date" placeholder="Till Date" name="till" class="form-control @error('till') invalid @enderror">
								@error('till')
									<small class="text-danger">{{ $message }}</small>
								@enderror
                            </div>
                            <div class="col">
                                <select name="type" id="" class="form-control">
                                    <option value="all">All</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">withdraw</option>
                                    <option value="onBet">onBet</option>
                                    <option value="betWin">Bet Win</option>
                                </select>
                                @error('type')
									<small class="text-danger">{{ $message }}</small>
								@enderror
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
	@isset($transactions)
		<div class="ml-3">
		<div class="row">
			<div class="col card">
				<div class="card-header">
					<div class="card-title">Transactions</div>
				</div>
				<div class="card-body">
					<table class="" id="depositTable">
						<thead>
                            @isset($validated)
                                <tr>
                                    <th colspan="3">Records: {{ $validated['from'].' to '.$validated['till'] }}</th>
                                    <th colspan="3">Type: {{ $validated['type'] }}</th>
                                </tr>
                            @endisset
							<tr>
                                <th>Username</th>
								<th>Amount</th>
								<th>Type</th>
								<th>From</th>
								<th>To</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($transactions as $item)
									<tr>
                                        <td>{{ $item->user->username }}</td>
										<td>{{ $item->amount }}</td>
										<td>{{ $item->type }}</td>
										<td>{{ $item->mobile }}</td>
										<td>{{ $item->backend_mobile }}</td>
										<td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
									</tr>
							@endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Results: {{ count($transactions) }}</td>
                                <td>Total Amount: {{ $transactions->sum('amount') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
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
            @isset($validated)
                var from = "{{{ $validated['from'] }}}";
                var till = "{{{ $validated['till'] }}}";
                var type = "{{{ $validated['type'] }}}";
            @endisset
			$('#depositTable').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					{ extend: 'copyHtml5', footer: true },
                    { extend: 'excelHtml5', footer: true },
                    { extend: 'csvHtml5', footer: true },
                    { extend: 'pdfHtml5', footer: true, header: true, messageTop: 'Records: '+from+' to '+till+'. Type:'+type+'.' }
				],
                "pageLength":25
			} );
		} );
	</script>
@endsection