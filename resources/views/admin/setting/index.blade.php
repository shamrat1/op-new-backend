@extends('layouts.fixed')
@section('title','Site Settings')
@section('content')
    <!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Settings</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Setting</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="ml-2">
		<div class="col card card-outline card-primary">
            <div class="card-header">
                Site Settings
            </div>
            <div class="card-body">

                @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
            <form action="{{ route('setting.createOrPatch') }}" method="POST">
                    @csrf
                    @isset($setting)
                        <input type="hidden" name="id" value="{{ $setting->id }}">            
                    {{-- {{ dd($setting) }} --}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="betting">Betting 
                                    @if($setting->betting)
                                        <i class="fas fa-lightbulb text-success"></i>
                                    @else 
                                        <i class="fas fa-lightbulb text-danger"></i> 
                                    @endif
                                    </label><br>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons" id="betting">
                                    <label class="btn btn-secondary @if($setting->betting)
                                            focus active
                                        @endif">
                                        <input type="radio" name="betting" value="1" id="option1" autocomplete="off" @if($setting->betting)
                                            checked
                                        @endif> Enable
                                    </label>
                                    <label class="btn btn-secondary @if(!$setting->betting)
                                            focus active
                                        @endif">
                                        <input type="radio" name="betting" value="0" id="option2" autocomplete="off" @if (!$setting->betting)
                                            checked
                                        @endif> Disable
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="withdraw_date">Withdraw date</label>
                                <input type="number" class='form-control' name='withdraw_date' value="{{ $setting->withdraw_date }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="backend_mobile">Site's Number</label>
                            <input type="text" class="form-control" name="backend_number" value="{{ $setting->backend_number }}" placeholder="+8801819000111">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="notice">Notice</label>
                            <textarea rows="3" name="notice"  id="notice" class="form-control">{{ $setting->notice }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isWithdrawable" id="exampleRadios1" value="1" @if($setting->isWithdrawable == true) checked @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    Turn on Withdraw Request
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isWithdrawable" id="exampleRadios2" value="0" @if($setting->isWithdrawable == false) checked @endif>
                                <label class="form-check-label" for="exampleRadios2">
                                    Turn off Withdraw Request
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isDepositable" id="exampleRadios3" value="1" @if($setting->isDepositable == true) checked @endif>
                                <label class="form-check-label" for="exampleRadios3">
                                    Turn on Deposit Request
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isDepositable" id="exampleRadios4" value="0" @if($setting->isDepositable == false) checked @endif>
                                <label class="form-check-label" for="exampleRadios4">
                                    Turn off Deposit Request
                                </label>
                            </div>
                        </div>
                    </div>
                        @else
                            <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="betting">Betting</label> <br>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons" id="betting">
                                    <label class="btn btn-secondary active" >
                                        <input type="radio" name="betting" value="1" id="option1" autocomplete="off"> Enable
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input type="radio" name="betting" value="0" id="option2" autocomplete="off"> Disable
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="backend_mobile">Site's Number</label>
                            <input type="text" class="form-control" name="backend_number" placeholder="+8801819000111">
                            </div>
                        </div> 
                        
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="notice">Notice</label>
                            <textarea rows="3" name="notice" id="notice" class="form-control"></textarea>
                        </div>
                    </div>
                    @endisset
                    <hr>
                    <div class="row">
                        <div class="col text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="row">
        <div class="card col-5 card-outline card-primary mx-2">
            <div class="card-header">
                Bet Settings
            </div>
            <div class="card-body">
                <form class="form" action="{{ route('setting.bet') }}" method="POST">
                    @method('PUT')
                    @csrf
                    @isset($bet)
                        <input type="hidden" name="id" value="{{ $bet->id }}">
                    @endisset
                    <div class="row">
                        <div class="col form-group">
                            <label for="lowest_amount">Lowest Bet Amount</label>
                            <input type="text" class="form-control" name="lowest_amount" id="lowest_amount" value="{{ !empty($bet->lowest_amount) ? $bet->lowest_amount : '' }}">
                        </div>
                        <div class="col form-group">
                            <label for="highest_amount">Highest Bet Amount</label>
                            <input type="text" class="form-control" name="highest_amount" id="highest_amount" value="{{ !empty($bet->highest_amount) ? $bet->highest_amount : '' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>     
        <div class="card col-5 card-outline card-primary">
            <div class="card-header">
                Payment Settings
            </div>
            <div class="card-body">
                <form class="form" action="{{ route('setting.payment') }}" method="POST">
                    @method('PUT')
                    @csrf
                    @isset($payment)
                        <input type="hidden" name="id" value="{{ $payment->id }}">
                    @endisset
                    <div class="row">
                        <div class="col form-group">
                            <label for="lowest_amount">Lowest Payment Amount</label>
                            <input type="text" class="form-control" name="lowest_amount" id="lowest_amount" value="{{ !empty($payment->lowest_amount) ? $payment->lowest_amount : '' }}">
                        </div>
                        <div class="col form-group">
                            <label for="highest_amount">Highest Payment Amount</label>
                            <input type="text" class="form-control" name="highest_amount" id="highest_amount" value="{{ !empty($payment->highest_amount) ? $payment->highest_amount : '' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        
        <div class="card col-6 card-outline card-primary">
            <div class="card-header">
                Settings
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <th>#</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <form action="{{ route('setting.store') }}" method="POST">
                                @csrf
                                <td></td>
                                <td>
                                    <input id="key-field" type="text" name="key" placeholder="Key" class="form-control">
                                </td>
                                <td>
                                    <input id="value-field" type="text" name="value" placeholder="Value" class="form-control">   
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-save"></i></button>
                                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-times"></i></button>
                                    </div>
                                    
                                </td>
                            </form>
                            
                        </tr>
                        @forelse($listSettings as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->key}}</td>
                                <td>{{$item->value}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button id="editSetting"
                                        data-key="{{$item->key}}"
                                        data-value="{{$item->value}}"
                                        class="btn btn-sm btn-warning"
                                        ><i class="fa fa-edit"></i></button>
                                        <form action="{{ route('setting.delete',$item->key) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete this setting? it might affect games experience or even cause apps to crash.');"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="4">No Items Found.</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
	</div>
@endsection
@section("script")
    <script>
        $(document).on("click","#editSetting",function(){
            $("#key-field").val($(this).data("key"));
            $("#value-field").val($(this).data("value"));
        });
        $(document).on("keyup","#key-field",function(e){
            $("#key-field").val($(this).val().replaceAll(" ","-"));
        });
    </script>
@endsection
