<nav class="navbar navbar-expand-lg bg-principal static-top">
    <div class="container">
        <a class="navbar-brand" href="">
        <img src="{{ asset('img/logo.png') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"
            aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.sobrenos') }}">Sobre Nós</a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>