@extends('layouts.fixed')
@section('title',strtoupper($match->team1)." V ".strtoupper($match->team2)." | Match Details")

@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">{{ strtoupper($match->team1)." V ".strtoupper($match->team2) }}</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('match.index') }}">Matches</a></li>
						<li class="breadcrumb-item active">{{ strtoupper($match->team1)." V ".strtoupper($match->team2) }} Details</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-2">
		<div class="card card-outline card-primary">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h3>tournament</h3>
					</div>
					<div class="col">
					<h5 class="text-primary">{{ $match->tournament->name }}</h5>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<h3>Match</h3>
					</div>
					<div class="col">
						<h5 class="text-primary">{{ $match->team1." V ".$match->team2 }}</h5>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<h3>More Info</h3>
					</div>
					<div class="col">
						<p class="text-primary">Start time: {{ $match->match_time }}</p>
						<form action="{{ route('match.score.update',$match->id) }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-sm-2">
									<h3>Score:</h3>
								</div>
								<div class="col-sm-7">
									<input type="text" name="score" value="{{ $match->score }}" class="form-control">
								</div>
								<div class="col">
									<button class="btn btn-warning">Update</button>
								</div>
							</div>
							
						</form>
						<div class="row">
							<a href="{{ route('match.score.off',$match->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">Turn off All Score</a>
							<a href="{{ route('match.score.on',$match->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-success btn-sm">Turn On All Score</a>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="current-bet-tab" data-toggle="tab" href="#current-bet" role="tab" aria-controls="current-bet" aria-selected="true">current-bet</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="action-tab" data-toggle="tab" href="#action" role="tab" aria-controls="action" aria-selected="false">Bet action</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="bids-tab" data-toggle="tab" href="#bids" role="tab" aria-controls="bids" aria-selected="false">Bids</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="action-tab" data-toggle="tab" href="#all-bets" role="tab" aria-controls="all-bets" aria-selected="false">all bets</a>
						</li>
					</ul>

				</div>
				<div class="row">
					<div class="tab-content col-12" id="myTabContent">
						<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
							@include('admin.match.forms.details')
						</div>
						<div class="tab-pane fade" id="current-bet" role="tabpanel" aria-labelledby="current-bet-tab">
							@include('admin.match.forms.current-bets')
						</div>
						<div class="tab-pane fade" id="action" role="tabpanel" aria-labelledby="action-tab">
							@include('admin.match.forms.bet-actions')
						</div>
						<div class="tab-pane fade" id="bids" role="tabpanel" aria-labelledby="bids-tab">
							@include('admin.match.forms.bids')
						</div>
						<div class="tab-pane fade" id="all-bets" role="tabpanel" aria-labelledby="all-bets-tab">All bets</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

@endsection
@section('script')
	@include('admin.match.forms.script')
@endsection
