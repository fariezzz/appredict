<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand brand fw-bold text-white ms-4" href="/">
            AP<span style="color: darkgray">PREDICT</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-1"></i>
            </button>            
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a class="ms-4 nav-link fw-semibold text-white {{ Request::is('/prediksi') ? 'active' : '' }}" href="/prediksi"><i class="bi bi-graph-up me-1 navbar-icons"></i> Prediksi</a>
                </li>
                <li class="nav-item me-4">
                    <a class="ms-4 nav-link fw-semibold text-white {{ Request::is('/histori') ? 'active' : '' }}" href="/histori"><i class="bi bi-clock-history me-1 navbar-icons"></i> Histori</a>
                </li>
                <li class="nav-item me-4">
                    <a class="ms-4 nav-link fw-semibold text-white" data-bs-toggle="modal" data-bs-target="#helpModal"><i class="bi bi-question-circle me-1 navbar-icons"></i> Bantuan</a>
                </li>
                <li class="nav-item me-4">
                    <a class="ms-4 nav-link fw-semibold text-white {{ Request::is('/tentang') ? 'active' : '' }}" href="/tentang"><i class="bi bi-info-circle me-1 navbar-icons"></i> Tentang</a>
                </li>
                {{-- <li class="nav-item me-1">
                    <a class="ms-4 nav-link fw-semibold text-white" href="https://wa.me/6281573681874?text=Hai,%20Appredict!" target="_blank" rel="noopener"><i class="bi bi-whatsapp me-1 navbar-icons"></i> Kontak</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
