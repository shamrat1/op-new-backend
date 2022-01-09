@extends('layouts.fixed')
@section('title','All Campaigns')
@section('plugin-css')
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
                        <li class="breadcrumb-item active">Campaigns</li>
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
                    Campaigns
                </div><!-- /.card-title -->
                <div class="card-tools">
                    <a href="{{ route('campaign.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> New Campaign</a>    
                </div><!-- /.card-tools -->    
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Effective On</th>
                            <th>Required Amount</th>
                            <th>Reward</th>
                            <th>Validity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($campaigns as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->effective_on }}</td>
                                <td>{{ $item->min_amount }} => USER AMOUNT <= {{ $item->max_amount }}</td>
                                <td>
                                    <span class="text-info">
                                        {{ $item->reward_amount }} {{ $item->amount_type == 'percent' ? "%" : "Tk" }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">START {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y h:i A') }}</span><br>
                                    <span class="text-danger">END {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y h:i A') }}</span><br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->end_date)->diffForHumans() }}</small><br>
                                </td>
                                <td>
                                    <a href="{{ route('campaign.edit',$item->id ) }}" class="btn btn-sm"><i class="fas fa-edit text-warning"></i></a>
                                    <a href="#" class="btn btn-sm"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div><!-- /.card-body -->
        </div><!-- /.card col-8 -->

        </div><!-- /.row -->

    </div>

@endsection
