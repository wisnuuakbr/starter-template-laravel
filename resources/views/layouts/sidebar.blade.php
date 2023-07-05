<ul class="metismenu" id="side-menu">
    {{-- <li class="menu-title">Dashboard</li>
    <li>
        <a href="{{ route('home') }}" class="waves-effect">
            <i class="dripicons-meter"></i> <span> Dashboard </span>
            </span>
        </a>
    </li> --}}
    {{-- <li class="menu-title">Main</li>
    <li>
        <a href="#" class="waves-effect">
            <i class="mdi mdi-settings"></i><span> Settings <span class="float-right menu-arrow">
                    <i class="mdi mdi-chevron-right"></i></span></span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('users') }}">Management Users</a></li>
        </ul>
    </li> --}}

    @foreach (getMenus() as $menu)
        <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
            <a href="#" class="waves-effect">
                <i class="{{ $menu->icon }}"></i><span> {{ $menu->name }} <span class="float-right menu-arrow">
                        <i class="mdi mdi-chevron-right"></i></span></span>
            </a>
            <ul class="submenu {{ request()->segment(1) == $menu->url ? 'expand ' : '' }}">
                @foreach ($menu->subMenus as $submenu)
                    <li
                        class="{{ request()->segment(1) == 'users' && request()->segment(2) == 'users' ? 'active open' : '' }}">
                        <a href="{{ url($submenu->url) }}">{{ $submenu->name }}</a>
                    </li>
                @endforeach

            </ul>
        </li>
    @endforeach
</ul>
