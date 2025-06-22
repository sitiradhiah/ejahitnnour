@extends('layouts.admin-main')

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
@endphp

@section('css')
<style>
    <style>
    .badge.bg-primary {
        background-color: #ff6600 !important;
        color: white;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 10px;
    }
</style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>STATISTIK DATA KEDAI N'NOUR</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
           <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow mb-0">
                        <div class="card-body px-3 py-4-5">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon purple me-3">
                                    <i class="fas fa-receipt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold mb-1">Jumlah Tempahan 2025</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->peranan === 'pentadbir')
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow mb-0">
                        <div class="card-body px-3 py-4-5">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon blue me-3">
                                    <i class="fas fa-cash-register fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold mb-1">Jumlah Jualan 2025 (Siap)</h6>
                                    <h6 class="font-extrabold mb-0">RM{{ number_format($completedSales, 2) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow mb-0">
                        <div class="card-body px-3 py-4-5">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon green me-3">
                                    <i class="fas fa-spinner fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold mb-1">Tempahan Dalam Proses</h6>
                                    <h6 class="font-extrabold mb-0">{{ $ordersInProgress }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow mb-0">
                        <div class="card-body px-3 py-4-5">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon teal me-3">
                                    <i class="fas fa-calendar-alt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted font-semibold mb-1">Tempahan Bulan Ini ({{ \Carbon\Carbon::now()->translatedFormat('F') }})</h6>
                                    <h6 class="font-extrabold mb-0">{{ $monthlyOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Tempahan -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Statistik Tempahan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-statistik-tempahan"></div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->peranan === 'pentadbir')
            <!-- Pertanyaan Terkini -->
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Pertanyaan Terkini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-lg shadow">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Pertanyaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @forelse($latestInquiries as $inquiry)
                                            <tr onclick="window.location.href='{{ route('aduan-cadangan.index') }}';" style="cursor: pointer;">
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('admin/images/faces/5.jpg') }}">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">
                                                            {{ $inquiry->nama_pelanggan }}
                                                            @if(\Carbon\Carbon::parse($inquiry->tarikh)->gt(\Carbon\Carbon::now()->subDay()))
                                                                <span class="badge bg-primary ms-2">Baru</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class="mb-0">{{ Str::limit($inquiry->message, 50) }}</p>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center bg-gray-100">
                                                    Tiada aduan atau cadangan baru buat masa ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-3">
            <!-- Pekerja dan Pemberitahuan -->
            <!-- <div class="card shadow">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mt-2">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pekerja -->
            <div class="card shadow">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Pekerja / Pentadbir</h4>
                        <nav>
                            <ul class="pagination pagination-sm mb-0" id="workers-pagination"></ul>
                        </nav>
                    </div>
                    @php
                         $workers = \App\Models\User::whereIn('peranan', ['pekerja', 'pentadbir'])->get();
                    @endphp
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <ul class="paginated-list" data-pagination-id="workers-pagination" data-per-page="5">
                            @foreach($workers as $worker)
                                <li>{{ $worker->name }} ({{ $worker->peranan }})</li>
                            @endforeach
                        </ul>

                        <ul class="pagination" id="workers-pagination"></ul>


                    </div>
                    <!-- Pekerja2 dan Pekerja3, tambahkan jika perlu -->
                    <!-- <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Pemberitahuan</button>
                    </div> -->
                </div>
            </div>

            <!-- Carta Pai Peratus Jantina -->
            <div class="card shadow">
                <div class="card-header">
                    <h4>Carta Pai tempahan tahun {{ date('Y') }}</h4>
                </div>
                <div class="card-body">
                    <canvas id="tempahanPieChart" width="400" height="320"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<!-- Global JS Pagination List -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function paginateList(listElement) {
        const perPage = parseInt(listElement.getAttribute('data-per-page')) || 5;
        const items = listElement.querySelectorAll('li');
        const totalItems = items.length;
        const totalPages = Math.ceil(totalItems / perPage);
        const paginationId = listElement.getAttribute('data-pagination-id');
        const paginationContainer = document.getElementById(paginationId);

        if (!paginationContainer) return;

        function showPage(page) {
            const start = (page - 1) * perPage;
            const end = start + perPage;
            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? '' : 'none';
            });
        }

        function renderPagination() {
            paginationContainer.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = 'page-item' + (i === 1 ? ' active' : '');
                const a = document.createElement('a');
                a.className = 'page-link';
                a.href = '#';
                a.textContent = i;
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    paginationContainer.querySelectorAll('.page-item').forEach(item => item.classList.remove('active'));
                    li.classList.add('active');
                    showPage(i);
                });
                li.appendChild(a);
                paginationContainer.appendChild(li);
            }
        }

        if (totalPages > 1) {
            renderPagination();
        }

        showPage(1);
    }

    // Automatically apply pagination to all .paginated-list
    document.querySelectorAll('.paginated-list').forEach(paginateList);
});
</script>
<script>
    var options = {
        series: [{
            name: 'Sudah Selesai',
            data: @json($monthlyOrdersCompleted)
        }, {
            name: 'Dalam Perlaksanaan',
            data: @json($monthlyOrdersInProgress)
        }, {
            name: 'Tempahan Baru',
            data: @json($monthlyOrdersInNew)
        }],
        chart: {
            type: 'bar',
            height: 300
        },
        title: {
            text: 'Jumlah tempahan Siap, Dalam Perlaksanaan dan Baru bulan ini',
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-statistik-tempahan"), options);
    chart.render();
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const labels = ['Sudah Selesai', 'Dalam Pelaksanaan', 'Tempahan Baru', 'Pra-tempahan'];
        const dataValues = [
            {{ $sudahSelesai }},
            {{ $dalamPelaksanaan }},
            {{ $tempahanBaru }},
            {{ $praTempahan }}
        ];

        const backgroundColors = ['#008ffb',  '#00e396', '#feb019','#ff4560'];

        const ctx = document.getElementById('tempahanPieChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            usePointStyle: true,
                        }
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            const total = context.chart._metasets[0].total;
                            const percent = (value / total * 100).toFixed(1);
                            return percent + '%';
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: {
                type: 'pie'
            },
            labels: ['Sudah Selesai', 'Dalam Pelaksanaan', 'Tempahan Baru', 'Pra-tempahan'],
            series: [
                {{ $sudahSelesai }},
                {{ $dalamPelaksanaan }},
                {{ $tempahanBaru }},
                {{ $praTempahan }}
            ],
            colors: ['#00e396', '#feb019', '#008ffb', '#ff4560'],
            // title: {
            //     text: 'Status Tempahan Tahun {{ date("Y") }}',
            //     align: 'center'
            // },
            legend: {
                position: 'bottom'
            }
        };

        var chart = new ApexCharts(document.querySelector("#tempahan"), options);
        chart.render();
    });
</script> -->

@endsection
