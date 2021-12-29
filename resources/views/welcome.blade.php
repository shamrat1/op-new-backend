@extends('layouts.master')
@section('title','Home')
@section('content')
     <!-- option slider -->
     @include('layouts._partials.option-sliders')
            <!-- notice marquee -->
                <div class="marquee">
                    <marquee scrollamount="5" class="default_text" style="font-weight: bold;" behavior="" direction="">{{$siteSetting->notice}}</marquee>
                </div>
            <!-- match filter section -->
                <div class="row justify-content-center">
                      <div class="col">
                          <button id="filter_matches" data-type="live" class="live_btn btn btn-block action_accent default_text">Live</button>
                      </div>
                      <div class="col">
                        <button id="filter_matches" data-type="upcoming" class="upcoming_btn btn btn-block inactive_accent default_text">Upcoming</button>
                    </div>
                </div>
            <!-- matches section -->
                <div class="matches" id="matches">
                <!-- <div class="matches"> -->
                    
                    
                    
                </div>
@php
  $appDwnSetting = $settings->where('key','app-download-url')->first();
  $showAppDwnSetting = $settings->where('key','show-app-download-dialog')->first();
  $url = "https://google.com";
  $bannerUrl = "";
  $showAppDwnDialog = false;
  if($appDwnSetting != null){
    $url = $appDwnSetting->value;
  }
  if($showAppDwnSetting != null){
    $showAppDwnDialog = boolval($showAppDwnSetting->value);
  }
  if($banner != null){
    $bannerUrl = $banner->image;
  }
@endphp
<!-- Modal -->
@if($showAppDwnDialog)
<div class="modal fade" id="appImageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: black !important;">
        <h5 class="modal-title" style="color: white !important;" id="exampleModalLabel">OnPlay365 Mobile App</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white !important;">&times;</span>
        </button>
      </div>
      <!-- <div class="modal-body"> -->
        <a href="{{ $url }}">
        <img class="rounded img-fluid" style="object-fit:cover !important;" id="img01" src="{{ asset('uploads/banner/'.$bannerUrl) }}">
        </a>
      <!-- </div> -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
@endif

@endsection

