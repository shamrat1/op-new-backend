@extends('layouts.master-auth')
@section('title','Statement')
@push('style')
  <style>
    .page-item,.active{
      background-color: #9f7c37 !important;
      color: white !important;
    }
  </style>
@endpush
@section('content')
  <section class="history">
  <div class="container">
  <div class="row card rounded elevation accent_bg my-3">
           <div class="card-body col-12">
           <div class="mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Statements</h5>
                  </div>
              </div>
              @if(!\Jenssegers\Agent\Facades\Agent::isMobile())
            <table class="table table-responsive">
            <thead>
              <tr>
                <th scope="col-sm-3">Date & Time</th>
                <th scope="col-sm-3">Username</th>
                <th scope="">From</th>
                <th scope="">To</th>
                <th scope="col">Amount</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transactions as $item)
                  <tr>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                    @if(request()->route()->uri === "club/statement")
                      <td>{{ $item->username }}</td>
                    @else
                      <td>{{ $item->sponsered_by }}</td>
                    @endif
                      // from
                      @if($item->type == 'deposit')
                          <td>{{ $item->mobile }}</td>
                      @elseif($item->type == 'withdraw')
                          <td>{{ $item->backend_mobile }}</td>
                      @else
                          <td></td>
                      @endif

                      // to
                      @if($item->type == 'deposit')
                          <td>{{ $item->backend_mobile }}</td>
                      @elseif($item->type == 'withdraw')
                          <td>{{ $item->mobile }}</td>
                      @else
                          <td></td>
                      @endif
                    <td>
                      {{ $item->amount }}
                    </td>
                      <td>{{ucwords($item->type)}}</td>
                    <td>{{ucfirst($item->status)}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
              @else
                  <table class="table table-responsive text-center">
                      <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Purpose</th>
                            @if(request()->route()->uri === "club/statement")
                                <th>Username</th>
                            @endif
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                      </thead>
                      <tbody style="font-size: 9pt;">
                      @foreach ($transactions as $item)
                          <tr>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                              <td>{{ucwords($item->type)}}</td>
                              @if(request()->route()->uri === "club/statement")
                                  <td>{{$item->username}}</td>
                              @endif
                              <td>{{$item->amount}}</td>
                              <td>{{$item->status}}</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              @endif
              {{$transactions->links()}}
          </div>
       </div>
  </div>
</section>
@endsection
