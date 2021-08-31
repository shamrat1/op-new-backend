@extends('layouts.master-auth')
@section('title','All Withdraws')

@section('content')
 <section class="whistory">      
  <div class="container">
  <div class="row card rounded elevation accent_bg my-3">
           <div class="card-body col-md-6 col-md-offset-3">
           <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Withdraws</h5>
                  </div>
              </div>
          <table class="table table-responsive">
            <thead>
              <tr>
                <th scope="col">Submitted</th>
                <th scope="col">Coin</th>
                <th scope="col">To</th>
                <th scope="col">Sender</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($withdraws as $item)
                <tr>
                  <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                  <td>{{ $item->amount }}</td>
                  <td>{{ $item->mobile }}</td>
                  <td>{{ $item->backend_mobile }}</td>
                  <td>{{ $item->status }}
                      @if ($item->status == "accepted")
                      <br>
                          <small class="text-muted">Payment request accepted. Will be sent in a moment.</small>
                      @endif
                  </td>
                  <td>
                    @if($item->status == "pending")
                      <form action="{{ route('transactions.refund') }}" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->id }}">
                          <button class="btn btn-primary">Refund</button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
 </section>
@endsection
