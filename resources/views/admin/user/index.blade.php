@extends('layouts.fixed')
@section('title','ALl Users')
@section('style')
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
	<section>
		<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Users</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Users</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="row">
			<div class="col card">
				<div class="card-body">
				<form action="{{ route('user.index') }}" method="get">
					<div class="row">
						<div class="col">
							<label for="">Club Name</label>
							<select name="club_id" class="form-control" id="club_id">
								<option value="">Select Club</option>
								@foreach($clubs as $club)
									<option value="{{ $club->id }}">{{ $club->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col">
							<label for="">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username">
						</div>
						<div class="col">
							<label for="">Credit Greater Than</label>
							<input type="text" class="form-control" name="credit" placeholder="Credit more than">
						</div>
						<div class="col">
							<label for="">Joined After</label>
							<input type="date" class="form-control" name="created_at" placeholder="Username">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col text-center">
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-search"></i></button>
							<a href="{{ route('user.index') }}" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col card card-primary card-outline">
				<div class="card-header">
					<div class="card-tools">
						@role('Admin')
							Current Total Credit: {{ $totalCredit }}
						@endrole
					</div>
				</div>
				<div class="card-body">
					<table class="table table-responsive table-striped">
						@php
							$isAdmin = auth()->user()->hasRole('Admin');
						@endphp
						<thead>
							<tr class="w100">
								<th>ID</th>
								<th>Club</th>
								<th>Username</th>
								<th>Credit</th>
								<th>Bonus Point</th>
								@if ($isAdmin)
									<th>Roles</th>
								@endif
								<th>Joined</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ empty($user->club) ? 'NA':$user->club->name}}</td>
									<td>{{ $user->username }}</td>
									<td>
										@php
											$total = empty($user->credit) ? 0 : $user->credit->amount;
										@endphp

										{{ $total }}
									</td>
									<td> {{ $user->credit->bonus_point ?? 0 }}</td>
									@if ($isAdmin)
										<td>
											@if(count($user->roles) > 0)
												@foreach($user->roles as $role)
												<span class="badge badge-secondary">{{ $role->name }}</span>
												@endforeach
											@else
											<span class="badge badge-default">NO Role defined</span>
											@endif
										</td>
									@endif
									<td>{{ Carbon\Carbon::parse($user->created_at)->format('d M Y h:i A') }}</td>
									<td>
										<a href="{{ route('user.show',$user->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
										<a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
										@role('admin')
										<form id="delete-{{$user->id}}" action="{{ route('user.destroy',$user->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger" type="button" onclick="if(confirm('Are You Sure?')){
												$('#delete-'+'{{ $user->id }}').submit();}"><i class="fa fa-trash"></i></button>
										</form>
										@endrole
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">{{ $users->links() }}</td>
								<td colspan="3"></td>
							</tr>
					</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	</section>
@endsection
