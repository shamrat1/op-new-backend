@extends('layouts.fixed')
@section('title','List of Auto Options')

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
			<div class="col-sm-12 col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Link Auto Options</h3>
						<div class="card-tools">
							<!-- Buttons, labels, and many other things can be placed here! -->
							<!-- Here is a label for example -->
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form action="{{ route('auto-option.link.store', $option->id) }}" method="POST">
                            @csrf
                            <label for="">{{ $option->name }}</label>

                            <div class="form-group">
                                <label for="">Main Option</label> <br>
                                <select name="main_options[]" class="select2" multiple id="input-tags">
                                    <option value="0">Select Options</option>
                                    @foreach ($mainOptions as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
							<div class="form-group">
								<button class="btn btn-sm btn-warning text-right">Update</button>
							</div>
                        </form>
					</div>

				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Current Linked Options</h3>
						<div class="card-tools">
							<!-- Buttons, labels, and many other things can be placed here! -->
							<!-- Here is a label for example -->
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<h4>{{$option->name}}</h4>
						<span>|</span><br>
						@forelse ($option->autoMainOption as $main)
							<span class="text-info">|------><a href="{{ route("auto-option.link.secondary.show",$main->id) }}">{{ $main->name }}</a></span><br>
							@forelse ($main->autoOptionDetail as $detail)
								<span class="text-success">|------------>{{ $detail->name }}</span><br>
							@empty
								<span class="text-warning">|------------>No Details Option Linked</span><br>

							@endforelse
						@empty
							<h3>No Options Linked</h3>
						@endforelse
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection

@section("script")
    <script>
        var values = {{ $option->autoMainOption->pluck('id') }};
        $("#input-tags").select2();
        $("#input-tags").val(values);
        $("#input-tags").trigger('change');

        // $(document).ready(function(){
            // $("#input-tags").selectize({
            // delimiter: ",",
            // persist: false,
            // create: function (input) {
            //     return {
            //     value: input,
            //     text: input,
            //     };
            // },
            // });
        // });

    </script>
@endsection
