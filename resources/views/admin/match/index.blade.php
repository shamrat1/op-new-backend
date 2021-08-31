@extends('layouts.fixed')
@section('title','All Matches')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All matches</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">matches</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="row">
			<div class="col-12 card rounded shadow p-2">
				<div class="row text-center">
					<div class="col-sm-3 col-md-3 col-lg-3">
						<h5>Tournament</h5>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<h5>Team Name</h5>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						Match Day
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						Status
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-3 col-md-3 col-lg-3">
						<select name="tournament" class="form-select" id="">
							<option value="" disabled>Select Tournament</option>
						</select>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<input type="text" name="name" class="form-control">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<input type="date" name="match_time" class="form-control">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<select name="status" id="" class="form-control">
							<option value="" disabled>Select Status</option>
							<option value="draft" >Drafted</option>
							<option value="upcoming" >Upcoming</option>
							<option value="live" >live</option>
						</select>
					</div>
				</div>
				<div class="row justify-content-center mt-2">
					<div class="col-sm-3 col-md-3 col-lg-3 text-right">
						<button class="btn btn-sm btn-info"><i class="fa fa-list"></i></button>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<button class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
					</div>
					
				</div>
			</div>
		</div>
		<div class="row">
		<div class="col">
			<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">List of All Matches</h3>
				<div class="card-tools">
					<!-- Buttons, labels, and many other things can be placed here! -->
					<!-- Here is a label for example -->
					<a class="btn btn-sm btn-success mr-2" href="{{ route('match.create') }}"><i class="fa fa-plus"></i>New Match</a> 
					<a class="btn btn-sm btn-warning" href="{{ route('match.import.index') }}"><i class="fas fa-file-import"></i> Import Match</a>
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<td>#</td>
							<td>teams</td>
							<td>match time</td>
							<td>Tournament</td>
							<td>Total Bids</td>
							<td>User Wins</td>
							<td>User Lost</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						@foreach($matches as $item)
						@php
							$sum = $item->bids->sum('amount');
							$grouped = $item->bids->groupBy(function($bid){
								if($bid->isWin){
									return "wins";
								}else{
									return "loses";
								}
							});
						@endphp
						<tr>
							<td>{{ ($matches->total()-$loop->index)-(($matches->currentpage()-1) * $matches->perpage() ) }}</td>
							<td>{{ $item->team1 }} vs {{ $item->team2 }}</td>
							<td>{{ Carbon\Carbon::parse($item->match_time)->format('d M Y h:i A') }}</td>
							<td>{{ $item->tournament->name }}</td>
							<td><span class="badge badge-info">{{ $item->bids_count }}</span> <span class="badge badge-success">{{ $sum }}</span></td>
							<td>{{ isset($grouped["wins"]) ? $grouped["wins"]->sum("amount") : "0" }}</td>
							<td>{{ isset($grouped["loses"]) ? $grouped["loses"]->sum("amount") : "0" }}</td>
							<td>
								<a class="btn btn-sm btn-primary" href="{{ route('match.show',$item->id) }}">
									<i class="fa fa-eye"></i>
								</a>
								<a class="btn btn-sm btn-warning" href="{{ route('match.show',$item->id) }}">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-sm btn-danger"><i"><i class="fa fa-trash"></i></button>

							</td>
						</tr>
						@endforeach
						{{-- @foreach($tournaments as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->type }}</td>
								<td>
									<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
									<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						@endforeach --}}
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<div class="row">
				<div class="col text-left">
						{{ $matches->links() }}
					</div>
					<div class="col">
						Matches: {{ $matches->total() }}
					</div>
					
				</div>
			</div>
			<!-- /.card-footer -->
		</div>

		</div>
	</div>
	</div>
@endsection