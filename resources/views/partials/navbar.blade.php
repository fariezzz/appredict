<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="/">
            Appredict
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-white {{ Request::is('tentang*') ? 'active' : '' }}"
                        href="/tentang">Tentang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
