@extends('layouts.master-auth')
@section('title','All Transactions')

@section('content')
 <section class="dhistory">      
  <div class="container">
  <div class="row card rounded elevation accent_bg my-3">
      <div class="card-body col-md-4 col-md-offset-4">
      <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Deposit History</h5>
                  </div>
              </div>
          <table class="table table-responsive">
            <thead>
              <tr>
                <th scope="col">Date & Time</th>
                <th scope="col">Mobile</th>
                <th scope="col">Sent To</th>
                <th scope="col">Amount</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($deposits as $item)
                <tr>

                  <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                  <td>{{ $item->mobile }}</td>
                  <td>{{ $item->backend_mobile }}</td>
                  <td>{{ $item->amount }}</td>
                  <td>{{ $item->payment_method }}</td>
                  <td>{{ $item->status }}</td>
                </tr>
              @endforeach
            </tbody>
            
          </table>
      </div>
  </div>
 </section>
@endsection
