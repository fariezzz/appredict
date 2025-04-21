<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand brand fw-bold text-white ms-4" href="/">
            AP<span style="color: darkgray">PREDICT</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a class="nav-link fw-semibold text-white {{ Request::is('/prediksi') ? 'active' : '' }}" href="/prediksi">Prediksi</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link fw-semibold text-white" href="https://wa.me/6281573681874?text=Hai,%20Appredict!" target="_blank" rel="noopener">Kontak</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link fw-semibold text-white {{ Request::is('/tentang') ? 'active' : '' }}"
                        href="/tentang">Tentang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
