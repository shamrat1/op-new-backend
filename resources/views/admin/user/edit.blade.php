@extends('layouts.fixed')
@section('title','Edit Information')
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
		<div class="col card card-outline card-warning">
			<div class="card-header">
				<div class="card-title">
					{{ $user->name."'s Profile"}}
				</div>
				<div class="card-tools">
					<button class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col bg-dark text-center rounded mx-5 pb-2">
						<h3>Bet History</h3>
						<div class="row">
							<div class="col">
								Total Bet Placed: {{ $totalOnBet }} TK 
							</div>
							<div class="col">
								Total Wins : {{ $totalBetWin }} TK
							</div>
						</div>
					</div>
				</div>
				@role('Admin')
				<div class="row mt-5">
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
						<form action="{{ route('user.role',$user->id) }}" method="post" class="form">
							@csrf
							<div class="form-group">
								<label>Give New Role</label>
								<select class="select2 form-control" name="roles[]" multiple="multiple">
									@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Save</button>
							</div>
						</form>
					</div>
				</div>
				@endrole
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col text-left text-muted">
						Joined {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
					</div>
					<div class="col text-right text-muted">
						@if($user->created_at == $user->updated_at)
						NO Update yet
						@else
						Updated {{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
						@endif
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-6 card card-outline card-danger">
			<div class="card-header">
				<div class="card-title">
					General Info
				</div>
			</div>
			<div class="card-body">
				 @if ($errors->all())
                <div class="alert alert-danger text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
				@endif
				
				<form class="form" action="{{ route('user.update',$user->id) }}" method="POST">
					@method('PUT')
				@csrf
				<div class="row">
					<div class="col form-group">
						<label for="name">Name</label>
						<input type="text" name="name" value="{{ $user->name }}" class="form-control">
					</div>
					<div class="col form-group">
						<label for="username">Username</label>
						<input type="text" name="username" value="{{ $user->username }}" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col form-group">
						<label for="email">Email</label>
						<input type="email" name="email" value="{{ $user->email }}" class="form-control">
					</div>
					<div class="col form-group">
						<label for="">Ban Until</label>
						<input type="date" name="banned_until" value="{{ $user->banned_until != null ? Carbon\Carbon::parse($user->banned_until)->format('Y-m-d') : ''}}" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="col form-group">
						@php
							$sponser = '';
							if($user->sponser_email){
								$obj = App\User::where('email',$user->sponser_email)->first();
								$sponser = $obj != null ? $obj->username : '';
							}
						@endphp
						<label for="sponser">Sponser</label>
						<input type="text" name="sponser" value="{{ $sponser }}" class="form-control" readonly>
					</div>
					<div class="col form-group">
						<label for="club">Club</label>
						<select name="club_id" id="club" class="form-control">
							<option value="">Select CLub</option>
							@foreach($clubs as $club)
								<option value="{{ $club->id }}"
									@if ($user->club_id == $club->id)
										selected
									@endif
									>{{ $club->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col form-group">
						<label for="country">Country</label>
						<input type="text" name="country" value="{{ $user->country }}" class="form-control">
					</div>
					<div class="col form-group">
						<label for="mobile">Mobile</label>
							<input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col form-group">
					<input type="checkbox" id="scales" name="is_allowed_transaction" @if($user->is_allowed_transaction) checked @endif>
					<label for="scales">&nbsp; Allow Transaction</label>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col text-right">
						<button type="submit" class="btn btn-warning">Update</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="col-4 offset-1">
			<div class="card card-outline card-danger">
				<form action="{{ route('user.password',$user->id) }}" class="form" method="POST">
					<div class="card-header">
						<div class="card-title">
							Change Password
						</div>
					</div>
					<div class="card-body">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class='form-control {{ $errors->has('password') ? 'is-invalid' : ''}}' required>
								@error('password')
									<span class="invalid-feedback text-danger" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Confirm Password</label>
								<input type="password" name="password_confirmation" class='form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}' required>
								@error('password_confirmation')
									<span class="invalid-feedback text-danger" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-danger">Change Password</button>
					</div>
				</form>
			</div>
			<div class="card  card-outline card-danger">
				<form action="{{ route('credit.update',$user->id) }}" method="POST">
					<div class="card-header">
						<div class="card-title">
							User Credit
						</div>
					</div>
					<div class="card-body">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="">Credit</label>
							<input type="text" value="{{ $user->credit != null ? $user->credit->amount : 0 }}" name="credit" class='form-control {{ $errors->has('credit') ? 'is-invalid' : ''}}' required>
							@error('credit')
								<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" onclick="confirm('Are you sure to update credit ?')" class="btn btn-danger">Update</button>
					</div>
				</form>
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