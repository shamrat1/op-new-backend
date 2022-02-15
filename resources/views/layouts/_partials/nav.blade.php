<div class="row nav-div">
            <nav class="col-12 accent_bg navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('icons/logo-light.svg')}}" width="150px" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="col-12 collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Sports <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">In Play</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Advanced</a>
                    </li>
                    @guest
                        <!-- guest urls -->
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-user"></i>&nbsp;Profile
                        </a>
                        <div class="dropdown-menu action_accent" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item default_text" href="{{ route('profile') }}">View Profile</a>
                          <a class="dropdown-item default_text" href="{{ route('profile.edit') }}">Edit Profile</a>
                          <a class="dropdown-item default_text" href="{{ route('club.change') }}">Change Club</a>
                          <a class="dropdown-item default_text" href="{{ route('followers') }}">My Followers</a>
                          <a class="dropdown-item default_text" href="{{ route('bet.history') }}">Bet History</a>
                          <a class="dropdown-item default_text" href="{{ route('password.change') }}">Change Password</a>
                          <!-- <div class="dropdown-divider"></div>
                          <a class="dropdown-item default_text" href="#">Something else here</a> -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-wallet"></i>&nbsp;Wallet
                        </a>
                        <div class="dropdown-menu action_accent" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item default_text" href="{{ route('transactions.create') }}">Make Deposit</a>
                            <a class="dropdown-item default_text" href="{{ route('transactions.all') }}">Deposit History</a>
                            <a class="dropdown-item default_text" href="{{ route('coin-transfer.create') }}">Coin Transfer</a>
                            <a class="dropdown-item default_text" href="{{ route('withdraw.create') }}">Withdraw</a>
                            <a class="dropdown-item default_text" href="{{ route('withdraw.all') }}">Withdraw History</a>
                            <a class="dropdown-item default_text" href="{{ route('statement') }}">Statement</a>
                        </div>
                    </li>
                    @endguest
                </ul>
                
                </div>
                <div class="col-12 mt-3 p-0">
                    <!-- @php
                        $notAllowedWords = ['regoster','login'];
                    @endphp -->
                @guest
                    <!-- sign in form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                            <input type="text" name="username" placeholder="Username" class="form-control ">
                            @error('username') <small class="text-danger">{{$message}}</small> @enderror
                            <input type="password" name="password" placeholder="Password" class="form-control mt-2">
                            @error('password') <small class="text-danger">{{$message}}</small> @enderror

                            <div class="row mt-2">
                                <div class="col-6">
                                    <button class="btn btn-sm action_accent default_text">Login</button>
                                    <!-- <a href="" class="btn btn-sm action_accent default_text">Login</a> -->
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('register') }}" class="btn btn-sm action_accent default_text">Join Now</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <a href="{{ route('password.request') }}" style="color: #969696; font-size: smaller;">Forgot Password ?</a>
                                </div>
                                
                            </div>
                        </form>                    
                    @else
                    <div class="row">
                        <div class="col-3">
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button class="btn btn-sm action_accent default_text">Logout</button>
                            </form>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-5">
                            <div class="card action_accent default_text justify-content-center" style="font-size: 9pt;">
                                Welcome, {{auth('web')->user()->username}}
                                <p class="m-0 p-0">&nbsp;<i class="fas fa-coins"></i>&nbsp;{{$credit}} <br> <i class="text-danger fas fa-coins"></i>&nbsp;{{auth()->user()->credit->bonus_point ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    @endguest

                </div>
            </nav>
            <!-- </div> -->
        </div>