<ul class="metismenu" id="side-menu">
    @foreach (getMenus() as $menu)
        <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
            <a href="{{ url($menu->url) }}" class="waves-effect">
                <i class="{{ $menu->icon }}"></i><span> {{ $menu->name }}
                    @if (count($menu->subMenus) > 0)
                        <span class="float-right menu-arrow">
                            <i class="mdi mdi-chevron-right"></i>
                        </span>
                    @endif
                </span>
            </a>
            @if (count($menu->subMenus) > 0)
                <ul class="submenu {{ request()->segment(1) == $menu->url ? 'expand ' : '' }}">
                    @foreach ($menu->subMenus as $submenu)
                        <li
                            class="{{ request()->segment(1) == 'users' && request()->segment(2) == 'users' ? 'active open' : '' }}">
                            <a href="{{ url($submenu->url) }}">{{ $submenu->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
