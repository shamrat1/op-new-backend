<div class="row">
          <!-- left section -->
          <div class="col-sm-12 col-md-12">
            <div class="headline">
             <h3><CENTER>Basketball</CENTER></h3>
            </div>
            <div class="table_content" id="basket_matches_2">
              @foreach($matches as $match)
                @if ($match->sport_type == "basketball")
                    {{-- match div --}}
                    <div class="row" style="margin-right: 0px; margin-left: 0px;">
                      <div class="team_name" style="margin-right: 0px; margin-left: 0px;">
                        <h4>{{ $match->team1." VS ".$match->team2 }}</h4>
                        <h3>{{ Carbon\Carbon::parse($match->created_at)->format('d-M-Y h:m A') }}</h3>
                      </div>
                      @foreach($match->betsForMatch as $option)
                      {{-- option div --}}
                      @if ($option->isLive && !$option->isResultPublished)
                      <div class="row participant_bet" style="margin-right: 0px; margin-left: 0px;">
                        <h5 style="color: #fff" class="bigFont">{{ $option->betOption->name }}</h5>

                        <div class="row" style="margin-right: 1px; margin-left: 1px;">
                          @foreach($option->betDetails as $details)
                          {{-- bet details --}}
                            <div class="col-xs-6 col-sm-4 back_style">
                            <a class="btn-block for_btn" style="" id="trigger-modal"
                              data-toggle="modal"
                              data-target="#myModal"
                              data-option="{{ $option->betOption->name }}"
                              data-name="{{ $details->name }}"
                              data-match_id="{{ $match->id }}"
                              data-bets-details-id="{{ $details->id }}"
                              data-value="{{ $option->score ? $details->value : '' }}">
                                <span class="participant_name">{{ $details->name }}</span>
                                <span class="participant_point">{{ $option->isLive ? $details->value : '' }}</span>
                              </a>
                            </div>
                            <!-- /.col-sm-6 -->
                          {{-- bet details ends --}}
                          @endforeach
                        </div>
                      </div>
                      @endif
                      {{-- option div ends --}}
                      @endforeach
                    </div>
                    <br>
                    {{-- match div ends --}}
                @endif
              @endforeach
            </div>


          </div>
           <!-- right section -->
          <!-- <div class="col-sm-3 col-md-3">

          </div> -->
</div>
