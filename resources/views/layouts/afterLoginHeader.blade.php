
  <style type="text/css">
    :focus {
    outline: -webkit-focus-ring-color auto 0px;
}
    .uper-nav{
      background-color: #0C4570/*2A2A2A*/; 
    }
    .badge {
      display: inline-block;
      padding: 3px 8px;
      font-family: "Kanit", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      font-size: 12px;
      font-weight: 600;
      line-height: 14px;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
      background: #e1e1e1;
      border-radius: 4px;
      margin-top: 5px;
      margin-bottom: 20px;
    }
    .badge-primary {
      background: #64b000;
      border: 0;
    }
    .form-control-cust {
      border: 2px solid #ffffff;
      border-radius: 7px;
      padding: 4px;
      font-size: 14px;
      line-height: 1.25;
      margin-top: 20px;
      background-color: #000;
    }
    .logo{
      margin-left: 300px;
    }
    .balance{
      margin-left: 250px;
      margin-top: 20px;
    }
    .user_balance_field{
      color: #fff;
    }

    @media (min-width: 400px) and (max-width: 498px) {
     .logo{
       margin-left: 0px;
      }
      .balance {
        margin-left: 250px;
        margin-top: -55px;
      }
    }

    @media (min-width: 375px) and (max-width: 812px) {
      .logo{
       margin-left: 0px;
      }
      .balance {
        margin-left: 135px;
        margin-top: -55px;
      }
    }

 @media (min-width: 576px) and (max-width: 767px) {
    .balance {margin-left: 250px;}

  }
  </style>

  <section class="navAndhead">
    <div class="uper-nav">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <a class="logo" href="#"><img src="{{ asset('img/logo.png') }}" alt="" width="100" height="80" style="margin-top: 0px;"></a>
          </div>
          <div class="col-md-6">
            <div class="balance">
              <a href="">
                <img style="height: 25px;
                " src="{{ asset('img/coins.png') }}"> <span style="color: #58f905">{{ $credit }}
                </span>
              </a>
              <p class="user_balance_field">Welcome, <span>{{ Auth::user()->name }}</span></p>
            </div>              
          </div>
        </div>
      </div>      
    </div>


  </section>
