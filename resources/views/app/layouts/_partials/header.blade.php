<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin6">
            <a class="navbar-brand" href="{{ route('app.home') }}">
                <b class="logo-icon">
                    <img src="{{ asset('img/logo.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{ asset('img/logo.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    Super Gestão
                </span>
            </a>

            <a class="nav-toggler waves-effect waves-light d-block
                d-md-none"
                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

            <ul class="navbar-nav float-start me-auto">
                {{ auth()->user()->empresa->nome }}
            </ul>

            <ul class="navbar-nav float-end">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted
                        waves-effect waves-dark pro-pic"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=admin" alt="user" class="rounded-circle"
                            width="31">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end
                        user-dd animated"
                        aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('app.sair') }}">
                            <i class="mdi mdi-logout-variant m-r-5 m-l-5"></i>
                            Sair
                        </a>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
