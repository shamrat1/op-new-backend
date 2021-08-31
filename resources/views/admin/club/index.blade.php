@extends('layouts.fixed')
@section('title','All Clubs')
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
                    <h1 class="m-0 text-dark">All Clubs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clubs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="ml-4">
        <div class="row">
                    <div class="card col-7 card-primary card-outline">
            <div class="card-header">
                <div class="card-title">
                    List of all Clubs  
                </div><!-- /.card-title -->
                <div class="card-tools">
                    {{-- <a href="" class="btn btn-sm"><i class="fas fa-plus"></i></a>     --}}
                </div><!-- /.card-tools -->    
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Club Name</th>
                            <th>Owner username</th>
                            <th>Owner Credit</th>
                            <th>Members</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($clubs as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->owner->username }}</td>
                                <td>{{ $item->ownerCredit }}</td>
                                <td>{{ $item->users->count() }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm"><i class="fas fa-edit text-warning"></i></a>
                                    <a href="#" class="btn btn-sm"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div><!-- /.card-body -->
        </div><!-- /.card col-8 -->

        <div class="card col-4 ml-5 card-outline card-warning">
            <div class="card-header">
                <div class="card-title">
                    New Club    
                </div><!-- /.card-title -->
            </div><!-- /.card-header -->
            <div class="card-body">
            <form action="{{ route('club.store') }}" method="POST" class="form" id="newClubForm">
                @csrf
                    <div class="form-group">
                        <label for="name">Club Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter club name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="user_id">Owner</label>
                        <select name="user_id" required id="" class="custom-select">
                            <option>Select owner</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach    
                        </select><!-- /# -->
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror  
                    </div><!-- /.form-group -->
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-success" id="saveButton">Save</button>
                    </div><!-- /.text-right -->
                </form><!-- /#form.form -->  
            </div><!-- /.card-body -->
        </div><!-- /.card col-4 card-outline card-warning -->
        </div><!-- /.row -->

    </div>

@endsection

@section('plugin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.custom-select').chosen();

            $(document).on('click','#saveButton',function(e){
                e.preventDefault();

                $.confirm({
                    icon:'fas fa-exclamation-triangle',
                    title:'Alert',
                    content:'Do you want to save this ?',
                    buttons:{
                        Yes:{
                            btnClass:'btn-success',
                            action:function(){
                                $('#newClubForm').submit();
                            }
                        },
                        No:{
                            btnClass:'btn-danger',
                            action:function(){
                                //
                            }
                        }
                    }
                });
            });
        });
    </script> 
@endsection