@extends('layouts.main')

@section('container')

<section class="bg-primary text-white py-5 text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Tentang Kami</h1>
        <p class="lead mt-3" style="font-size: 18px">
            Appredict adalah platform online pertama yang membandingkan berbagai opsi harga iPhone
            berdasarkan tren historis untuk membantu Anda mengambil keputusan finansial yang lebih bijak.
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="text-primary fw-bold mb-3">Tentang Proyek Ini</h2>
                <p class="lead text-muted" style="font-size: 18px">
                    Proyek ini dikembangkan sebagai bagian dari tugas kuliah kami, dengan tujuan menerapkan ilmu matematika dan pemrograman ke dalam sebuah aplikasi nyata.
                    <br><br>
                    Kami berharap Appredict bisa menjadi contoh sederhana bagaimana data historis dapat digunakan untuk membantu pengguna membuat keputusan pembelian yang lebih bijak, terutama saat ingin membeli iPhone.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/teamwork.jpg') }}" alt="Ilustrasi Proyek" class="img-fluid" style="max-width: 80%">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Tim Kami</h2>

        <div class="row justify-content-center g-4 mb-3">
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="team-card">
                    <img src="{{ asset('images/fariez2.jpg') }}" class="team-photo team-fariez" alt="Muhammad Fariez Riziq Ilham">
                    <div class="team-overlay text-center">
                        <h5 class="mb-1">M Fariez Riziq Ilham</h5>
                        <p class="small mb-0">247006111146<br>Universitas Siliwangi</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="team-card">
                    <img src="{{ asset('images/raya.jpg') }}" class="team-photo team-raya" alt="Moh Raya Alfareza Alban">
                    <div class="team-overlay text-center">
                        <h5 class="mb-1">Moh Raya Alfareza A</h5>
                        <p class="small mb-0">247006111133<br>Universitas Siliwangi</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="team-card">
                    <img src="{{ asset('images/fathir.jpg') }}" class="team-photo team-fathir" alt="Fathir Rizki Fadillah">
                    <div class="team-overlay text-center">
                        <h5 class="mb-1">Fathir Rizki Fadillah</h5>
                        <p class="small mb-0">247006111129<br>Universitas Siliwangi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="team-card">
                    <img src="{{ asset('images/dwiki.jpg') }}" class="team-photo team-dwiki" alt="Dwiki Muhammad Wasfi">
                    <div class="team-overlay text-center">
                        <h5 class="mb-1">Dwiki Muhammad W</h5>
                        <p class="small mb-0">247006111136<br>Universitas Siliwangi</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="team-card">
                    <img src="{{ asset('images/andhara.jpg') }}" class="team-photo team-andhara" alt="Andhara Febry Pitriana">
                    <div class="team-overlay text-center">
                        <h5 class="mb-1">Andhara Febry Pitriana</h5>
                        <p class="small mb-0">247006111144<br>Universitas Siliwangi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
