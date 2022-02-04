@extends('layouts.fixed')
@section('title','Add Banner')
@section('style')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')

<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Banner Addition Section</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-2">
		<div class="row">
			<div class="col-md-8">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">List of All Banner Image</h3>
						<div class="card-tools">
							<!-- Buttons, labels, and many other things can be placed here! -->
							<!-- Here is a label for example -->
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
								  <th scope="col">Id</th>
							      <th scope="col">Image</th>
							      <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($banner as $item)
									<tr>							
									<td>{{ $item->id }}</td>
									<td><img src="{{ asset('uploads/banner/'.$item->image) }}" alt="$item->image" width="100px" height="60px"></td>
									<td>
										<a href="{{ route('banner.status',$item->id) }}" class="btn btn-sm {{ $item->isEnabled ? 'btn-warning' : 'btn-success' }}">{{ $item->isEnabled ? 'Disable' : 'Publish' }}</a>
										<a href="{{ route('banner.delete',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
									</td>
									</tr>
								@endforeach
							    
							
							</tbody>
						</table>
					</div>

				</div>
			</div>
				<div class="col">
				<div class="card card-outline card-warning">
					<div class="card-header">
						<h3>New Banner Add Option</h3>
					</div>
					<div class="card-body">
						@if(Session::has('success'))
									<div class="alert alert-success">{{Session::get('success')}}</div>
									@endif
						<form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
										{{csrf_field()}}
										<div class="form-group">
											<label for="">Select Type</label>
											<select name="type" id="type" class="">
												<option value="">Select Banner Type</option>
												<option value="app-banner">App Banner</option>
												<option value="game-image">Game Image</option>
												<option value="banner">Banner</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Upload Banner Image</label>
											<input type="file" name="image" id="fileToUpload">
										</div>

							<div class="form-group">
								<button class="btn btn-outline-success">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
