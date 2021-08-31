<!doctype html>
<html lang="en">
  <head>
    @include('layouts._partials.header')

  </head>
  <body>
    <div class="container">
    @include('layouts._partials.nav')
        <div class="content">
            <!-- sports shortcut slider -->
            <!-- Modal -->
            <div class="modal fade inactive_accent" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content accent_bg">
                    <div class="modal-header action_bg">
                    <h5 class="modal-title" id="exampleModalLabel">Place a bet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('place.bet') }}" method="POST">
                        @csrf
                            <div id="bet_placeholder">
                                <input type="hidden" name="bet-details-id" id="bet_details_field">
                                <input type="hidden" name="match_id" id="match_field">
                                <div id="modal-error" class="col-12">
                                        <small id="modal-error-message" class="text-danger"></small>
                                </div>
                                <div class="row text-center" id="impBody">
                                    
                                    <div class="col-12">
                                        <h5 id="option_name">Something</h5>
                                    </div>
                                    <div class="col-12">
                                        <p id='bet_val'>India - 4.5</p>
                                    </div>
                                    <div class="col-12">
                                        <input required id="amount" type="text" placeholder="Enter Amount" name='amount' min='20' max='600' class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <p class="text-danger">Limit(20-6000)</p>
                                    </div>
                                    <hr class="highlight_text">
                                    <div class="col-12">
                                        <p>Possible Return : <span id="possible_return"></span></p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-sm p-2 action_accent text-white">Place Bet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
            </div> -->
                @yield('content')
        </div>
        
        @include('layouts._partials.footer')
    </div>
    <div class="loader text-center hidden">
            <div class="lds-ripple" ><div></div><div></div></div>
    </div>

    @include('layouts._partials.scripts')
</body>
</html>