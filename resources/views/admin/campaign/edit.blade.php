@extends('layouts.fixed')
@section('title','All Campaigns')
@section('plugin-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" />
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Campaigns</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('campaign.index') }}">Campaigns</a></li>
                        <li class="breadcrumb-item active">Edit {{ $campaign->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="ml-4">
        <div class="row">
            <div class="card col card-primary card-outline">
            <div class="card-header">
                <div class="card-title">
                    Edit Campaign
                </div><!-- /.card-title -->
                <div class="card-tools">
                    {{-- <a href="{{ route('campaign.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> New Campaign</a>     --}}
                </div><!-- /.card-tools -->    
            </div><!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('campaign.update',$campaign->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="name">Campaign Title</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $campaign->name }}" name="name" id="name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="effective_on">Effective On</label>
                            <input type="text" class="form-control @error('effective_on') is-invalid @enderror" value="{{ $campaign->effective_on }}" name="effective_on" id="effective_on">
                            @error('effective_on') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 form-group">
                            <label for="min_amount">Min Amount</label>
                            <input type="text" class="form-control @error('min_amount') is-invalid @enderror" value="{{ $campaign->min_amount }}" name="min_amount" id="min_amount">
                            @error('min_amount') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 form-group">
                            <label for="max_amount">Max Amount</label>
                            <input type="text" class="form-control @error('max_amount') is-invalid @enderror" value="{{ $campaign->max_amount }}" name="max_amount" id="max_amount">
                            @error('max_amount') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="draft" @if ($campaign->status == "draft") selected @endif>Draft</option>
                                <option value="live" @if ($campaign->status == "live") selected @endif>Live</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="reward_amount">Reward Amount</label>
                            <input type="text" class="form-control @error('max_amount') is-invalid @enderror" value="{{ $campaign->reward_amount }}" name="reward_amount" id="reward_amount">
                            @error('reward_amount') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="amount_type">Reward Amount Type</label>
                            <select name="amount_type" id="amount_type" class="form-control @error('amount_type') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="percent" @if ($campaign->amount_type == "percent") selected @endif>Percent (%)</option>
                                <option value="fixed" @if ($campaign->amount_type == "fixed") selected @endif>Fixed</option>
                            </select>
                            @error('amount_type') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control @error('start_date') is-invalid @enderror" value="{{ $campaign->start_date }}" name="start_date" id="start_date">
                            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="end_date">End Date</label>
                            <input type="datetime" class="form-control @error('end_date') is-invalid @enderror" value="{{ $campaign->end_date }}" name="end_date" id="end_date">
                            @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <button class="btn btn-block btn-success">Save</button>

                </form>
            </div><!-- /.card-body -->
        </div><!-- /.card col-8 -->

        </div><!-- /.row -->

    </div>

@endsection

@section('plugin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('script')
    <script>
        $("#start_date").datetimepicker();
        $("#end_date").datetimepicker();
    </script>
@endsection
