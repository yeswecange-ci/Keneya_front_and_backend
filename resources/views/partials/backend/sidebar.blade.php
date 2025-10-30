<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard.homepage') }}">
            <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" />
            <span class="logo-name">KENAYA</span>
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Pages</li>
        <li class="dropdown {{ request()->routeIs('dashboard.homepage') ? 'active' : '' }}">
            <a href="{{ route('dashboard.homepage') }}" class="nav-link">
                <i data-feather="monitor"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.accueil') ? 'active' : '' }}">
            <a href="{{ route('dashboard.accueil') }}" class="nav-link">
                <i data-feather="home"></i><span>Accueil</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.about') ? 'active' : '' }}">
            <a href="{{ route('dashboard.about') }}" class="nav-link">
                <i data-feather="briefcase"></i><span>About</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.activities') ? 'active' : '' }}">
            <a href="{{ route('dashboard.activities') }}" class="nav-link">
                <i data-feather="command"></i><span>Activities</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.actualities') ? 'active' : '' }}">
            <a href="{{ route('dashboard.actualities') }}" class="nav-link">
                <i data-feather="copy"></i><span>Actualities</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.expert') ? 'active' : '' }}">
            <a href="{{ route('dashboard.expert') }}" class="nav-link">
                <i data-feather="copy"></i><span>Expert</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('dashboard.contact') ? 'active' : '' }}">
            <a href="{{ route('dashboard.contact') }}" class="nav-link">
                <i data-feather="grid"></i><span>Contact</span>
            </a>
        </li>
    </ul>
</aside>
