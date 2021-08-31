<!-- Brand Logo -->
<a href="{{ url('/') }}" class="brand-link">
    <img src="{{ asset('images/site-assets/worlb bet@2x.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">world bet 365</span>
</a>

<!-- Sidebar -->
<div class="sidebar nano">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview {{ active(['/','admin']) }}">
            <a href="{{ route('admin') }}" class="nav-link {{ active(['/','admin']) }}">
                    <i class="nav-icon fas fa-chart-line text-warning"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @role(['admin','admin1'])
            <li class="nav-item has-treeview {{ active('admin/user') }}">
                <a href="{{ route('user.index') }}" class="nav-link {{ active('admin/user') }}">
                    <i class="nav-icon fas fa-users text-success"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ active(['admin/deposit']) }}">
                <a href="{{ route('deposit.index') }}" class="nav-link {{ active(['admin/deposits']) }}">
                    <i class="nav-icon fas fa-money-bill text-success"></i>
                    <p>Deposits</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ active(['admin/withdraw']) }}">
                <a href="{{ route('withdraw.index') }}" class="nav-link {{ active(['admin/withdraws','admin/withdraws*']) }}">
                    <i class="nav-icon fas fa-money-bill text-danger"></i>
                    <p>Withdraw</p>
                </a>
            </li>
            
            <li class="nav-item has-treeview {{ active(['admin/gifts']) }}">
                <a href="{{ route('gift.index') }}" class="nav-link {{ active(['admin/gifts','admin/gifts*']) }}">
                    <i class="nav-icon fas fa-gift text-warning"></i>
                    <p>Gift</p>
                </a>
            </li>
            
            <li class="nav-item has-treeview {{ active(['admin/club*']) }}">
                <a href="{{ route('club.index') }}" class="nav-link {{ active(['admin/club*']) }}">
                    <i class="nav-icon fab fa-fort-awesome text-white"></i>
                    <p>Club</p>
                </a>
            </li>
            @endrole
            @role('admin')
                <li class="nav-item has-treeview {{ active(['admin/report*']) }}">
                    <a href="#" class="nav-link {{ active(['admin/report*']) }}">
                        <i class="nav-icon fa fa-bar-chart text-white"></i>
                        <p>Reports<i class="fas fa-angle-left right"></i> </p>
                    </a>
                        
                        <ul class="nav nav-treeview" >
                            <li class="nav-item {{ active('admin/report/users') }}">
                            <a href="{{ route('report.user') }}" class="nav-link {{ active('admin/report/users') }}">
                                <i class="nav-icon fa fa-user text-white"></i>
                                <p>User Reports</p>
                            </a>
                            </li>
                            <li class="nav-item {{ active('admin/report/bet') }}">
                                <a href="{{ route('report.bet') }}" class="nav-link {{ active('admin/report/bet') }}">
                                    <i class="nav-icon fas fa-hashtag text-danger"></i>
                                    <p>Betting Reports</p>
                                </a>                                                                                                              
                            </li>
                            <li class="nav-item {{ active('admin/report/transaction') }}">
                                <a href="{{ route('report.transaction') }}" class="nav-link {{ active('admin/report/transaction') }}">
                                    <i class="nav-icon fas fa-dollar text-primary"></i>
                                    <p>Transaction Reports</p>
                                </a>
                            </li>
                        </ul>
                </li>
            @endrole
            @role(['Editor','admin1'])
            <li class="nav-item has-treeview {{ active(['admin/tournaments*']) }}">
                <a href="#" class="nav-link {{ active(['admin/tournaments*']) }}">
                    <i class="nav-icon fas fa-trophy text-warning"></i>
                    <p> Tournament<i class="fas fa-angle-left right"></i> </p>
                </a>

                <ul class="nav nav-treeview" >
                    <li class="nav-item has-treeview {{ active('admin/tournaments') }}">
                        <a href="{{ route('tournaments.index') }}" class="nav-link {{ active('admin/tournaments') }}">
                            <i class="fas fa-list text-white"></i>
                            <p>All Tournaments</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item has-treeview {{ active('/add') }}">
                        <a href="#" class="nav-link {{ active('/add') }}">
                            <i class="fas fa-edit"></i>
                            <p>Edit Tournament<i class="fas fa-angle-left right"></i> </p>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <li class="nav-item has-treeview {{ active(['admin/match*']) }}">
                <a href="#" class="nav-link {{ active(['admin/match*']) }}">
                    <i class="nav-icon fas fa-futbol fa-pulse text-white"></i>
                    <p>Match<i class="fas fa-angle-left right"></i> </p>
                </a>
                    
                    <ul class="nav nav-treeview" >
                        <li class="nav-item {{ active('admin/match') }}">
                        <a href="{{ route('match.index') }}" class="nav-link {{ active('admin/match') }}">
                            <i class="fas fa-list text-white"></i>
                            <p>Matches </p>
                        </a>
                        </li>
                        <li class="nav-item {{ active('admin/match/create') }}">
                            <a href="{{ route('match.create') }}" class="nav-link {{ active('admin/match/create') }}">
                                <i class="fas fa-plus"></i>
                                <p>New Match</p>
                            </a>
                        </li>
                    </ul>
            </li>

                
                {{-- @endif --}}

                <li class="nav-item has-treeview {{ active(['admin/bet*']) }}">
                    <a href="#" class="nav-link {{ active(['admin/bet*']) }}">
                        <i class="nav-icon fab fa-bitcoin text-warning"></i>
                        <p>Bet<i class="fas fa-angle-left right"></i> </p>
                    </a>
                    
                    <ul class="nav nav-treeview" >
                        <li class="nav-item {{ active('admin/bet') }}">
                            <a href="{{ route('bet.index') }}" class="nav-link {{ active('admin/bet') }}">
                                <i class="fas fa-list text-white"></i>
                                <p>All Bets<i class="fas fa-angle-left right"></i> </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item has-treeview {{ active('/match/add') }}">
                            <a href="{{ route('match.create') }}" class="nav-link {{ active('/match/add') }}">
                                <i class="fas fa-plus"></i>
                                <p>New Match<i class="fas fa-angle-left right"></i> </p>
                            </a>
                        </li> --}}
                    </ul>
                </li>


            <li class="nav-item has-treeview {{ active(['admin/banners*']) }}">
                <a href="#" class="nav-link {{ active(['admin/banners*']) }}">
                    <!-- <i class="nav-icon fas fa-futbol fa-pulse text-white"></i> -->
                    <i class="nav-icon fas fa-film text-warning"></i>
                    <p>Banner<i class="fas fa-angle-left right"></i> </p>
                </a>
                    
                    <ul class="nav nav-treeview" >
                        <li class="nav-item {{ active('/banners/addbanner') }}">
                        <a href="{{ route('banners.addbanner') }}" class="nav-link {{ active('/banners/addbanner') }}">
                             <i class="nav-icon fas fa-plus"></i>
                            <p>Add Banner </p>
                        </a>
                        </li>
                    </ul>
            </li>
                @endrole
                <li class="nav-item has-treeview {{ active(['admin/setting*']) }}">
                <a href="{{ route('setting') }}" class="nav-link {{ active(['admin/setting*']) }}">
                    <i class="nav-icon fas fa-cogs text-danger"></i>
                    <p>Setting</p>
                </a>
                </li>
                <!-- <li class="nav-item has-treeview">
                    <a href="{{ route('send.mail') }}" class="nav-link ">
                        <i class="nav-icon fas fa-mail-bulk text-success"></i>
                        <p>Send Mails<br><small class="text-muted">Send Queued Mails</small></p>
                        
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('send.failed') }}" class="nav-link ">
                        <i class="nav-icon fas fa-mail-bulk text-danger"></i>
                        <p>Retry<br><small class="text-muted">Send failed Mails</small></p>
                        
                    </a>
                </li> -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class=" border-0 btn-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                          Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
