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
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Tempahan 2025</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Jualan 2025 (Siap)</h6>
                                    <h6 class="font-extrabold mb-0">RM{{ number_format($completedSales, 2) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Tempahan Dalam Proses</h6>
                                    <h6 class="font-extrabold mb-0">{{ $ordersInProgress }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Tempahan Bulan ini (Januari)</h6>
                                    <h6 class="font-extrabold mb-0">{{ $monthlyOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Tempahan -->
            <div class="row">
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

            <!-- Pertanyaan Terkini -->
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Pertanyaan Terkini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Pertanyaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestInquiries as $inquiry)
                                        <tr onclick="window.location.href='{{ route('aduan-cadangan.index') }}';" style="cursor: pointer;">
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ asset('admin/images/faces/5.jpg') }}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">
                                                        {{ $inquiry->nama_pelanggan }}
                                                        @if(Carbon::parse($inquiry->tarikh)->gt(Carbon::now()->subDay()))
                                                            <span class="badge bg-primary ms-2">Baru</span>
                                                        @endif
                                                    </p>
                                                    
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{ Str::limit($inquiry->message, 50) }}</p>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-3">
            <!-- Pekerja dan Pemberitahuan -->
            <div class="card shadow">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('admin/images/faces/1.jpg')}}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">WakkTailor</h5>
                            <h6 class="text-muted mb-0">@waktailor</h6>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pekerja -->
            <div class="card shadow">
                <div class="card-header">
                    <h4>Pekerja</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('admin/images/faces/4.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Pekerja1</h5>
                        </div>
                    </div>
                    <!-- Pekerja2 dan Pekerja3, tambahkan jika perlu -->
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Pemberitahuan</button>
                    </div>
                </div>
            </div>

            <!-- Carta Pai Peratus Jantina -->
            <div class="card shadow">
                <div class="card-header">
                    <h4>Carta Pai Peratus Jantina</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    var options = {
        series: [{
            name: 'Siap',
            data: @json($monthlyOrdersCompleted)
        }, {
            name: 'Dalam Proses',
            data: @json($monthlyOrdersInProgress)
        }],
        chart: {
            type: 'bar',
            height: 300
        },
        title: {
            text: 'Jumlah Tempahan Siap dan Dalam Proses',
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-statistik-tempahan"), options);
    chart.render();
</script>
@endsection
