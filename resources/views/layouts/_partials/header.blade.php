<!-- Required meta tags -->
<meta charset="utf-8">
    <link rel="icon" type="image/svg+xml" href="{{url('/favicon.svg')}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" integrity="sha512-X/RSQYxFb/tvuz6aNRTfKXDnQzmnzoawgEQ4X8nZNftzs8KFFH23p/BA6D2k0QCM4R0sY1DEy9MIY9b3fwi+bg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" integrity="sha512-f28cvdA4Bq3dC9X9wNmSx21rjWI+5piIW/uoc2LuQ67asKxfQjUow2MkcCNcfJiaLrHcGbed1wzYe3dlY4w9gA==" crossorigin="anonymous" />

    <!-- slick-carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />

    <!-- Font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    @stack('plugin-css')
    <title>OnPlay365 | @yield('title')</title>
    <style>
        body{
            background-color: rgb(0, 0, 0);
        }
        .accent_bg{
            background-color: #2e2e2e !important;
            color: white !important;
        }
        .navbar-brand{
            color: white !important;
            font-family: 'Impact', cursive;
            font-size: 25px;
        }
        .action_accent{
            background-color: #9f7c37;
        }
        .highlight_text{
            color: #9f7c37;
        }
        .inactive_accent{
            background-color: #969696;
        }
        .default_text{
            color: white !important;
            font-size: 11px;
        }
        .nav-link{
            color: white !important;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        .navbar-toggler{
            background-color: #9f7c37 !important;
        }
        .clock {
            position: absolute;
            top: 35%;
            left: 35%;
            transform: translateX(-50%) translateY(-50%);
            color: #fe1723;
            font-size: 12px;
            font-family: Orbitron;
            letter-spacing: 2px;
        }
        .slick_text{
            font-size: 9px;
        }
        .hidden{
            display: none;
        }
        .blur{
              /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .loader{
            margin: auto;
            width: 50%;
        }
        .lds-ripple {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        }
        .lds-ripple div {
        position: absolute;
        border: 4px solid #fff;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
        }
        @keyframes lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }
        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
        }

    </style>
    @stack('style')