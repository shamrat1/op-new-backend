@extends('layouts.fixed')
@section('title','Create New Match')
@section('style')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">new match</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('match.index') }}">Matches</a></li>
					<li class="breadcrumb-item active">create</li>

				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<div class="ml-2">
	<div class="row">
		<div class="col-md-8">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<div class="card-title">
						Enter New Match Details
					</div>

				</div>
				<div class="card-body">
					<form action="{{ route('match.store') }}" method="post" id="match_form">
						@csrf
						<div class="row">
							<div class="col form-group">
								<label >Team 1</label>
								<input type="text" name="team1" class="form-control" placeholder="Ban">
							</div>
							<div class="col form-group">
								<label >Team 2</label>
								<input name="team2" type="text" class="form-control" placeholder="Ind">
							</div>	
						</div>
						<div class="row">
							<div class="col form-group">
								<label>Tournament</label><br>
								<select name="tournament_id" class="form-control select2" id="exampleFormControlSelect1">
									@foreach($tournaments as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col form-group">
								<label>Unique id</label>
								<input type="text" name="unique_id" id="unique_id" class="form-control">
								<small aria-describy="unique_id" class="text-muted">Get unique id by clicking get current matches button</small>
							</div>
						</div>
						<div class="row">
							<div class="col form-group">
								<label >Match Time</label>
								<input type="datetime-local" name="match_time" class="date time form-control ">
							</div>
							<div class="col form-group">
								<label >Name</label>
								<input name="name" type="text" class="form-control">
							</div>

						</div>
						<div class="row">
							<div class="col form-group">
								<label for="status">Select Status</label>
								<select name="status" id="status" class="custom-select">
									<option value="">Select status</option>
									<option value="live">Live</option>
									<option value="upcoming">Upcoming</option>
									<option value="draft">draft</option>
									<option value="unpublished">Unpublished</option>
								</select>
							</div>
							<div class="col form-group">
								<label for="type">Sports Type</label>
								<select name="sport_type" id="type" class="custom-select">
									<option value="">Select Sport Type</option>
									<option value="cricket">cricket</option>
									<option value="football">football</option>
									<option value="basketball">basketball</option>
									<option value="volleyball">volleyball</option>
									<option value="tennis">tennis</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="">Tournament Match No</label>
									<input type="text" placeholder="Ex: 2nd Match" name="tournament_match_no" class="form-control" id="">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Auto Option Selection</label><br>
									<select class="select2" name="auto_option" id="auto_option">
										<option value="0">Select Auto Option</option>
										@forelse ($autoOptions as $option)
											<option value="{{ $option->id }}">{{ $option->name }}</option>
										@empty
											<option>No Options Added</option>
										@endforelse
									</select>
								</div>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col text-right">
								<button type="button" onclick="document.getElementById('match_form').reset()" class="btn btn-default">Clear</button>
								<button type="submit" class="btn btn-outline-success">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card card-outline card-danger">
				<div class="card-header">
					<div class="card-title">
						<button class="btn btn-outline-success" id="getMatches">Get Current Matches</button>
					</div>
					<div class="card-tools">
						
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>id</th>
								<th>team1</th>
								<th>team2</th>
								<th>datetime</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="table-body">
							<tr>
								<td class="text-muted text-center" colspan="5">Click get current matches to get list of all current matches.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script type="text/javascript">

	$(document).on("click","#getMatches",function (e){
		$.ajax({
				url: 'https://cricapi.com/api/matches?apikey=kWUGccXKmdaIHE4wlHIk30lZolv1', // add "k" as the very first word in key
				method: 'get',
				success: function(data) {
					var tableData = "";
					if (data.matches != null){
						// success toast
							toastr.success("data fetched successfully.")
						// end of success toast
						$.each(data.matches,function(key,value){
							console.log(value)
							tableData += "<tr id='match_row-'"+value['unique_id']+">"
							tableData += "<td>"+value["unique_id"]+"</td>"
							tableData += "<td>"+value["team-1"]+"</td>"
							tableData += "<td>"+value["team-2"]+"</td>"
							tableData += "<td>"+value["dateTimeGMT"]+"</td>"
							tableData += "<td><button id='addMatchBtn' class='btn btn-sm btn-success' data-id="+value["unique_id"]+" data-team-1="+value["team-1"]+" data-team-2="+value["team-2"]+" data-dateTime="+value["dateTimeGMT"]+">Add</button></td>"
							tableData += "</tr>"
						});
					}else{
						tableData += "<tr>"
						tableData += "<td colspan="+5+" class='text-center text-danger'>Error Fetching Data. Contact Admin</td>"
						tableData += "</tr>"
					}
					$("#table-body").html(tableData);
					// console.log(tableData)
				},
				error: function(data){
					console.log(data)
				}
			});
	});

	$(document).on('click','#addMatchBtn',function (e) {
		console.log('clicked')
		let data = $(this).data();
		console.log(data);

		$('#match_form').trigger('reset');
		$("input[name=team1]").val($(this).data('team-1'));
		$("input[name=team2]").val($(this).data('team-2'));
		$("select[name=status]").val("draft");
		$("input[name=unique_id]").val($(this).data('id'));
		$("input[name=match_time]").val(moment($(this).data('datetime')).format('YYYY-MM-DDThh:mm:ss'));
	});

	$(document).ready(function (){
		let date = "2020-07-24T10:00:00.000Z"
		console.log(moment(date).format('YYYY-MM-DDThh:mm:ss'))
	});
</script>
@endsection