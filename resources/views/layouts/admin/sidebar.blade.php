<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="/assets/img/boy.png">
        </div>
        <div class="sidebar-brand-text mx-3">Aplikasi Pembelajaran</div>
    </div>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item {{ request()->is('chapter*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('chapter.index') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Chapter</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('module*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('module.index') }}">
            <i class="fas fa-fw fa-atlas"></i>
            <span>Module</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('informasi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('informasi.index') }}">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Informasi</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item {{ request()->is('student*') || request()->is('user*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>User</span>
        </a>
        <div id="collapseBootstrap"
            class="collapse  {{ request()->is('user*') ? 'show' : '' }} || {{ request()->is('student*') ? 'show' : '' }} "
            aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Bootstrap UI</h6> --}}
                <a class="collapse-item {{ request()->is('user*') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">All
                    User</a>
                <a class="collapse-item {{ request()->is('student*') ? 'active' : '' }}"
                    href="{{ route('student.index') }}">Mahasiswa</a>
            </div>
        </div>
    </li>

</ul>
