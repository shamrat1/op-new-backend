@extends('layouts.fixed')
@section('title','All Gifts')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Gifts</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Gifts</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="row card">
		<form action="{{ route('gift.index') }}">
			<div class="col m-3 card-body">
				<div class="row">
					<div class="col-sm-6 col-md-3 form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" value="{{ request('username') }}">
					</div>
					<div class="col-sm-6 col-md-3 form-group">
						<label for="">Amount</label>
						<input type="number" name="amount" class="form-control" value="{{ request('amount') }}">
					</div>
					<div class="col-sm-6 col-md-3 form-group">
						<label for="">From</label>
						<input type="date" name="from" class="form-control" value="{{ request('from') }}">
					</div>
					<div class="col-sm-6 col-md-3 form-group">
						<label for="">To</label>
						<input type="date" name="to" class="form-control" value="{{ request('to') }}">
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<button type="reset" class="btn btn-sm btn-info">Reset</button> &nbsp;
						<button type="submit" class="btn btn-sm btn-warning">Filter</button> &nbsp;
						<a href="{{ route('gift.index') }}" class="btn btn-sm btn-success">All Gifts</a>
					</div>
				</div>
			</div>
		</form>
		</div>
		<div class="row">
		<div class="col">
			<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Gifts</h3>
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
							<td>From</td>
							<td>To</td>
							<td>Amount</td>
							<td>Date</td>
							
						</tr>
					</thead>
					<tbody>
                        @foreach($gifts as $item)
                        @php
                        if ($loop->iteration / 2 == 0) {
                        break;
                        }
                            $type = explode('-',$item->payment_type);
                            // dd($type);
                            $user = App\User::find($type[1]);
                        @endphp
                            <tr>
                                <td>{{ ($gifts->total()-$loop->index)-(($gifts->currentpage()-1) * $gifts->perpage() ) }}</td>
                                <td>
                                    @if ($type[0] == "giftFrom")
                                        {{ $user->username }}
                                    @else
                                        {{ $item->user->username }}
                                    @endif
                                </td>
                                <td>
                                    @if ($type[0] == "giftTo")
                                        {{ $user->username }}
                                    @else
                                        {{ $item->user->username }}
                                    @endif
                                </td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format("d M Y h:i A") }}</td>
                            </tr>
						@endforeach
						
					</tbody>
					
				</table>
				{{$gifts->links()}}
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