@push('script')
  <script>
  var status = "live";
  var sport = "all";

    setInterval(() => {
      // getMatches(status,sport);
    }, 10000);

    $(document).ready(function () {
      showLoader();
      getMatches(status,sport);
      $("#appImageModal").modal('show');
    });

    $(document).on('click','#sport_type',function(){
      sport = $(this).data('sport');
      showLoader();
      getMatches(status,sport);
    });

    $(document).on('click','#filter_matches',function(){
      status = $(this).data('type');
      if(status == 'live'){
        $('.live_btn').addClass('action_accent');
        $('.live_btn').removeClass('inactive_accent');
        $('.upcoming_btn').removeClass('action_accent');
        $('.upcoming_btn').addClass('inactive_accent');
      }else{
        $('.live_btn').removeClass('action_accent');
        $('.upcoming_btn').removeClass('inactive_accent');
        $('.live_btn').addClass('inactive_accent');
        $('.upcoming_btn').addClass('action_accent');
      }
      showLoader();
      getMatches(status,sport);
    });

    function getMatches(status,sport) {
   let url = "{{{ url('/') }}}";
   jQuery.get(url+"/api/matches?sport="+sport+"&status="+status,function (data,status) {
    var body = "";
    $('#matches').empty();
    if(status == 'success'){
      removeLoader();
      var matchInfoRow = "";
      if(data.length > 0){
        $.each(data,function(index,value){
        // console.log(value['bets_for_match'])
        matchInfoRow += `
        <div class="card rounded my-3 accent_bg">
          <!-- match information -->
          <div class="row mx-1 pt-1 rounded shadow">
              <div class="col">
                  <p class="m-0">`+value['name']+`</p>
                  <p class="m-0" style="font-size:9px;"><span>`+value['tournament'].name+`</span> `+formatDate(value['match_time'])+`</p>
              </div>

              <div class="col-3">
                   <img class="" src="`+getMatchTypeIcon(value['sport_type'])+`" height="30px" width="30px" alt="">
              </div>
          </div>
        `;
        $.each(value['bets_for_match'],function(indexJ,betForMatch){
          if(betForMatch['isLive'] == "1" && betForMatch['isResultPublished'] == '0'){
              var betsForMatchRow = `
              <div class="my-2">
                <div class="col-12 mb-2 p-1 rounded action_accent">
                    <p class="m-0 ml-2" style="font-size:15px;">`+betForMatch['bet_option'].name+`</p>
                </div>
                <div class="col-12">
                  <div class="row">
            `;
            // console.log(betForMatch['score'])
            $.each(betForMatch['bet_details'],function(i,data){
              var betRow = `
                <div class="col-6 p-0 card inactive_accent">
                    <button 
                    id='modalBtn'
                    data-option="`+betForMatch['bet_option'].name+`" 
                    data-name="`+value['name']+`" 
                    data-match_id="`+value['id']+`" 
                    data-bets-details-id="`+data['id']+`" 
                    data-bet-name="`+data['name']+`"
                    data-value="`+(betForMatch['score'] == true ? data['value'] : '')+`" 
                    type="button"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    class="w-100 inactive_accent text-white btn-block btn"
                    style=" font-size: 11px; white-space:normal !important;"
                    >`+data['name']+` - `+(betForMatch['score'] == true ? data['value'] : '') +`</button>
                </div>
              `;
              betsForMatchRow += betRow;
            });
            betsForMatchRow += `
                  </div>
              </div>
            </div>`;
              matchInfoRow += betsForMatchRow;
          }else{
            // console.log(betForM  atch)
          }
        });
        matchInfoRow += `
        </div>`;
        $('#matches').html(matchInfoRow);
      });
      }else{
        removeLoader();
        $('#matches').empty();
        $('#matches').html(`
        <div class="row mx-1 my-3 rounded elevation accent_bg">
                      <div class="col  my-5 text-center">
                        <h5 class="text-white">No Match Found for `+sport.toUpperCase()+`</h5>
                      </div>
                    </div>
        `);
      }
      
    }
    });
 }

 $(document).on("click","#modalBtn",function(e){

        $("#modal-body").empty();
        $('#amount').val('');

        var id = $(this).data('bets-details-id');
        var bet_name = $(this).data('bet-name');
        var option = $(this).data('option');
        var name = $(this).data('name')
        var match = $(this).data('match_id')
        var value = $(this).data("value");

        $('#bet_details_field').val(id);
        $('#match_field').val(match);

        $('#impBody').empty();
        var html = `
        <div class="col-12">
            <h5 id="option_name">`+option+`</h5>
        </div>
        <div class="col-12">
            <p id='bet_val' data-value="`+value+`">`+bet_name+` - `+value+`</p>
        </div>
        <div class="col-12">
            <input required id="amount" type="text" placeholder="Enter Amount" name='amount' min='{{ $betSetting->lowest_amount }}' max='{{ $betSetting->highest_amount }}' class="form-control">
        </div>
        <div class="col-12">
            <p class="text-danger">Limit({{ $betSetting->lowest_amount }}-{{ $betSetting->highest_amount }})</p>
        </div>
        <hr class="highlight_text">
        <div class="col-12">
            <p>Possible Return : <span id="possible_return"></span></p>
        </div>
        <div class="col-12">
            <button class="btn btn-sm p-2 action_accent text-white">Place Bet</button>
        </div>
        `;

        $('#impBody').html(html);
    });

  $(document).on("keyup","#amount",function(e){
    var amount = $(this).val();
    var betRate = parseFloat($("#bet_val").data("value"));
    console.debug(betRate);
    if ( amount >= {{ $betSetting->lowest_amount }} && amount <= {{ $betSetting->highest_amount }}){
      $("#modal-error").addClass("hidden");
      $("#possible_return").text(amount * betRate)
    }else{
      $("#possible_return").text(0)
      $("#modal-error").removeClass("hidden");
      $("#modal-error-message").text("Amount should be less than {{ $betSetting->highest_amount }} & greater than {{ $betSetting->lowest_amount }}.")
    }
  });

 function getMatchTypeIcon(type){
   var url = '{{url("/")}}';
   switch(type){
    case 'cricket':
       return url+'/icons/cricket.svg';
    case 'football':
       return url+'/icons/football.png';
    case 'volleyball':
       return url+'/icons/volleyball.png';
    case 'hockey':
       return url+'/icons/hockey.png';
    case 'tennis':
       return url+'/icons/tennis.png';
    default:
      return url+'/favicon.svg';
   }
 }

  </script>
@endpush