<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appredict</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Special+Gothic+Condensed+One&display=swap');

        .brand {
            font-family: "Special Gothic Condensed One", sans-serif !important;
            font-weight: 400 !important;
            font-style: normal !important;
            font-size: 25px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            color: #ffffff
        }

        .hero {
            padding: 230px 0;
            text-align: center;
            background: #ffffff;
            color: rgb(0, 0, 0);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 600;
        }

        .hero p {
            font-size: 1.25rem;
        }

        .feature-icon {
            font-size: 3rem;
            color: #ffffff;
        }

        footer {
            background-color: #434141;
            color: #ffffff;
            padding: 40px 0;
        }

        footer a {
            color: #adb5bd;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div>
        <main>
            @include('partials.navbar')
            <section class="hero">
                <div class="container">
                    <h1 class="brand">
                        <span id="typedBrand"></span>
                    </h1>                    
                    <p>Platform cerdas untuk prediksi harga iPhone di masa depan dan rencana menabung.</p>
                    <a href="/prediksi" class="btn btn-secondary mt-2 btn-lg"><i class="bi bi-arrow-right-circle"></i>
                        Mulai Prediksi</a>
                </div>
            </section>

            <section class="py-5">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-6 my-3">
                            <i class="bi bi-cash-coin feature-icon"></i>
                            <h5 class="mt-3">Prediksi Harga</h5>
                            <p>Dapatkan estimasi harga iPhone di tahun mendatang secara akurat.</p>
                        </div>
                        <div class="col-md-6 my-3">
                            <i class="bi bi-graph-up feature-icon"></i>
                            <h5 class="mt-3">Grafik Harga</h5>
                            <p>Analisis tren harga dari tahun ke tahun dengan grafik interaktif.</p>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                <div class="container text-center">
                    <p class="mb-1">&copy; 2025 Appredict. All rights reserved.</p>
                    <div>
                        <a href="/tentang">Tentang</a> |
                        <a href="https://wa.me/6281573681874?text=Hai,%20Appredict!" target="_blank" rel="noopener">
                            Kontak
                        </a>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Typed("#typedBrand", {
            strings: [
                'AP<span style="color:darkgray">PREDICT</span>',
            ],
            typeSpeed: 50,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            smartBackspace: true
        });
    });
</script>


</html>
