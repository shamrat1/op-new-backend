@extends('layouts.fixed')
@section('title','All Game History')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Game History</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Game History</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="row">
		<div class="col">
			<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Game History</h3>
				<div class="card-tools">
					<!-- Buttons, labels, and many other things can be placed here! -->
					<!-- Here is a label for example -->
					
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered col-sm">
					<thead>
						<tr>
							<td>#</td>
							<td>Game</td>
							<td>Username</td>
							<td>Rate</td>
							<td>Value</td>
							<td>Amount</td>
							<td>Status</td>
							<td>Placed At</td>
						</tr>
					</thead>
					<tbody>
                        @foreach($history as $item)
                        
                            <tr>
                                <td>{{ ($history->total()-$loop->index)-(($history->currentpage()-1) * $history->perpage() ) }}</td>
                                <td>
                                {{ $item->game_type }}
                                </td>
                                <td>
                                    {{ $item->user->username }}
                                </td>
                                <td>{{ $item->rate }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format("d M Y h:i A") }}</td>
                            </tr>
						@endforeach
						
					</tbody>
					
				</table>
				{{$history->links()}}
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
			</div>
			<!-- /.card-footer -->
		</div>

		</div>
	</div>
	</div>
@endsection