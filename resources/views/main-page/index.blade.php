@extends('layouts.main')

@section('container')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg rounded-4 p-4">
                <div class="row g-4 align-items-center">

                    <!-- Gambar iPhone -->
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('images/iphone.png') }}" alt="iPhone" class="img-fluid" style="max-height: 300px;">
                    </div>

                    <!-- Form -->
                    <div class="col-md-7">
                        <div id="formContainer">
                            <form id="predictForm">
                                <div class="mb-3">
                                    <label for="modelVarian" class="form-label">
                                        <i class="bi-phone"></i> Pilih Model iPhone
                                    </label>
                                    <select class="form-select shadow-sm" id="modelVarian" required>
                                        <option value="">-- Pilih Model --</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="variantSelect" class="form-label">
                                        <i class="bi-cpu"></i> Pilih Varian RAM / Storage
                                    </label>
                                    <select class="form-select shadow-sm" id="variantSelect" required>
                                        <option value="">-- Pilih Varian --</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="targetYear" class="form-label">
                                        <i class="bi-calendar-event"></i> Tahun Prediksi
                                    </label>
                                    <input type="number" min="2026" max="2050" class="form-control shadow-sm" id="targetYear" placeholder="Contoh: 2027" required>
                                    <small class="text-muted">Prediksi tersedia dari tahun 2025 hingga 2050.</small>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi-graph-up-arrow"></i> Prediksi Harga
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Alert -->
                        <div id="alertContainer" class="mt-4"></div>

                        <!-- Hasil Prediksi -->
                        <div id="predictionResult" class="mt-4 text-center d-none">
                            <h4><i class="bi-cash-stack"></i> Hasil Prediksi</h4>
                            <p id="predictedPrice" class="fs-4 fw-bold text-success">Rp -</p>
                        </div>

                        <!-- Rencana Menabung -->
                        <div id="savingPlan" class="mt-4 d-none">
                            <h5 class="text-center"><i class="bi-piggy-bank"></i> Rencana Menabung</h5>
                            <ul class="list-group text-center shadow-sm">
                                <li class="list-group-item">Rp <span id="perDay"></span> / hari</li>
                                <li class="list-group-item">Rp <span id="perWeek"></span> / minggu</li>
                                <li class="list-group-item">Rp <span id="perMonth"></span> / bulan</li>
                                <li class="list-group-item">Rp <span id="perYear"></span> / tahun</li>
                            </ul>
                        </div>

                        <!-- Tombol Coba Lagi -->
                        <div class="text-center mt-4 d-none" id="retrySection">
                            <button class="btn btn-outline-secondary" id="retryBtn">
                                <i class="bi-arrow-counterclockwise"></i> Coba Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animasi CSS -->
<style>
    #predictionResult, #savingPlan, #retrySection {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    #predictionResult.show, #savingPlan.show, #retrySection.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- Script -->
<script>
    let iphoneData = [];
    const modelSelect = document.getElementById('modelVarian');
    const variantSelect = document.getElementById('variantSelect');
    const form = document.getElementById('predictForm');

    fetch('/data/iphone-data.json')
        .then(response => response.json())
        .then(data => {
            iphoneData = data;
            iphoneData.forEach(item => {
                const option = document.createElement('option');
                option.value = item.model;
                option.textContent = item.model;
                modelSelect.appendChild(option);
            });
        });

    modelSelect.addEventListener('change', function () {
        const selectedModel = iphoneData.find(item => item.model === this.value);
        variantSelect.innerHTML = '<option value="">-- Pilih Varian --</option>';
        selectedModel.variants.forEach(variant => {
            const option = document.createElement('option');
            option.value = JSON.stringify({ ...variant, release_year: selectedModel.release_year });
            option.textContent = `${variant.ram} / ${variant.storage}`;
            variantSelect.appendChild(option);
        });
    });

    function ceilToNearest(value, multiple) {
        return Math.ceil(value / multiple) * multiple;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const year = parseInt(document.getElementById('targetYear').value);
        const variantData = JSON.parse(variantSelect.value);
        let price, diff;

        if (variantData.prices_by_year && variantData.prices_by_year[2025]) {
            const basePrice2025 = variantData.prices_by_year[2025];
            diff = year - 2025;
            price = basePrice2025 * Math.pow(variantData.depreciation_ratio, diff);
        } else {
            diff = year - (variantData.release_year || 2023);
            price = variantData.base_price_idr * Math.pow(variantData.depreciation_ratio, diff);
        }

        price = ceilToNearest(price, 1000);
        const daily = ceilToNearest(price / (365 * diff), 1000);
        const weekly = ceilToNearest(price / (52 * diff), 1000);
        const monthly = ceilToNearest(price / (12 * diff), 1000);
        const yearly = ceilToNearest(price / diff, 1000);

        // Sembunyikan form, tampilkan hasil
        document.getElementById('formContainer').classList.add('d-none');
        document.getElementById('predictionResult').classList.remove('d-none', 'show');
        document.getElementById('savingPlan').classList.remove('d-none', 'show');
        document.getElementById('retrySection').classList.remove('d-none', 'show');

        setTimeout(() => {
            document.getElementById('predictionResult').classList.add('show');
            document.getElementById('savingPlan').classList.add('show');
            document.getElementById('retrySection').classList.add('show');
        }, 10);

        document.getElementById('predictedPrice').innerHTML = `
            <div class="mb-2">Harga: <strong>Rp ${price.toLocaleString('id-ID')}</strong></div>
        `;

        const alertContainer = document.getElementById('alertContainer');
        alertContainer.innerHTML = '';

        const yearDiff = year - variantData.release_year;
        if (yearDiff > 3) {
            alertContainer.innerHTML = `
                <div class="alert alert-warning text-center" role="alert">
                    ⚠️ Prediksi dilakukan lebih dari <strong>3 tahun</strong> setelah rilis (${variantData.release_year}). 
                    Kemungkinan besar iPhone ini sudah <strong>tidak lagi diproduksi</strong>.
                </div>
            `;
        }

        document.getElementById('perDay').textContent = daily.toLocaleString('id-ID');
        document.getElementById('perWeek').textContent = weekly.toLocaleString('id-ID');
        document.getElementById('perMonth').textContent = monthly.toLocaleString('id-ID');
        document.getElementById('perYear').textContent = yearly.toLocaleString('id-ID');
    });

    // Reset saat klik "Coba Lagi"
    document.getElementById('retryBtn').addEventListener('click', function () {
        form.reset();
        variantSelect.innerHTML = '<option value="">-- Pilih Varian --</option>';
        document.getElementById('formContainer').classList.remove('d-none');
        document.getElementById('predictionResult').classList.add('d-none');
        document.getElementById('savingPlan').classList.add('d-none');
        document.getElementById('retrySection').classList.add('d-none');
        document.getElementById('alertContainer').innerHTML = '';
    });
</script>
@endsection
