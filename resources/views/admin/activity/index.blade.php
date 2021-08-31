@extends('layouts.fixed')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Activity Tracker</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Activity</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="ml-2">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">List of All Activity</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Author</td>
                                <td>Author Roles</td>
                                <td>Model</td>
                                <td>Data Before</td>
                                <td>Data After</td>
                                <td>Updated At</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->roles }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->before }} </td>
                                    <td>{{ $item->after }} </td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i:s A') }} </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $activities->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
