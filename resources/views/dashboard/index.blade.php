@extends('layouts.fixed')

@section('title','OnPlay365 | Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <h1 class="m-0 text-dark">Dashboard</h1> &nbsp;
                    <a href="{{ route('match.import.refresh') }}" class="btn btn-sm btn-info shadow"><i class="fa fa-refresh"></i></a>
                </div>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="live_count">{{ $matches->where('status','live')->count() }}</h3>

                        <p>Live Matches</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-basketball-ball"></i>
                    </div>
                <a href="{{ route('match.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="upcoming_count">{{ $matches->where('status','upcoming')->count() }}</h3>

                        <p>Upcoming matches</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('match.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $users }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    @role('Admin')
                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    @else
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    @endrole
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>clubs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row ml-1" id="matches">
            @foreach ($matches as $match)
                <div class="col-sm-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $match->team1 ." V ". $match->team2}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-print"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-cash-register text-danger"></i></div>
                                    <div class="col">{{ $match->bids->count() }}</div>
                                    <div class="col">bids</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-arrow-up text-success"></i></div>
                                    @php
                                        $highest = 0;
                                        $highest = $match->bids->sortbyDesc('amount')->first();
                                    @endphp
                                    <div class="col">
                                        @isset($highest->amount)
                                            {{ $highest->amount }}
                                        @else
                                            0
                                        @endisset
                                    </div>
                                    <div class="col">Highest bid</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-arrow-down text-danger"></i></div>
                                    @php
                                        $lowest = 0;
                                        $lowest = $match->bids->sortby('amount')->first();
                                    @endphp
                                    <div class="col">
                                        @isset($lowest->amount)
                                            {{ $lowest->amount }}
                                        @else
                                            0
                                        @endisset
                                    </div>
                                    <div class="col">Lowest bid</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col">
                                        <i class="far fa-question-circle text-primary"></i>
                                    </div>
                                    <div class="col">
                                        @if ($match->status == "live")
                                            <span class="badge badge-success">{{ $match->status }}</span>
                                        @else
                                           <span class="badge badge-warning">{{ $match->status }}</span> 
                                        @endif
                                    </div>
                                    <div class="col">Status</div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer row">
                            <div class="col text-left">
                                <small class="text-muted">Match Time: {{ Carbon\Carbon::parse($match->match_time)->format('d M Y h:i A') }}</small><br>
                                <small class="text-muted">updated: {{ Carbon\Carbon::parse($match->updated_at)->diffForHumans() }}</small>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('match.show',$match->id) }}" class="btn btn-large text-primary">
                                    <span class="fa-stack fa-1x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-cog fa-pulse fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop
@section('script')
    <script>
        let url = "{{route('match.import.refresh')}}";
        let matchUrl = "{{route('match.show',100)}}";

        setInterval(() => {
            fetchMatches();
        }, 15000);

        function fetchMatches(){
            $.get(url+"?json=true",function(data,status){
                
                if(status == "success"){

                    let liveMatches = 0;
                    let upcomingMatches = 0;
                    let row = "";

                    $.each(data.matches,function(index,match){

                        if(match.status == 'live'){
                            liveMatches++;
                        }

                        if(match.status == 'upcoming'){
                            upcomingMatches++;
                        }

                        let title = match.team1+ " V " + match.team2;
                        let bidCount = match.bids.length;
                        let highestAmount = match.bids.reduce((acc, bid) => acc = acc > bid.amount ? acc : bid.amount, 0);
                        let lowestAmount = match.bids.reduce((acc, bid) => acc = acc < bid.amount ? bid.amount : acc, 0);
                        let status = match.status;
                        let matchUrlFinal = matchUrl.replace('100',match.id);
                        let matchstatus = (match.status == 'live' ? `<span class="badge badge-success">Live</span>` : `<span class="badge badge-warning">`+match.status+`</span>`);
                        let single = setMatchDesign(title,bidCount,highestAmount,lowestAmount,matchstatus,matchUrlFinal,match.match_time,match.updated_at);
                        row += single;

                    });

                    $('#matches').empty();
                    $('#matches').html(row);
                    $('#live_count').html(liveMatches);
                    $('#upcoming_count').html(upcomingMatches);
                    
                }
            });
        }
        function setMatchDesign(title,bidCount,high,low,status,url,matchTime, updatedTime){
            return `
            <div class="col-sm-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">`+title+`</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-print"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-cash-register text-danger"></i></div>
                                    <div class="col">`+bidCount+`</div>
                                    <div class="col">bids</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-arrow-up text-success"></i></div>
                                    <div class="col">
                                        `+high+`
                                    </div>
                                    <div class="col">Highest bid</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col"><i class="fas fa-arrow-down text-danger"></i></div>
                                    
                                    <div class="col">
                                        `+low+`
                                    </div>
                                    <div class="col">Lowest bid</div>
                                </div>
                                <div class="col text-center">
                                    <div class="col">
                                        <i class="far fa-question-circle text-primary"></i>
                                    </div>
                                    <div class="col">
                                        `+status+`
                                    </div>
                                    <div class="col">Status</div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer row">
                            <div class="col text-left">
                                <small class="text-muted">Match Time: `+matchTime+`</small><br>
                                <small class="text-muted">updated: `+updatedTime+`</small>
                            </div>
                            <div class="col text-right">
                                <a href="`+url+`" class="btn btn-large text-primary">
                                    <span class="fa-stack fa-1x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-cog fa-pulse fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
@endsection
@section('plugin-css')
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('plugin')
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.6.3-web/js/all.min.css') }}">
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@stop