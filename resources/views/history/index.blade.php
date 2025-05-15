@extends('layouts.main')

@section('container')
    <div class="container my-5">
        <h2 class="text-center mb-4"><i class="bi-clock-history"></i> Riwayat Prediksi iPhone</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div id="historyContainer" class="card p-4 shadow">
                    <div id="emptyHistoryMessage" class="text-center py-4 d-none">
                        <i class="bi-emoji-frown display-1 text-muted"></i>
                        <p class="mt-3">Belum ada prediksi yang tersimpan.</p>
                        <a href="/prediksi" class="btn btn-primary mt-2">Buat Prediksi Baru</a>
                    </div>

                    <div id="historyContent" class="fade-in">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Varian</th>
                                        <th>Tahun Target</th>
                                        <th>Prediksi Harga</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                    <!-- Will be filled with JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <a href="/" class="btn btn-outline-secondary me-2">
                                <i class="bi-house-door"></i> Kembali
                            </a>
                            <button id="clearHistoryBtn" class="btn btn-outline-danger">
                                <i class="bi-trash"></i> Hapus Semua Riwayat
                            </button>
                        </div>
                    </div>
                </div>

                <div id="detailModal" class="modal fade" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Prediksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-3">Informasi iPhone</h6>
                                        <ul class="list-group list-group-flush mb-4">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Model:</span>
                                                <strong id="detailModel">-</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Varian:</span>
                                                <strong id="detailVariant">-</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Harga Tahun <span id="detailCurrentYear">-</span>:</span>
                                                <strong>Rp <span id="detailCurrentPrice">-</span></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Tahun Target:</span>
                                                <strong id="detailTargetYear">-</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Prediksi Harga:</span>
                                                <strong>Rp <span id="detailPredictedPrice">-</span></strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-3">Rencana Menabung</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Per Hari:</span>
                                                <strong>Rp <span id="detailPerDay">-</span></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Per Minggu:</span>
                                                <strong>Rp <span id="detailPerWeek">-</span></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Per Bulan:</span>
                                                <strong>Rp <span id="detailPerMonth">-</span></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Per Tahun:</span>
                                                <strong>Rp <span id="detailPerYear">-</span></strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-muted mt-3 small">
                                    <i class="bi-calendar-check"></i> Prediksi dibuat pada: <span id="detailTimestamp">-</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const predictions = JSON.parse(localStorage.getItem('iphonePredictions') || '[]');
            const tableBody = document.getElementById('historyTableBody');
            const emptyMessage = document.getElementById('emptyHistoryMessage');
            const historyContent = document.getElementById('historyContent');
            
            // Check if there are any predictions
            if (predictions.length === 0) {
                emptyMessage.classList.remove('d-none');
                historyContent.classList.add('d-none');
                return;
            }
            
            // Populate the table with predictions
            tableBody.innerHTML = '';
            predictions.forEach((pred, index) => {
                const row = document.createElement('tr');
                const date = new Date(pred.timestamp);
                const formattedDate = `${date.toLocaleDateString('id-ID')} ${date.toLocaleTimeString('id-ID')}`;
                
                row.innerHTML = `
                    <td>${pred.model}</td>
                    <td>${pred.variant}</td>
                    <td>${pred.targetYear}</td>
                    <td>Rp ${pred.predictedPrice.toLocaleString('id-ID')}</td>
                    <td>${formattedDate}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-info view-prediction me-1" data-index="${index}" data-bs-toggle="modal" data-bs-target="#detailModal">
                            <i class="bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger delete-prediction" data-index="${index}">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            
            // Set up clear history button
            document.getElementById('clearHistoryBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Hapus Riwayat?',
                    text: 'Semua riwayat prediksi akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.removeItem('iphonePredictions');
                        Swal.fire(
                            'Terhapus!',
                            'Riwayat prediksi telah dihapus.',
                            'success'
                        ).then(() => {
                            // Reload the page
                            window.location.reload();
                        });
                    }
                });
            });
            
            // Set up view prediction buttons
            document.querySelectorAll('.view-prediction').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    const pred = predictions[index];
                    const date = new Date(pred.timestamp);
                    const formattedDate = `${date.toLocaleDateString('id-ID')} ${date.toLocaleTimeString('id-ID')}`;
                    
                    // Fill modal with prediction details
                    document.getElementById('detailModel').textContent = pred.model;
                    document.getElementById('detailVariant').textContent = pred.variant;
                    document.getElementById('detailCurrentYear').textContent = pred.currentYear;
                    document.getElementById('detailCurrentPrice').textContent = pred.currentPrice.toLocaleString('id-ID');
                    document.getElementById('detailTargetYear').textContent = pred.targetYear;
                    document.getElementById('detailPredictedPrice').textContent = pred.predictedPrice.toLocaleString('id-ID');
                    document.getElementById('detailPerDay').textContent = pred.savingPlan.perDay.toLocaleString('id-ID');
                    document.getElementById('detailPerWeek').textContent = pred.savingPlan.perWeek.toLocaleString('id-ID');
                    document.getElementById('detailPerMonth').textContent = pred.savingPlan.perMonth.toLocaleString('id-ID');
                    document.getElementById('detailPerYear').textContent = pred.savingPlan.perYear.toLocaleString('id-ID');
                    document.getElementById('detailTimestamp').textContent = formattedDate;
                    
                    // Create a URL with query parameters for the main page to use
                    const params = new URLSearchParams();
                    params.append('action', 'load');
                    params.append('index', index);
                    document.getElementById('detailRetryBtn').href = `/?${params.toString()}`;
                });
            });
            
            // Set up delete prediction buttons
            document.querySelectorAll('.delete-prediction').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    
                    Swal.fire({
                        title: 'Hapus Prediksi?',
                        text: 'Prediksi ini akan dihapus dari riwayat!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Remove this prediction from localStorage
                            predictions.splice(index, 1);
                            localStorage.setItem('iphonePredictions', JSON.stringify(predictions));
                            
                            // Remove the row from the table
                            this.closest('tr').remove();
                            
                            // Check if we need to show the empty message
                            if (predictions.length === 0) {
                                emptyMessage.classList.remove('d-none');
                                historyContent.classList.add('d-none');
                            }
                            
                            Swal.fire(
                                'Terhapus!',
                                'Prediksi telah dihapus dari riwayat.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection