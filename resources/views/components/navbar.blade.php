<div class="navbar-bg"></div>
<div class="navbar-fixed-bg position-fixed"></div>
<nav class="navbar navbar-expand-lg main-navbar position-fixed">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <div class="search-header">
                    Histories
                </div>
                <div class="search-item">
                    <a href="#">How to hack NASA using CSS</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">Kodinger.com</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">#Stisla</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-header">
                    Result
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="vendor/bake/assets/img/products/product-3-50.png"
                             alt="product">
                        oPhone S9 Limited Edition
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="vendor/bake/assets/img/products/product-2-50.png"
                             alt="product">
                        Drone X2 New Gen-7
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="vendor/bake/assets/img/products/product-1-50.png"
                             alt="product">
                        Headphone Blitz
                    </a>
                </div>
                <div class="search-header">
                    Projects
                </div>
                <div class="search-item">
                    <a href="#">
                        <div class="search-icon bg-danger text-white mr-3">
                            <i class="fas fa-code"></i>
                        </div>
                        Stisla Admin Template
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <div class="search-icon bg-primary text-white mr-3">
                            <i class="fas fa-laptop"></i>
                        </div>
                        Create a new Homepage Design
                    </a>
                </div>
            </div>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown"
               class="nav-link notification-toggle nav-link-lg">
                <i class="far fa-flag">
                    <small>{{ bakelang() }}</small>
                </i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    {{ baketranslate('language', 'en') }}
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @foreach(DB::table('languages')->orderBy('name')->get() as $language)
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon bg-info text-white">
                                <i class="far fa-flag"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                {{ $language->name }}
                                <div class="time">{{ $language->id }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="dropdown-footer">
                    <small>
                        {{ baketranslate('click flag to change language', 'en') }}
                    </small>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                     src="vendor/bake/assets/img/avatar/avatar-1.png"
                     class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    {{ baketranslate('hi', 'en') }}, {{ Auth::user()->name }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ Auth::user()->email }}</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{ baketranslate('profile', 'en') }}
                </a>
                <a href="{{ url('') }}" class="dropdown-item has-icon">
                    <i class="fas fa-home"></i> {{ baketranslate('home', 'en') }}
                </a>
                <div class="dropdown-divider"></div>
                <livewire:auth.logout/>
            </div>
        </li>
    </ul>
</nav>
