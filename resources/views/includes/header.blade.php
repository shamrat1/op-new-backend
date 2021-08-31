
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <!-- User Account: style can be found in dropdown.less -->
    <li class="nav-item dropdown" style="margin-top:4px;">
        <a href="#" class="user dropdown-toggle" data-toggle="dropdown" style="margin:10px;">

            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" style="height:33.33px; margin-right:5px;" class="img-circle elevation-2" alt="User Image">
            <span class="hidden-xs">{{ Auth()->user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="user-header">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-cir" alt="User Image">
                <p>
                    {{ Auth()->user()->name }} - 
                    @foreach (Auth()->user()->roles as $item)
                        <span class="badge">{{ $item->name }}</span>
                    @endforeach <br>
                    <small>Member since Nov. 2012</small>
                </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                    </div>
                </div>
                <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-default btn-flat">Sign out</button>

                    </form>
                </div>
            </li>
        </ul>
    </li>



    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
        </li>
    </ul>
