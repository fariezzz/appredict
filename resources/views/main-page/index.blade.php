@extends('layouts.main')

@section('container')
    <div class="container my-5">
        <h2 class="text-center mb-4"><i class="bi-phone"></i> Prediksi Harga iPhone</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4 shadow fade-in show" id="formContainer">
                    <div class="row align-items-center" id="formRow">
                        <div id="formCol">
                            <div>
                                <form id="predictForm">
                                    <div class="mb-3">
                                        <label for="modelVariant" class="form-label">Pilih Model iPhone</label>
                                        <select id="modelVariant" class="form-select" required>
                                            <option value="">-- Pilih Model --</option>
                                            <!-- Diisi oleh JS -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="variantSelect" class="form-label">Pilih Varian (RAM / Storage)</label>
                                        <select id="variantSelect" class="form-select" required>
                                            <option value="">-- Pilih Varian --</option>
                                            <!-- Diisi oleh JS -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="targetYear" class="form-label">Tahun Target</label>
                                        <input type="number" class="form-control" id="targetYear"
                                            placeholder="Contoh: 2026" min="2025" max="2035" required>
                                    </div>
                                    <div class="mb-3">
                                        <div id="phonePrice" class="text-muted">Harga Tahun Ini: -</div>
                                    </div>
                                    <button type="submit" class="btn btn-secondary w-100">Prediksi</button>
                                </form>
                            </div>
                        </div>
                        <div align="center" id="imageCol">
                            <img id="iphoneImage" src="{{ asset('/images/iphones/iphone.png') }}" alt="iPhone" class="img-fluid iphone-img">
                        </div>
                    </div>
                </div>

                <div id="alertContainer" class="my-3 fade-in d-none"></div>

                <div id="predictionResult" class="fade-in d-none mt-4 card p-4 shadow">
                    <h5 class="text-center mb-3"><i class="bi-cash-coin"></i> Prediksi Harga di Tahun Tersebut</h5>
                    <div id="predictedPrice" class="text-center fs-4"></div>
                </div>

                <div id="savingPlan" class="fade-in d-none mt-4 card p-4 shadow">
                    <h5 class="text-center mb-3"><i class="bi-piggy-bank"></i> Rencana Menabung</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Per Hari: <strong>Rp <span id="perDay">0</span></strong></li>
                        <li class="list-group-item">Per Minggu: <strong>Rp <span id="perWeek">0</span></strong></li>
                        <li class="list-group-item">Per Bulan: <strong>Rp <span id="perMonth">0</span></strong></li>
                        <li class="list-group-item">Per Tahun: <strong>Rp <span id="perYear">0</span></strong></li>
                    </ul>
                </div>

                <div class="mt-5 d-none fade-in" id="priceChartContainer">
                    <h5 class="text-center"><i class="bi-graph-up"></i> Grafik Harga per Tahun</h5>
                    <canvas id="priceChart" height="100"></canvas>
                </div>

                <div id="retrySection" class="fade-in d-none text-center my-5">
                    <button class="btn btn-outline-secondary" id="retryBtn">
                        <i class="bi-arrow-repeat"></i> Coba Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let iphoneData = [];
        const modelSelect = document.getElementById('modelVariant');
        const variantSelect = document.getElementById('variantSelect');
        const predictionForm = document.getElementById('predictForm');
        const priceText = document.getElementById('phonePrice');

        fetch('/data/data.json')
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

        modelSelect.addEventListener('change', function() {
            const selectedModel = iphoneData.find(item => item.model === this.value);
            priceText.innerHTML =
                `Harga Tahun Ini: Rp${selectedModel.variants[0].prices_by_year[2025].toLocaleString('id-ID')}`;
            variantSelect.innerHTML = '<option value="">-- Pilih Varian --</option>';
            selectedModel.variants.forEach(variant => {
                const option = document.createElement('option');
                option.value = JSON.stringify({
                    ...variant,
                    release_year: selectedModel.release_year
                });
                option.textContent = `${variant.ram} / ${variant.storage}`;
                variantSelect.appendChild(option);
            });
            const iphoneImage = document.getElementById('iphoneImage'); 
            iphoneImage.src = `{{ asset('/images/iphones/${selectedModel.model}.png') }}`;

            const formCol = document.getElementById('formCol');
            formCol.classList.add('reduced-width');

            const imageCol = document.getElementById('imageCol');

            formCol.addEventListener('transitionend', function handler(e) {
                if (e.propertyName === 'width') {
                    imageCol.classList.add('show');
                    setTimeout(() => {
                        iphoneImage.classList.add('fade-in');
                    }, 50);


                    formCol.removeEventListener('transitionend', handler);
                }
            });
        });

        variantSelect.addEventListener('change', function() {
            const selectedVariant = JSON.parse(variantSelect.value);
            priceText.innerHTML =
                `Harga Tahun Ini: Rp${selectedVariant.prices_by_year[2025].toLocaleString('id-ID')}`;
        });

        function ceilToNearest(value, multiple) {
            return Math.ceil(value / multiple) * multiple;
        }

        function calculateAverageDepreciationRatio(pricesByYear) {
            const years = Object.keys(pricesByYear).map(Number).sort();
            let totalRatio = 0,
                count = 0;
            for (let i = 1; i < years.length; i++) {
                const prev = pricesByYear[years[i - 1]];
                const curr = pricesByYear[years[i]];
                if (prev && curr) {
                    totalRatio += curr / prev;
                    count++;
                }
            }
            return count > 0 ? totalRatio / count : 0.90;
        }

        predictionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const targetYear = parseInt(document.getElementById('targetYear').value);
            const variantData = JSON.parse(variantSelect.value);
            const prices = variantData.prices_by_year;
            const yearList = Object.keys(prices).map(Number).sort();
            const baseYear = yearList[yearList.length - 1];
            const basePrice = prices[baseYear];
            const yearDiff = targetYear - baseYear;
            const avgRatio = calculateAverageDepreciationRatio(prices);

            let predictedPrice = basePrice * Math.pow(avgRatio, yearDiff);
            predictedPrice = ceilToNearest(predictedPrice, 1000);

            const perDay = ceilToNearest(predictedPrice / (365 * yearDiff), 1000);
            const perWeek = ceilToNearest(predictedPrice / (52 * yearDiff), 1000);
            const perMonth = ceilToNearest(predictedPrice / (12 * yearDiff), 1000);
            const perYear = ceilToNearest(predictedPrice / yearDiff, 1000);

            document.getElementById('predictedPrice').innerHTML =
                `<div class="mb-2"><strong>Rp ${predictedPrice.toLocaleString('id-ID')}</strong></div>`;
            document.getElementById('perDay').textContent = perDay.toLocaleString('id-ID');
            document.getElementById('perWeek').textContent = perWeek.toLocaleString('id-ID');
            document.getElementById('perMonth').textContent = perMonth.toLocaleString('id-ID');
            document.getElementById('perYear').textContent = perYear.toLocaleString('id-ID');

            const releaseDiff = targetYear - variantData.release_year;
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = '';
            if (releaseDiff > 3) {
                alertContainer.innerHTML = `
                <div class="alert alert-warning text-center" role="alert">
                    ⚠️ Prediksi dilakukan lebih dari <strong>3 tahun</strong> setelah rilis (${variantData.release_year}). 
                    Kemungkinan besar iPhone ini sudah <strong>tidak lagi diproduksi</strong>.
                </div>
            `;
            }

            document.getElementById('formContainer').classList.add('d-none');
            document.getElementById('predictionResult').classList.remove('d-none', 'show');
            document.getElementById('savingPlan').classList.remove('d-none', 'show');
            document.getElementById('retrySection').classList.remove('d-none', 'show');
            document.getElementById('priceChartContainer').classList.remove('d-none');

            setTimeout(() => {
                document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
            }, 10);

            // document.getElementById('predictionResult').scrollIntoView({ behavior: 'smooth' });

            const yearLabels = Object.keys(prices);
            const priceValues = Object.values(prices);
            if (window.priceChartInstance) window.priceChartInstance.destroy();

            const ctx = document.getElementById('priceChart').getContext('2d');
            window.priceChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: yearLabels,
                    datasets: [{
                        label: 'Harga iPhone per Tahun',
                        data: priceValues,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: value => 'Rp ' + value.toLocaleString('id-ID')
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        });

        document.getElementById('retryBtn').addEventListener('click', function() {
            predictionForm.reset();
            variantSelect.innerHTML = '<option value="">-- Pilih Varian --</option>';
            document.getElementById('formContainer').classList.remove('d-none');
            document.getElementById('predictionResult').classList.add('d-none');
            document.getElementById('savingPlan').classList.add('d-none');
            document.getElementById('retrySection').classList.add('d-none');
            document.getElementById('priceChartContainer').classList.add('d-none');
            document.getElementById('alertContainer').innerHTML = '';
            priceText.innerHTML = 'Harga Tahun Ini: -';
            const formCol = document.getElementById('formCol');
            const imageCol = document.getElementById('imageCol');
            const iphoneImage = document.getElementById('iphoneImage');
            formCol.classList.remove('reduced-width');
            imageCol.classList.remove('show');
            iphoneImage.classList.remove('fade-in');
            iphoneImage.src = "{{ asset('/images/iphones/iphone.png') }}";
        });
    </script>
@endsection
