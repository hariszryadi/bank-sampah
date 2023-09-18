<div class="d-flex flex-1 d-lg-none">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
        <i class="icon-paragraph-justify3"></i>
    </button>
    <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
        <i class="icon-transmission"></i>
    </button>
</div>

<div class="navbar-brand text-center text-lg-left">
    <a href="" class="d-inline-block">BANK SAMPAH</a>
</div>

<div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">

    <ul class="navbar-nav ml-lg-auto">
        <li class="nav-item dropdown">
        </li>
    </ul>
</div>

<ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
    <li class="nav-item nav-item-dropdown-lg dropdown">
    </li>

    <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
        <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
            <img src="{{ asset('img/user.png') }}" class="rounded-pill mr-lg-2" height="34" alt="">
            <span class="d-none d-lg-inline-block">{{ auth()->user()->name }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>