<ul class="navbar-right d-flex list-inline float-right mb-0">

    <li class="list-inline-item dropdown notification-list">
        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="mdi mdi-bell-outline noti-icon"></i>
            <span class="badge badge-info badge-pill noti-icon-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-arrow dropdown-menu-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5>Notification (3)</h5>
            </div>

            <div class="slimscroll-noti">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                            text of the printing and typesetting
                            industry.</span></p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                    </div>
                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                            have 87 unread messages</span></p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It
                            is a long established fact that a reader will</span></p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i>
                    </div>
                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                            have 87 unread messages</span></p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the
                            printing and typesetting
                            industry.</span></p>
                </a>
            </div>
            <!-- All-->
            <a href="javascript:void(0);" class="dropdown-item notify-all">
                View All
            </a>

        </div>
    </li>

    {{-- * USER DATA --}}

    <li class="list-inline-item dropdown notification-list">
        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ asset('style') }}/assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle">
            <span class="d-none d-md-inline-block ml-1">{{ Auth::user()->user_name }} <i class="mdi mdi-chevron-down"></i>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i>
                Profile</a>
            {{-- <div class="dropdown-divider"></div> --}}
            <a class="dropdown-item"
                href="{{ route('logout') }}"onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i
                    class="dripicons-exit text-muted"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>

<ul class="list-inline menu-left mb-0">
    <li class="float-left">
        <button class="button-menu-mobile open-left waves-effect">
            <i class="mdi mdi-menu"></i>
        </button>
    </li>
</ul>
