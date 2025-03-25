<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="{{ asset('img/icon-deal.png') }}" alt="Icon"
                    style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">Makaan</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('main') }}"
                    class="nav-item nav-link {{ request()->routeIs('main') ? 'active' : '' }}">Bosh sahifa</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Biz kim</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mulk</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('property_list') }}"
                            class="dropdown-item {{ request()->routeIs('property_list') ? 'active' : '' }}">Mulklar
                            Ro'yhati</a>
                        <a href="{{ route('property_type') }}"
                            class="dropdown-item {{ request()->routeIs('property_type') ? 'active' : '' }}">Mulk
                            Turlari</a>
                        <a href="{{ route('property_agent') }}"
                            class="dropdown-item {{ request()->routeIs('property_agent') ? 'active' : '' }}">Mulk
                            Agenti</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Aloqa</a>
            </div>

            @auth
                <div class="dropdown">
                    <a href="#" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        <!-- Profile tugmasi -->
                        @if (Auth::check() && Auth::user()->role_id == 2)
                            <a href="{{ route('agent.dashboard') }}" class="dropdown-item">Profile</a>
                        @elseif (Auth::check() && Auth::user()->role_id == 3)
                            <a href="{{ route('user.dashboard') }}" class="dropdown-item">Profile</a>
                        @endif

                        <!-- Logout tugmasi -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary px-3 me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary px-3">Register</a>
            @endauth
        </div>
    </nav>
</div>
