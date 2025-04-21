@extends('layouts.main')

@section('container')
    <div class="container about-page mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="mb-4">Tentang Kami</h1>
                <p class="lead">
                    Appredict adalah platform prediksi harga iPhone berbasis data historis dan algoritma matematis.
                    Kami hadir untuk membantu pengguna dalam merencanakan pembelian iPhone secara cerdas dengan
                    melihat tren harga dari tahun ke tahun.
                </p>
                <p>
                    Dengan memanfaatkan teknologi web dan visualisasi data, kami percaya bahwa informasi yang tepat
                    dapat membantu Anda membuat keputusan finansial yang lebih baik. Appredict dikembangkan oleh tim
                    muda dengan semangat teknologi dan inovasi.
                </p>
                <p class="fst-italic">“Prediksi lebih bijak, beli lebih cermat.”</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-5 mb-4 d-flex align-items-stretch">
            <div class="team-card text-center p-3 w-100">
                <img src="{{ asset('images/fariez.jpg') }}" class="team-photo mb-3" alt="Foto Fariez" style="object-position: 100% 80%;">
                <h5>Muhammad Fariez Riziq Ilham</h5>
                <p class="mb-1 text-muted">247006111146</p>
                <p class="text-muted">Universitas Siliwangi</p>
            </div>
        </div>

        <div class="col-md-5 col-lg-5 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-card text-center p-3 w-100">
                <img src="{{ asset('images/raya.jpg') }}" class="team-photo mb-3" alt="Foto Raya" style="object-position: 100% 25%;">
                <h5>Moh Raya Alfareza Alban</h5>
                <p class="mb-1 text-muted">247006111133</p>
                <p class="text-muted">Universitas Siliwangi</p>
            </div>
        </div>

        <div class="col-md-5 col-lg-5 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-card text-center p-3 w-100">
                <img src="{{ asset('images/fathir.jpg') }}" class="team-photo mb-3" alt="Foto Fathir" style="object-position: 100% 5%;">
                <h5>Fathir Rizki Fadillah</h5>
                <p class="mb-1 text-muted">247006111129</p>
                <p class="text-muted">Universitas Siliwangi</p>
            </div>
        </div>

        <div class="col-md-5 col-lg-5 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-card text-center p-3 w-100">
                <img src="{{ asset('images/dwiki.jpg') }}" class="team-photo mb-3" alt="Foto Dwiki">
                <h5>Dwiki Muhammad Wasfi</h5>
                <p class="mb-1 text-muted">247006111136</p>
                <p class="text-muted">Universitas Siliwangi</p>
            </div>
        </div>

        <div class="col-md-5 col-lg-5 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-card text-center p-3 w-100">
                <img src="{{ asset('images/andhara.jpg') }}" class="team-photo mb-3" alt="Foto Andhara" style="object-position: 100% 10%;">
                <h5>Andhara Febry Pitriana</h5>
                <p class="mb-1 text-muted">247006111144</p>
                <p class="text-muted">Universitas Siliwangi</p>
            </div>
        </div>
    </div>
@endsection
