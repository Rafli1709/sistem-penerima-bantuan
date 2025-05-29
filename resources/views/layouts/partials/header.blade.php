<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="{{ route('dashboard') }}" class="b-brand">
            <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ asset('images/profile-user.png') }}" class="img-radius"
                                alt="User-Profile-Image">
                            <span>{{ auth()->user()->name }}</span>
                            <form id="logoutForm" action="{{ route('logout') }}" method="post">
                                @csrf
                                <a onclick="document.getElementById('logoutForm').submit();" class=" dud-logout"
                                    title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </form>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{ route('profile.change-password') }}" class="dropdown-item"><i
                                        class="feather icon-lock"></i> Ubah Password</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
