@extends('layouts.fixed')
@section('title','Import Matches')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All matches</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">matches</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-4">
		<div class="row">
		<div class="col">
			<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Import Matches</h3>
				<div class="card-tools">
					<!-- Buttons, labels, and many other things can be placed here! -->
					<!-- Here is a label for example -->
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-responsive table-hover">
					<thead>
						<tr>
							<td>#</td>
							<td>teams</td>
							<td>match time</td>
							<td>Tournament</td>
							<td>Status</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody id="matches_tbody">
					</tbody>
				</table>
                <div class="row">
                    <div class="col-6">
                    <button id="lastPageBtn" class="btn btn-block btn-success">Previous</button>
                    </div>
                    <div class="col-6">
                        <button id="nextPageBtn" class="btn btn-block btn-success">NEXT</button>
                    </div>
                </div>
			</div>
		</div>

		</div>
	</div>
	</div>
@endsection

@section('script')

<script>
    $(document).ready(function(){
        var root = 'https://worldbet365.co.uk/api/';
        var rootUrl = root+'someBet/matchLatest';
        var request;
        var data;
        var nextPage;
        var previousPage;
        var table = $('#matches_tbody')
        var nextBtn = $('#nextPageBtn');
        var lastBtn = $('#lastPageBtn');

        getData(rootUrl);

        $(document).on('click','#nextPageBtn',nextPageData);
        $(document).on('click','#lastPageBtn',lastPageData);
        // nextBtn.onClick(() => nextPageData());
        // lastBtn.onClick(() => lastPageData());
        
        

        function getData(url){
            request = $.getJSON(url);
            request.done(function(response){
            data = response.data
            nextPage = response.data.next_page_url;
            previousPage = response.data.prev_page_url;
            var html;
            $.each(data.data,function(key,val){
                var row = `
                <tr>
                    <td>`+val.id+`</td>
                    <td>`+val.team1+" V "+val.team2+`</td>
                    <td>`+val.match_time+`</td>
                    <td>`+val.tournament.name+`</td>
                    <td>`+val.status+`</td>
                    <td>
                        <a href="{{ url('/') }}/admin/match/import/`+val.id+`" class="btn btn-sm btn-warning"><i class="fas fa-file-import"></i> Import</a>
                    </td>
                </tr>
                `;
                html += row;
            });
            table.empty();
            table.html(html);
        });
        }

        function nextPageData(){
            if(nextPage != null){
                getData(nextPage);
            }
        }

        function lastPageData(){
            if(previousPage != null){
                getData(previousPage);
            }
        }
    });
</script>

@endsection