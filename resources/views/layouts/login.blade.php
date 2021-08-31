<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    @yield('style')

    <style type="text/css">
      .reg{
          padding-top: 20px;
          padding-bottom: 60px;
              background-color: #0A2940;
    border-bottom: 2px solid #000;;
        }
 @media (min-width: 400px) and (max-width: 498px){
    .navbar {    
     min-height: 0px;
    }  
}
  
    </style>
</head>
<body>
  @include('layouts.header')
  @include('layouts.nav')
  @include('layouts.breadcrumb')
 <section class="reg">      
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form action="/action_page.php">
          <div class="form-group">
            <input type="username" class="form-control" id="name" placeholder="User Name">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="pwd" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary" style="margin-left: 155px;">Login</button>

          <div style="padding-top: 10px;">
                      <a href="#">
                        <label style="cursor: pointer;color: #EAF607;">Forgot Password</label>
                      </a> 
                      <a href="#" class="pull-right">
                        <label style="cursor: pointer; color: #EAF607;">Register</label>
                      </a>
                   </div>
        </form>
          </div>
      </div>
  </div>
 </section>
@include('layouts.footer')
</body>
</html>
