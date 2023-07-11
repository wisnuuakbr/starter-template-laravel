<ul class="metismenu" id="side-menu">
    {{-- TODO: all data get from myHelper --}}
    @foreach (getMenus() as $menu)
        @if ($menu->display_st == 1)
            {{-- Check display_st value for the menu --}}
            <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
                <a href="{{ url($menu->url) }}" class="waves-effect">
                    <i class="{{ $menu->icon }}" style="font-size: 18px"></i><span> {{ $menu->name }}
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
                            @if ($submenu->display_st == 1)
                                {{-- Check display_st value for the submenu --}}
                                <li
                                    class="{{ request()->segment(1) == 'users' && request()->segment(2) == 'users' ? 'active open' : '' }}">
                                    <a href="{{ url($submenu->url) }}">{{ $submenu->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>
