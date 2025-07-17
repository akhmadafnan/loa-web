@extends('layouts.backend')

@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
        </div>
    </div>
</div>

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start First Cards -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $totalDokumen }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total LOA</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $jumlahJurnal }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Jurnal</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="book"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $dokumenApproved }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Approve LOA</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-text"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $dokumenPending }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">LOA Pending</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End First Cards -->

    <!-- Grafik Aktivitas -->
    <div class="row">
        <!-- Bar Chart -->
        <div class="col-lg col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">LOA Dibuat per Bulan</h4>
                    <div style="height: 300px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Aktivitas -->
    <div class="row">
        <div class="col-lg col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aktivitas Terbaru</h4>
                    <div class="mt-4 activity">
                        <div class="mt-4 activity" id="activity-log-container">
                            @include('components.recent-activity', ['logs' => $recentActivities])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bar Chart -->
    <script>
        const labels = @json($bulanLabels);
        const data = @json($dataTotal);

        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Dokumen per Bulan',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        function loadRecentActivity() {
            fetch("{{ route('recent.activity') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('activity-log-container').innerHTML = data.html;
                    feather.replace(); // untuk update icon feather
                });
        }

        // Refresh setiap 10 detik
        setInterval(loadRecentActivity, 10000);
    </script>


</div>
@endsection
