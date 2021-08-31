@extends('layouts.fixed')
@section('title','Edit withdraw')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">withdraw request</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('withdraw.index') }}">Withdraws</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="col-6 card card-primary card-outline">
			
			<div class="card-header">
			withdraw request of <span class="text-primary">{{ $data->user->name }}</span><br>
			{{-- <small class="text-muted">{{ $data->user->email }}</small> --}}
			</div>
			<div class="card-body">
				<div class="alert alert-warning">
					<h5>fill this form after sending the money</h5>
				</div>

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
            	@endif
			<form action="{{ route('withdraw.update',$data->id) }}" method="POST">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="sentTO">Customer Number</label>
								<h4 class="form-control">{{ $data->payment_type." ".$data->mobile }}</h4>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="from">From</label>
								<input class="form-control" type="text" name="backend_number" id="from">
								<small aria-describedby="from" class="text-muted">Please give the number that'll be used to send money. </small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="amount">Amount</label>
							<input type="number" class="form-control" name="amount" value="{{ $data->amount }}" id="amount">
							<small class="text-danger">Do not change it unless very much required</small>
						</div>
						<div class="col">
							<label for="txn_id">txn id</label>
							<input type="text" class="form-control" name="txn_id" id="txn_id">
							<small aria-describedby="txn_id" class="text-muted">Unique Transaction id</small>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="amount">Credit</label>
							@php
								$total = $data->user->credit->amount;
							@endphp
							<h4 class="text-danger">{{ $total }}</h4>
						</div>
					<input type="hidden" name="user_id" value="{{ $data->user->id }}">
						<div class="col">
							<label for="status">status</label>
							<select name="status" id="status" class="form-control">
								<option value="pending">pending</option>
								<option value="approved" selected>approved</option>
								<option value="canceled">canceled</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="text-right">
						<button class="btn btn-success" type="submit">save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection