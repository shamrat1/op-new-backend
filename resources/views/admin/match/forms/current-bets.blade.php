<div class="row m-2 pt-3">
	<div class="col">
		<form action="{{ route('details.store') }}" method="post">
			@csrf
			<input type="text" name="match_id" value="{{ $match->id }}" hidden="">
			<div class="row">
				<div class="col-md-6">
					<div class="col form-group">
						<select name="bet_option_id" class="select2" id="bet_option_id">
							@foreach($betOptions as $option)
							<option value="{{ $option->id }}">{{ $option->name }}</option>
							@endforeach
						</select>
						<br>
						<small aria-describy="bet_option_id">select bet option</small>
					</div>
				</div>
				
				<div class="col">
					<button class="btn btn-success" type="submit">Add Option</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row col-12">
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
    @endif
</div>
<div class="row">
	@foreach($betOptionsSelected as $item)
	
	<div class="col-sm-4">
		<div class="card elevation-2">
			<div class="card-body">
				<h3>{{ $item->betOption->name }}</h3>
				<div class="text-right">
					<button class="btn btn-sm btn-success" id="append" data-id="{{ $item->id }}"><i class="fa fa-plus"></i></button>
				</div>
				<form class="form" action="{{ route('match.bets') }}" method="post">
					@csrf
					<input type="number" name="bets_for_matches_id" value="{{ $item->id }}" hidden>
					<div id="form-{{$item->id}}">
						@if(count($item->betDetails) < 1)
					<div class="row">
						<div class="col form-group">
							<label>Name</label>
							<input type="text" name="name[]" class="form-control">
						</div>
						<div class="col form-group">
							<label>Value</label>
							<input type="text" name="value[]" class="form-control">
						</div>
					</div>
						@else
							@foreach($item->betDetails as $details)
								<input type="text" name="details_id[]" value="{{ $details->id }}" hidden>
								<div class="row">
									<div class="col form-group">
										<label>Name</label>
										<input type="text" name="name[]" class="form-control" value="{{ $details->name }}">
									</div>
									<div class="col form-group">
										<label>Value</label>
										<input type="text" name="value[]" class="form-control" value="{{ $details->value }}">
									</div>
									
								</div>
								<hr>
							@endforeach
						@endif
						
					</div>
					
					<div class="row">
						<div class="col">
							<div class="text-right">
								<button class="btn btn-outline-success" type="submit">Set</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	@endforeach
</div>
