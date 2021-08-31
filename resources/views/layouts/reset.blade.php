<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    @yield('style')

    <style type="text/css">
        .uper-nav{
            background-color: #2A2A2A; 
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
        border: 2px solid #a0d87e;
        border-radius: 7px;
        padding: 4px;
        font-size: 14px;
        line-height: 1.25;
        margin-top: 20px;
     }
    .logo{
        margin-left: 300px;
    }

	   .reset{
        	padding-top: 20px;
        	padding-bottom: 60px;
        	background-color: #0A2940;
        }

      .design{
        color: #fff;
        border: 1px solid #25ddc5;
        border-radius: 25px;
        margin-bottom: 100px;
        margin-top: 100px;
      }
      
    </style>
</head>
<body>
  @include('layouts.header')
  @include('layouts.nav')
  <!-- @include('layouts.breadcrumb') -->
 <section class="reset">      
	<div class="container">
    	<div class="row">
       		<div class="col-md-4 col-md-offset-4 design">
            <p style="font-size: 25px;text-align: center;">Reset Password</p>
            <form action="#">
    					<div class="form-group">
                <p>Enter your email:</p>
    				    <input type="email" class="form-control" id="email" placeholder="Email">
    				  </div>
				      <button type="submit" class="btn btn-primary" style="margin-left: 130px;">SUBMIT</button>
				    </form>
       		</div>
    	</div>
	</div>
 </section>
@include('layouts.footer')
</body>
</html>
