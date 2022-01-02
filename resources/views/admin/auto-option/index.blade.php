@extends('layouts.fixed')
@section('title','List of Auto Options')
@section('style')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')

<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Auto Option</h1>
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
			<div class="col">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Add New Options</h3>
						<div class="card-tools">
							<!-- Buttons, labels, and many other things can be placed here! -->
							<!-- Here is a label for example -->
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
                            <div class="col-sm-12 col-md-3 border-right m-2">
                                <form action="{{ route("auto-option.main") }}" method="POST">
                                    <h3>Add Category</h3>
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-4 border-right m-2">
                                <form action="{{ route("auto-option.secondary") }}" method="POST">
                                    <h3>Add Main Option</h3>
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class=" text-center">
                                        <button class=" btn btn-sm btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <form action="{{ route("auto-option.third") }}" method="POST">
                                    <h3>Add Main Option Details</h3>
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Value</label>
                                        <input type="text" name="value" class="form-control" placeholder="">
                                    </div>
                                    <div class="text-center">
                                        <button class=" btn btn-sm btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">List of Auto Options</h3>
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
							      <th scope="col">Name</th>
							      <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($option as $item)
									<tr>							
									<td>{{ $item->id }}</td>
									<td>{{ $item->name }}</td>
									<td>
										<a href="{{ route("auto-option.link.show", $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
										{{-- <a href="{{ route('banner.status',$item->id) }}" class="btn btn-sm {{ $item->isEnabled ? 'btn-warning' : 'btn-success' }}">{{ $item->isEnabled ? 'Disable' : 'Publish' }}</a>
										<a href="{{ route('banner.delete',$item->id) }}" class="btn btn-sm btn-danger">Delete</a> --}}
									</td>
									</tr>
								@endforeach
							    
							
							</tbody>
						</table>
						{{ $option->links() }}
					</div>

				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">List of Auto Main Options</h3>
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
							      <th scope="col">Name</th>
							      <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($mainOptions as $item)
									<tr>							
									<td>{{ $item->id }}</td>
									<td>{{ $item->name }}</td>
									<td>
										<a href="{{ route("auto-option.link.secondary.show", $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									</td>
									</tr>
								@endforeach
							    
							
							</tbody>
						</table>
						{{ $mainOptions->links() }}
					</div>

				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">List of Auto Option Details</h3>
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
							      <th scope="col">Name</th>
							      <th scope="col">Value</th>
							      <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($optionDetails as $item)
									<tr>							
									<td>{{ $item->id }}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->value }}</td>
									<td>
										{{-- <a href="{{ route('banner.status',$item->id) }}" class="btn btn-sm {{ $item->isEnabled ? 'btn-warning' : 'btn-success' }}">{{ $item->isEnabled ? 'Disable' : 'Publish' }}</a>
										<a href="{{ route('banner.delete',$item->id) }}" class="btn btn-sm btn-danger">Delete</a> --}}
									</td>
									</tr>
								@endforeach
							    
							
							</tbody>
						</table>
						{{ $optionDetails->links() }}
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection
