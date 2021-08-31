@extends('layouts.fixed')
@section('title','All Tournaments')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">All Tournaments</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Tournaments</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<div class="ml-3">
	<div class="row">
		<div class="col">
			<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">List of All Tournaments</h3>
				<div class="card-tools">
					<!-- Buttons, labels, and many other things can be placed here! -->
					<!-- Here is a label for example -->
					<a href="#" data-toggle="modal" data-target="#addTournamentModal"><i class="fa fa-plus"></i></a>
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered col-sm">
					<thead>
						<tr>
							<td>#</td>
							<td>name</td>
							<td>description</td>
							<td>type</td>
							<td>Created</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						@foreach($tournaments as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->type }}</td>
								<td>{{ Carbon\Carbon::parse($item->type)->format('d M Y h:i A') }}</td>
								<td>
									<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
									<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<div class="row">
					<div class="col">
						Tournaments: {{ $tournaments->total() }}
					</div>
					<div class="col text-right">
						{{ $tournaments->links() }}
					</div>
				</div>
			</div>
			<!-- /.card-footer -->
		</div>

		</div>
	</div>
</div>


<!-- Add Tournament Modal -->
<div class="modal fade" id="addTournamentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Tournament</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tournaments.store') }}" method="post">
        	@csrf
        	<div class="form-group">
        		<label for="exampleInputEmail1">Name</label>
        		<input type="text" name="name" class="form-control" id="exampleInputEmail1">
        	</div>
        	<div class="form-group">
        		<label for="exampleInputPassword1">Description</label>
        		<textarea class="form-control" name="description" rows="2" aria-describe="description"></textarea>
        		<small id="description">A brief description about the tournament.</small>
        	</div>
        	<hr>
        	<div class="text-right">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary">Save changes</button>
        	</div>
        </form>
      </div>
      
    </div>
  </div>
</div>

@endsection

