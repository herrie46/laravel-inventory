<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{(Request::segment(1)=='dashboard')?'active':''}}"
                href="{{ url('/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{(Request::segment(1)=='master')?'active':''}}"
            href="{{ url('/master')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></i></div>
                Master Data
            </a>
            <a class="nav-link {{(Request::segment(1)=='stok-masuk')?'active':''}}"
            href="{{ route('stok-masuk')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></i></div>
                Stok Masuk
            <a class="nav-link {{(Request::segment(1)=='stok-keluar')?'active':''}}"
            href="{{ route('stok-keluar')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-dolly"></i></i></div>
                Stok Keluar
            <a class="nav-link {{(Request::segment(1)=='trashmaster')?'active':''}}"
            href="{{ url('/trashmaster')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-trash"></i></i></div>
                Trash Master Data
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{Auth::user()->name}}
    </div>
</nav>
