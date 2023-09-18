<!-- Sidebar content -->
<div class="sidebar-content">

    <!-- User menu -->
    <div class="sidebar-section sidebar-user my-1">
        <div class="sidebar-section-body">
            <div class="media">
                <a href="#" class="mr-3">
                    <img src="{{ asset('img/user.png') }}" class="rounded-circle" alt="">
                </a>

                <div class="media-body">
                    <div class="font-weight-semibold">{{ auth()->user()->name }}</div>
                    <div class="font-size-sm line-height-sm opacity-50">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <div class="ml-3 align-self-center">
                    <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="icon-transmission"></i>
                    </button>

                    <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                        <i class="icon-cross2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /user menu -->


    <!-- Main navigation -->
    <div class="sidebar-section">
        <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="icon-home4"></i>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="nav-item nav-item-submenu {{ request()->is('category') || request()->is('category/*') || request()->is('waste') || request()->is('waste/*') ? 'nav-item-expanded nav-item-open' : '' }}">
                <a href="#" class="nav-link"><i class="icon-cube3"></i> <span>Master</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Master">
                    <li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link {{ request()->is('category') || request()->is('category/*') ? 'active' : '' }}">Jenis Sampah</a></li>
                    <li class="nav-item"><a href="{{ route('waste.index') }}" class="nav-link {{ request()->is('waste') || request()->is('waste/*') ? 'active' : '' }}">Sampah</a></li>
                </ul>
            </li>
            <!-- /main -->

        </ul>
    </div>
    <!-- /main navigation -->

</div>
<!-- /sidebar content -->