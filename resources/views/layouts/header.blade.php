

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
        .badge:hover{
            text-decoration: none;
            background-color: #000 !important;
            border-radius: 10px !important;
            color: #fff;
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

        @media (min-width: 400px) and (max-width: 498px){
        .logo{
            margin-left: 0px;
        }
    }
        @media (min-width: 375px) and (max-width: 812px){
        .logo{
            margin-left: 0px;
        }
    }
    </style>

<section class="navAndhead">
  <div class="uper-nav">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <a class="logo" href="{{ route('index') }}"><img src="img/logo.png" alt="" width="100" height="80" style="margin-top: 0px;"></a>
        </div>
        <div class="col-md-6">

          <form method="post" action="{{ route('login') }}"  name="loginform" role="form" accept-charset="utf-8">
            @csrf
            <input placeholder="Username" name="email" class="form-control-cust" type="text" autofocus="">
            <input placeholder="Password" name="password" class="form-control-cust" type="password" value="">
            <br>
            <button class="badge badge-primary text-light" type="submit" style="background-color: #005184">Login</button>
            {{-- <a class="badge badge-primary" style="background-color: #005184" href="{{ route('login') }}">Login</a> --}}
            <a class="badge badge-primary" style="background-color: #005184" href="{{ route('register') }}">Join Now</a>
          </form>

        </div>
      </div>
    </div>
  </div>


</section>
