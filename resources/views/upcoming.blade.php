@extends('layouts.master')
@section('title','World Bet 365 | Home')
@section('style')

<style type="text/css">
  :focus {
    outline: -webkit-focus-ring-color auto 0px;
    }

    .font-5v{
      font-size: 5vw
    }
    .font-3v{
      font-size:3vw
    }

    .left_section {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 999;
      height: 23px;
      margin-top: 100px;
    }
    /*.tab_img{float: left;}*/
     .leftTableTab{
      position: relative;
      overflow: hidden;
      background-color: #14805E;
      height: 348px;
    }
    .tableTab {
    position: relative;
    overflow: hidden;
    }
    .abc{position: relative;
        width: 100%;
        height: 100%;
        flex-wrap: unset;
        flex-direction: row;
        border-bottom: none;
        left: 0;
        transition: 0.4s;}
        .live-in-play-carousel-item {
        display: flex;
        width: 85px;
        justify-content: center;
        white-space: nowrap;
        flex-shrink: 0;
        padding: 5px;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        transition: 0.3s;
        background: #1e2531;
        float: left;background: #14805E;
        color: #fff;
    }
    .abc>a:hover,.abc>a:active , .abc>a:focus{
      background-color: #38A180;color: #F4E849;text-decoration: none ;
    }
    .lefttab_item {
        background-color: #fff;
        text-align: center;
        border: 1px solid;
        padding: 9px;
    }
    .lefttab_item>a {
        color: #000;
        text-decoration: none;
        font-size: 15px;display: flex;
    }
    .lefttab_item>a:hover {
        color: #fff;}
    .lefttab_item:hover{background-color: #116D50;}
    img.tab_img {margin-right: 10px;}

    #siteClock{color: #000;
    font-size: 15px;
    font-weight: bold;}

    /*left section end*/

      #full_section{text-transform: capitalize; font-family: 'Noto Sans JP', sans-serif;}
     /* .main_contain{margin-top: 80px;}*/
      .text_color{
        color: #ffffff;
      }
      .all_span{
        color:#EAF607;
      }
      .nav-tabs {
        padding-left: 210px;
        background-color: #14805E;
        text-align: center;
        border-bottom: 0px solid #000;}
      
      .nav-tabs>li>a {
        color: #000;
        font-weight: bold;
        font-size: 15px;
      }
      .nav-tabs>li {
        float: left;
        margin-bottom: -2px;
      }
      .nav-tabs>li>a:hover,.nav-tabs>li>a:focus {
        color: #000;
        background-color: #38A180 !important;
      }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #0c0c0c;
        cursor: default;
        background-color: #38A180 ;
        border: 1px solid #000;     }
      .headline{
        background-color: #13bb84;
        color: #000;
        padding: 10px 10px;    margin-top: 2px;
      }
      .table_content{
        background-color: #14805E;}
  
      .ash {
       color: #CEC7B9;
       font-size: 20px;
      }
      .team_name{
        padding: 4px;
        background-color: #163e31;
        color: #fff;
      }
      .for_btn{padding: 6px;border-radius: 0px !important;}
      /*.for_btn:hover{color: #fff;}*/
      /*sport table start*/
      .back_style{
        border-left: 1px solid #005580;
        border-top: 1px solid #005580;
        border-bottom: 1px solid #005580;
        border-right: 1px solid #005580;
        text-align: center;
        background-color: #fff;
      }
      .back_style:hover{
        background-color: #13e8a2;
      }span.participant_point {
        margin-left: 5px;
    color: #01ab4d;
    font-weight: bold;
}span.participant_name {
    color: #000;
    font-weight: bold;
}
      .back_style:hover>a>.participant_point{color: #fff}
      h5{ margin-left: 12px;}
     /* .back_style>button:hover{
        background-color: #3896DF;
        color: #ddd;
      }*/
      /*counter in modal*/
      .modal-title{text-align: center;}
      .modal-content{width: 502px;
        height: 295px;}
      .modal-body{height: 74px;}
      .stepper-sport .stepper .stepper-arrow { top: 0;bottom: 0;width: 60px; height: 60px; margin: 0; line-height: 60px; color: #fff; text-align: center; border-radius: 3px; background-color: #616161;transform: translateY(0); }
      .stepper-arrow.up {
        right: 4px;
        text-align: left;
        font-size: 30px;
      }
      .stepper-arrow.down {left: 4px;text-align: right;font-size: 30px;}.stepper {position: relative;display: inline-block; max-width: 76px;width: 76px; }.stepper-sport { margin-top: 20px;}.stepper-sport .stepper { width: 180px;max-width: 180px;text-align: center;}.stepper-sport .stepper input[type="number"] {
      width: 60px; max-width: 60px;  min-height: 60px;  padding: 0 5px;  margin-left: auto; margin-right: auto; line-height: 60px;  text-align: center; -moz-appearance: textfield; font-family: "Kanit", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;font-size: 24px;  font-weight: 400; color: #151515; background-color: #edeff4; border: 0;}
      .stepper-arrow {
        position: absolute; top: 50%; width: 20px; height: 20px;  margin-top: -10px; font-size: 16px; line-height: 20px; font-family: "Material Icons";cursor: pointer;color: #151515; transition: .3s all ease;}
      .form-input {
        display: block; width: 50%; padding: 6px 16px; font-size: 14px; font-weight: 400;line-height: 24px;color: #9b9b9b; background-color: #fff;background-image: none;border-radius: 3px;-webkit-appearance: none;transition: .3s ease-in-out;border: 1px solid #e1e1e1;margin-left: 150px;}
      .modal-sport-place{margin-right: 166px;padding: 5px;text-transform: uppercase;font-size: 20px; font-weight: 600;background-color: #036f4d;color: #fff;border-radius: 22px;}
      #modal-error{margin-bottom: -10px;}.modal-sport-win-left{margin-right: 40px;font-size: 15px;font-weight: 600;}
      .bet_possible_win{margin-right: 60px;font-size: 20px;font-weight: bold;color: #07e4cf;}.modal-footer {margin-top: 5px;}
      /*counter in model end*/
      /*sport table end*/
      /*left side css end*/
      /*right*/
      .co{margin-top: 59px;margin-left: -9px;}
      .highlight{ text-align: center;font-size: 25px;font-weight: 700;background: #071c2c;    }
      .description{font-size: 21px;color: rgb(29, 58, 89);font-family: 'Droid Sans';margin-left: -30px;}
      .highlight_list{margin-bottom: 25px;}
      .live_score{text-align: center;font-size: 25px;font-weight: 700; margin-top: 30px;border-radius: 20px;margin-bottom: 50px; }
      .game-result-cust {color: #000;font-size: 12px;}
      .game-info-main {
          display: inline-flex; flex-direction: row; flex-wrap: nowrap;align-items: center; justify-content: space-between;min-width: 100%;max-width: 100%;margin-top: 0;margin-bottom: 1px;padding: 5px;border: 2px solid #000;border-radius: 0; margin-bottom: 10px;}
      .game-info-team{  padding: 9px 9px 9px 0px;border-radius: 25px;width:199px; margin: 10px;}
      .change-color{color: #ffffff;}
      .left{ margin-left: 10px;}
      .right{margin-right: 10px;}
      .live_title{font-size: 20px;color: #000;}
      /*all sports end*/

      /*right section start*/
      .for_list{border-bottom: 2px solid;height: 96px;}
      .for_date{border-right: 2px solid #000;}
      .uppersection{margin-bottom: 50px;background-color: #fff;}
      .for_size{background-color: #fff;margin-top: 95px;}
      .highlight_title{color: #000;}
      .data_list{margin-left: -25px;font-size: 12px;display: inline-block;line-height: 16px;}
      .upcoming,.live{    color: #000;font-weight: bold;text-align: center;background: #f5f5f5; font-size: 16px;}
      .block_content {display: block;padding: 7px 0px 7px 0;border-bottom: 1px solid #1a1a1a;}
      .main_container_block{background: #e6e6e6;    border: 2px solid #1f6519;}
      .published_date {        font-size: 13px;width: 60px;float: left;text-align: center;padding-right: 5px;}
      .extra_content_wrap {border-left: 2px solid #1a1a1a;padding-left: 8px;overflow: hidden;margin-bottom: 7px;font-size: 14px;}

      /*responsive start*/
 
    @media(max-width: 320px){
      .left_section{display: none;}
      .tableTab {height: 100%;}.nav-tabs {padding-left: 45px;height: 100%;}a.live-in-play-carousel-item {font-size: 8px;}.left_section{display: none;}ul.nav.nav-tabs.all_sports_nav {padding-left: 0;}a#trigger-modal {font-size: 9px;}.nav>li>a {font-size: 11px !important;}div#modal-content {width: 100%;}input#bet-amount {margin-left: 75px;}p.modal-sport-win-left {font-size: 11px; margin-left: -4px;margin-right: 0;}span#display-return {font-size: 15px;}button#placeBetSubmitButton {font-size: 14px;margin-right: 90px; width: 100%;}.published_date.clearfix,.extra_content_wrap {font-size: 10px;}.team_name { padding-left: 0px;}h5 {margin-left: 10px;}.container-fluid{padding:0;overflow-x: hidden;}.col-md-10.col-md-offset-2.col-sm-offset-3.col-sm-9.col-lg-10.col-lg-offset-2.main_contain {padding: 0;overflow-x: hidden;}.col-md-9.col-md-offet-2 {padding: 0;overflow-x: hidden;}.col-sm-3.col-md-3.for_size {padding: 0;overflow-x: hidden} .live_option{width: 30%;float: right; margin-top: -55px;}.match_name_details{ width: 85%;}

      .low-font{
      font-size:9px;
    }
    .small_font{
      font-size: 14px;
    }
  }

    @media(min-width: 320px) and (max-width: 480px){
      .team_name {padding-left: 0px;}h5 { margin-left: 10px;}.nav.nav-tabs.abc {padding: 0;}.published_date.clearfix {font-size: 11px;}a.live-in-play-carousel-item {font-size: 8px;width: 16%;}.tableTab { height: 100%;}.left_section{display: none;}.nav-tabs>li>a {font-size: 8px !important;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}a#trigger-modal {font-size: 11px;}div#modal-content {width: 100%;}p.modal-sport-win-left {margin-right: 63px;font-size: 10px;}button#placeBetSubmitButton {font-size: 14px;    width: 100%;}  .container-fluid{padding:0;overflow-x: hidden;}.col-md-10.col-md-offset-2.col-sm-offset-3.col-sm-9.col-lg-10.col-lg-offset-2.main_contain {padding: 0;overflow-x: hidden;}.col-md-9.col-md-offet-2 { padding: 0;overflow-x: hidden}.col-sm-3.col-md-3.for_size { padding: 0;overflow-x: hidden}  input#bet-amount {margin-left: 120px;}.live_option{float: right;
    width: 100%;
    margin-top: -65px;}.match_name_details{width: 90%;
    margin-bottom: 28px;}
    .low-font{
      font-size:6pt;
    }
    .small-font{
      font-size: 10px !important;
    }
    }
     @media (min-width: 480px) and (max-width: 580px){
      .tableTab {height: 100%;}.nav.nav-tabs.abc {padding: 0;}a.live-in-play-carousel-item {width: 16%;font-size: 11px;}.published_date.clearfix {font-size: 11px;}.left_section{display: none;}.nav>li>a {font-size: 12px !important;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}div#modal-content {width: 100%;}p.modal-sport-win-left {font-size: 11px;}button#placeBetSubmitButton {width: 35%;}.container-fluid{padding:0;overflow-x: hidden;}.col-md-10.col-md-offset-2.col-sm-offset-3.col-sm-9.col-lg-10.col-lg-offset-2.main_contain {padding: 0;overflow-x: hidden;}.col-md-9.col-md-offet-2 {padding: 0;overflow-x: hidden}.col-sm-3.col-md-3.for_size {padding: 0;overflow-x: hidden}.team_name {
    margin-left: 15px;

}h5 {
    margin-left: 10px;
}.live_option{margin-top: -35px;}
    }
    @media (min-width: 580px) and (max-width: 768px){
      .published_date.clearfix {font-size: 11px;}.nav.nav-tabs.abc {padding: 0; margin-left: 12px;}.left_section{display: none;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}.container-fluid{padding:0;overflow-x: hidden;}.col-md-10.col-md-offset-2.col-sm-offset-3.col-sm-9.col-lg-10.col-lg-offset-2.main_contain {padding: 0;overflow-x: hidden;}.col-md-9.col-md-offet-2 {padding: 0;overflow-x: hidden}.col-sm-3.col-md-3.for_size {padding: 0;overflow-x: hidden}.team_name { margin-left: 15px;}h5 { margin-left: 10px;}div#modal-content {margin-left: 120px;}
}

    }
    @media (min-width: 768px) and (max-width: 940px){
      .published_date.clearfix {font-size: 11px;}.nav.nav-tabs.abc {padding: 0;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}.col-sm-2.col-md-2.left_section {width: 25%;margin-top: 117px;}.col-sm-3.col-md-3.for_size {width: 100%;}
    }
    @media (min-width: 940px) and (max-width: 1030px){
      .leftTableTab {width: 120%;}.nav.nav-tabs.abc {padding: 0;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}div#modal-content {margin-left: 60px;}
    }
    @media (min-width: 1031px) and (max-width: 1199px){
      .nav.nav-tabs.abc {padding: 0;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}div#modal-content {margin-left: 65px;}
    }
    @media(min-width: 1199px) and (max-width: 1330px){
      .nav.nav-tabs.abc {padding: 0;}ul.nav.nav-tabs.all_sports_nav {padding: 0;}
    }
    
</style>

@endsection

@section('content')

<!--  dd($matches)  -->

<section id="full_section">
  <div class="container-fluid">
    <!-- left section -->
      <div class="col-sm-2 col-md-2 left_section">
              <div class="leftTableTab ">
                <div class="lefttab_item"><p class="text-center" id="siteClock" >08:14:41 PM</p></div>
                <div class="lefttab_item"> <a data-toggle="tab" class="" href="#home" charset=><img src="img/all.png" height="25px" class="tab_img">All Sports</a></div>
                <div class="lefttab_item"> <a data-toggle="tab" class="" href="#cricket"><img src="img/cricket.png" class="tab_img">Cricket</a></div>
                <div class="lefttab_item"> <a data-toggle="tab" class="" href="#soccer"><img src="img/soccer-1.png" class="tab_img">Football</a></div>
                <div class="lefttab_item"> <a data-toggle="tab" class="" href="#basketball"><img src="img/basketball-1.png" class="tab_img">Basket</a></div>
                <div class="lefttab_item"> <a data-toggle="tab" class="" href="#volleyball"><img src="img/volleyball.png" class="tab_img">Volley</a></div>
                <div class="lefttab_item"><a data-toggle="tab" class="" href="#tennis"><img src="img/tennis.png" class="tab_img">Tennis</a></div>              
              </div>
      </div>
    <div class="row">
{{-- {{ dd(auth()->user()->hasRole('Club Owner')) }} --}}
      <div class="col-md-10  col-md-offset-2 col-sm-offset-3 col-sm-9 col-lg-10 col-lg-offset-2 main_contain">
         <!-- all sports -->
      <div class="col-md-9 col-md-offet-2">
        @include('layouts.slider')
        <div class="all_sports">
              <div class="tableTab ">
                <div class="nav nav-tabs abc">
                 <a data-toggle="tab" class="live-in-play-carousel-item" href="#home" charset=><img src="img/all.png" height="30px">All Sports</a>
                 <a data-toggle="tab" class="live-in-play-carousel-item" href="#cricket"><img src="img/cricket.png">Cricket</a>
                 <a data-toggle="tab" class="live-in-play-carousel-item" href="#soccer"><img src="img/soccer-1.png">Football</a>
                 <a data-toggle="tab" class="live-in-play-carousel-item" href="#basketball"><img src="img/basketball-1.png">Basket</a>
                 <a data-toggle="tab" class="live-in-play-carousel-item" href="#volleyball"><img src="img/volleyball.png">Volley</a>
                 <a data-toggle="tab" href="#tennis" class="live-in-play-carousel-item"><img src="img/tennis.png">Tennis</a>
                </div>
                
              </div>

            <div class="tab-content">
              <!-- All Sports -->
                <div id="home" class="tab-pane fade in active">
                  {{-- @include('sports.cricket')
                  @include('sports.football')
                  @include('sports.basket')
                  @include('sports.volleyball')
                  @include('sports.tennis') --}}
                  <div class="col-sm-12 col-md-12">
                    <div class="headline">
                    <h3><CENTER>CRICKET</CENTER></h3>
                    </div>
                    <div class="table_content" id="cricket_matches"></div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="headline">
                    <h3><CENTER>FOOTBALL</CENTER></h3>
                    </div>
                    <div class="table_content" id="football_matches"></div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="headline">
                    <h3><CENTER>Tennis</CENTER></h3>
                    </div>
                    <div class="table_content" id="tennis_matches"></div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="headline">
                    <h3><CENTER>BASKETBALL</CENTER></h3>
                    </div>
                    <div class="table_content" id="basketball_matches"></div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="headline">
                    <h3><CENTER>VOLLEYBALL</CENTER></h3>
                    </div>
                    <div class="table_content" id="volleyball_matches"></div>
                  </div>
                  
                  
                  
                  
              </div>
               <!-- cricket -->
              <div id="cricket" class="tab-pane fade">
                {{-- <div class="table_content" id="cricket_matches_2"></div> --}}
                @include('sports.cricket')
              </div>
                <!-- football -->
              <div id="soccer" class="tab-pane fade">
                {{-- <div class="table_content" id="football_matches_2"></div> --}}
                @include('sports.football')
              </div>
                <!-- Basket -->
              <div id="basketball" class="tab-pane fade">
                {{-- <div class="table_content" id="basketball_matches_2"></div> --}}
                @include('sports.basket')
              </div>
                <!-- Volley -->               
              <div id="volleyball" class="tab-pane fade">
                {{-- <div class="table_content" id="volleyball_matches_2"></div> --}}
                @include('sports.volleyball')
              </div>
                <!-- Tennis -->
              <div id="tennis" class="tab-pane fade">
                {{-- <div class="table_content" id="tennis_matches_2"></div> --}}
                @include('sports.tennis')
              </div>
                 <!-- modal -->
                 <div class="modal fade modal_s" id="myModal" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content" id="modal-content">
                                <div class="modal-header" style="background-color: #036f4d;">
                                  <button type="button" class="close" data-dismiss="modal" style="color: #fcf8e3;font-size: 30px;">&times;</button>
                                  <h4 class="modal-title" style="color: #ffffff;">PlACE A BET</h4>
                                </div>
                                <div class="alert alert-danger hidden" id="modal-error" role="alert">
                                  <h5 class="text-danger font-weight-bold" id="modal-error-message">Amount is too low</h5>
                                </div>
                              <form id="placeBetForm" action="{{ route('place.bet') }}" method="POST">
                                @csrf
                                <div class="modal-body" id="modal-body">
                                  
                                </div>

                                {{-- 
                                <div class="stepper-sport text-center">
                                 <div class="col-md-5 ">
                                  <span class="stepper-arrow up" onclick="increse()">+</span>
                                  <span class="stepper-arrow down" onclick="decrese()">-</span>
                                </div>
                              </div> --}}
                              <div class="text-center">

                                  <input class="form-input" name="amount" placeholder="Enter amount" id="bet-amount" type="number" data-zeros="true"  min="20" max="6000">
                                

                              </div>
                              <div class="text-center">
                                <span style="color: red;" class=" message2" id="message2">Limit ({{ $betSetting->lowest_amount." - ".$betSetting->highest_amount }})</span>
                              </div>
                              <div class="modal-footer">
                                <div class="modal-sport-win">
                                  <div class="col-xs-6 col-md-6">
                                    <p class="modal-sport-win-left">Possible Return</p>
                                  </div>
                                  <div class="col-xs-6 col-md-6">
                                   <span class="bet_possible_win" id="display-return"></span>
                                  </div>                            
                                </div>
                                <button id="placeBetSubmitButton" class="modal-sport-place button button-primary button-block" type="button">place bet</button>
                              </div>
                              </form>
                            </div>

                          </div>
                    </div>
                 <!-- modal end -->             
            </div>
          
        </div>
      </div>
      <!-- all sports end -->

      <!-- right section -->
      <div class="col-sm-3 col-md-3 for_size">
         <!--    Live score start -->
            <div class="live_score">
              <h3 class="live">Live Scores</h3> 
                
                <div class="main_container_block" id="live">
                 
                </div>
            </div>
        <div class="uppersection">
            <div class="highlight">
              <h3 class="upcoming">Upcoming Matches</h3> 
                <div class="main_container_block" id="list">
                 
                </div>
            </div>
        
        </div>
      </div>
      </div>
     
    </div>
    <!-- row end -->
  </div>
</section>



@endsection

          
@section('script')
  <script type="text/javascript">
  setInterval(() => {
    getMatches()
  }, 10000);
  $(document).ready(function () {
    getMatches();
  });
  function formatDate(date) {
     var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();
      hour = d.getHours();
      min = d.getMinutes();

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;
    let string = [year, month, day].join('-');
    var ampm = hour >= 12 ? 'pm' : 'am';
    hour = hour % 12;
    hour = hour ? hour : 12; // the hour '0' should be '12'
    min = min < 10 ? '0'+min : min;
    var strTime = hour + ':' + min + ' ' + ampm;
     return string+" "+strTime;
 }

 function getMatches() {
   let url = "{{{ url('/') }}}";
   $.getJSON(url+"/api/matches/upcoming",function (data) {

      var cricket = ''
      var football = ''
      var tennis = ''
      var basketball = ''
      var volleyball = ''
      $.each(data,function (i) {
        // console.log(data[i]["tournament"]);
        let date = formatDate(data[i]['match_time'])
        let match = data[i];
        
          let ele = "<div class='row' style='margin-right: 0px; margin-left: 0px;'><div class='row team_name'><div class='col-sm-6'><h4>"+match['team1']+" VS "+match['team2']+"</h4><h3>"+date+" | "+match["tournament"]["name"]+" |  "+match["tournament_match_no"]+"</h3></div><div class='col-sm-6 text-right'><span>Upcoming</span><h3>"+match["score"]+"</h3></div></div></div>"
          $.each(match['bets_for_match'],function (j) {
            let option = data[i]['bets_for_match'][j];
            let optionName = option['bet_option']['name']
            if(option['isLive'] == true && option['isResultPublished'] == false){
              ele += "<div class='row' style='margin-right: 0px; margin-left: 0px;'><h5 style='color: #000'>"+optionName+"</h5><div class='row' style='margin-right: 1px; margin-left: 1px;'>"

              $.each(option['bet_details'],function (k) {
                let details = data[i]['bets_for_match'][j]['bet_details'][k];
                let betValue = option['score'] == true ? details['value'] : '-';
                ele += "<p id=optionName"+details['id']+" style='display:none'>"+optionName+"</p><p id=betName"+details['id']+" style='display:none'>"+details['name']+"</p>"
                ele += "<div class='col-xs-6 col-sm-4 back_style'><a class=' btn-block for_btn' id='trigger-modal' data-toggle='modal' data-target='#myModal' data-option="+optionName.toString()+" data-name="+details['name']+" data-match_id="+match['id']+" data-bets-details-id="+details['id']+" data-value="+betValue+"><span class='participant_name'>"+details['name']+"</span> <span class='participant_point'>"+betValue+"</span></a></div>"
                // console.log(ele);
              });
              ele += "</div></div>"
            }
          });
          ele += "</div><br>"
          if(match['sport_type'] == 'cricket'){
            cricket += ele
          }else if (match['sport_type'] == 'football'){
            football += ele
          }else if (match['sport_type'] == 'basketball'){
            // console.log(match['match_time'])
            basketball += ele
          }else if (match['sport_type'] == 'volleyball'){
            volleyball += ele
          }else{
            //tennis
            tennis += ele
          }
        
        if(match['sport_type'] == 'cricket'){
          let cricEle = cricket
          $('#cricket_matches').html(cricEle)
          $('#cricket_matches_2').html(cricEle)

        }else if (match['sport_type'] == 'football'){

          $('#football_matches').html(football)
          $('#football_matches_2').html(football)

        }else if (match['sport_type'] == 'basketball'){

          $('#basketball_matches').html(basketball)
          $('#basketball_matches_2').html(basketball)

        }else if (match['sport_type'] == 'volleyball'){

          $('#volleyball_matches').html(volleyball)
          $('#volleyball_matches_2').html(volleyball)

        }else{
          //tennis
          $('#tennis_matches').html(tennis)
          $('#tennis_matches_2').html(tennis)
        }
      });
    });
 }
      
    $(document).ready(function(){
      $.getJSON("https://cricapi.com/api/cricketScore?apikey=LBzdU0fOobcyE2aBt6Qi3492bJQ2&unique_id=1034809",function(data){
        var match_data_team_1 = '';
        var match_data_team_2 = '';
        var pubdate = '';
        // console.log(data["provider"]["pubDate"])
        match_data_team_1 += "<span>"+data["team-1"]+"</span>"
        match_data_team_2 += "<span>"+data["team-2"]+"</span>"
        pubdate += "<span>"+data["provider"]["pubDate"]+"</span>"
        $('#match_name_team-1').append(match_data_team_1);
        $('#match_name_team-2').append(match_data_team_2);
        $('#test-1').append(match_data_team_1);
        $('#pubdate').append(pubdate);
        /*live score*/
      $('#score-team-1').append(match_data_team_1);
        $('#score-team-2').append(match_data_team_2);


      });
      $(document).on("keyup","#bet-amount",function(e){
      var amount = $(this).val();
      var betRate = $("#bet-val").data("value");
      
      if ( amount >= {{ $betSetting->lowest_amount }} && amount <= {{ $betSetting->highest_amount }}){
        $("#modal-error").addClass("hidden");
        $("#display-return").text(amount * betRate)  
        document.getElementById("modal-content").style.height='295px';
      }else {
        $("#display-return").text(0)
        $("#modal-error").removeClass("hidden");
        $("#modal-error-message").text("Amount should be less than {{ $betSetting->highest_amount }} & greater than {{ $betSetting->lowest_amount }}.")
        document.getElementById("modal-content").style.height='350px';
      }
    });
      $(document).on("click","#trigger-modal",function(e){
        $("#modal-body").empty();
        $('#bet-amount').val('');
        var id = $(this).data('bets-details-id');
        var option = $('#optionName'+id).text()
        var name = $('#betName'+id).text()
        var match = $(this).data('match_id')
        var value = $(this).data("value");
        // console.log(match)
        var html = "<div class='text-center betinfo'>"
                    +"<h5>"+option+"</h5>"
                    +"<p id='bet-val' data-value="+value+">"+name+"  "+value+"</p>"
                    +"<input type='hidden' name='bets-details-id' value="+id+">"
                    +"<input type='hidden' name='match_id' value="+match+">"
                    +"</div>"
        $("#modal-body").append(html)
    });
    });

  
    /**/
    $(document).ready(function(){
      $.getJSON("https://cricapi.com/api/matchCalendar?apikey=LBzdU0fOobcyE2aBt6Qi3492bJQ2",function(data){
        var match_name = '';
        var match_date = '';
        for(var i=0; i<5; i++){
          console.log(data["data"][i])
            match_name=" <div class='block_content'><div class='published_date clearfix'><span>"+data["data"][i]["date"]+"</span> </div><div class='extra_content_wrap'><span>"+data["data"][i]["name"]+"</span> </div> </div>";
          }
        $("#list").append(match_name);

      });
    });
  </script>
  <script type="text/javascript">
    $(document).on("keyup","#bet-amount",function(e){
      var amount = $(this).val();
      var betRate = $("#bet-val").data("value");
      
      if ( amount >= {{ $betSetting->lowest_amount }} && amount <= {{ $betSetting->highest_amount }}){
        $("#modal-error").addClass("hidden");
        $("#display-return").text(amount * betRate)  
        document.getElementById("modal-content").style.height="295px";                
      }else {
        $("#display-return").text(0)
        $("#modal-error").removeClass("hidden");
        $("#modal-error-message").text("Amount should be less than {{ $betSetting->highest_amount }} & greater than {{ $betSetting->lowest_amount }}.")
        document.getElementById("modal-content").style.height="350px";
      }
    });
    
    $(document).on("click","#trigger-modal",function(e){
        $("#modal-body").empty();
        $('#bet-amount').val('');
        var id = $(this).data('bets-details-id');
        var option = $('#optionName'+id).text()
        var name = $('#betName'+id).text()
        var match = $(this).data('match_id')
        var value = $(this).data("value");
        // console.log(match)
        var html = "<div class='text-center betinfo'>"
                    +"<h5>"+option+"</h5>"
                    +"<p id='bet-val' data-value="+value+">"+name+"  "+value+"</p>"
                    +"<input type='hidden' name='bets-details-id' value="+id+">"
                    +"<input type='hidden' name='match_id' value="+match+">"
                    +"</div>"
        $("#modal-body").append(html)
    });

    $(document).on("click","#placeBetSubmitButton",function(e){
      const isAuthenticated = "{{{ (Auth::user()) ? Auth::user() : null }}}"
      const isClubOwner = "{{{ (Auth::user()) ? auth()->user()->hasRole('Club Owner') : false }}}";
      if(isAuthenticated && !isClubOwner){
        $("#placeBetForm").submit();
      }else{
        $("#modal-error").removeClass("hidden");
        $("#modal-error-message").text("Operation not allowed.")
        document.getElementById("modal-content").style.height="350px";
      }
    });

    $(document).ready(function() {
      const loggedIn = "{{{ auth()->check() }}}"
      if(loggedIn){
        const credit = "{{{ !empty(auth()->user()->credit) ? auth()->user()->credit->amount : 0 }}}";
        if(credit < 20){
          $('#placeBetSubmitButton').attr('disabled',true);
        }
      }
      
    });


    /*football*/
    $(document).ready(function(){
      $.getJSON("https://apiv2.apifootball.com/?action=get_countries&APIkey=23f16316ad9a6a21d45facfe8a05829177500c3281153cd58aa3ae88736f30fe",function(data){
        var soccer_match_data_team_1 = '';
        var soccer_match_data_team_2 = '';
        var pubdate = '';
        // console.log(data["provider"]["pubDate"])
        match_data_team_1 += "<span>"+data["0"]+"</span>"
        match_data_team_2 += "<span>"+data["1"]+"</span>"
        pubdate += "<span>"+data["provider"]["pubDate"]+"</span>"
        $('#match_name_team-1').append(soccer_match_data_team_1);
        $('#match_name_team-2').append(soccer_match_data_team_2);
        /*$('#test-1').append(match_data_team_1);
        $('#pubdate').append(pubdate);*/
        /*live score*/
      $('#soccer-team-1').append(soccer_match_data_team_2);
        $('#soccer-team-2').append(soccer_match_data_team_2);
      });
      /*$(document).on("click","#trigger-modal",function(e){
        $("#title").text($(this).data("match-name"));
      });*/
    });

    /*show time*/
      function showTime(){
          var date = new Date();
          var h = date.getHours(); // 0 - 23
          var m = date.getMinutes(); // 0 - 59
          var s = date.getSeconds(); // 0 - 59
          var session = "AM";

          if(h == 0){
              h = 12;
          }

          if(h % 12 == 0){
              // h = h - 12;
              session = "PM";
          }else if (h > 12) {
              h = h - 12;
              session = "PM";
          }

          h = (h < 10) ? "0" + h : h;
          m = (m < 10) ? "0" + m : m;
          s = (s < 10) ? "0" + s : s;

          var time = h + ":" + m + ":" + s + " " + session;
          document.getElementById("siteClock").innerText = time;
          document.getElementById("siteClock").textContent = time;

          setTimeout(showTime, 1000);

      }
      showTime();
      $('input,textarea').attr('autocomplete', 'off');


  </script>
  @endsection