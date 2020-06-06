<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Bake</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">Bk</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">
                {{ baketranslate('navigation', 'en') }}
            </li>
            <li @if(is_current_route('dashboard')) class="active" @endif>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @foreach(bake()->menus() as $group => $menus)
                <li class="menu-header">
                    {{ baketranslate($group, 'en') }}
                </li>
                @foreach($menus as $menu)
                    <li @if(is_current_route($menu->route)) class="active" @endif>
                        <a class="nav-link" href="{{ route($menu->route) }}">
                            <i class="fas {{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
