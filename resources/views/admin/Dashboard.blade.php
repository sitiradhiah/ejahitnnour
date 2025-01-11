
@extends('layouts.admin-main')

@section('css')
<style>

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
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pentadbir</h6>
                                    <h6 class="font-extrabold mb-0">1</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pekerja</h6>
                                    <h6 class="font-extrabold mb-0">auto count 
                                    </h6>
                                    <div>
                                        <i class="icon-list"></i> Total Items: <span id="totalItems">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pelanggan Berdaftar</h6>
                                    <h6 class="font-extrabold mb-0">10</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Carta Pembelian Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card">
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
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ asset('admin/images/faces/5.jpg')}}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Orang 1</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Ada sediakan perkhidmatan untuk cutting baju tak?</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ asset('admin/images/faces/2.jpg')}}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Orang 2</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Boleh buat tempah untuk Baju Kurta Modern?</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
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
            <div class="card">
                <div class="card-header">
                    <h4>Pekerja</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('admin/images/faces/4.jpg')}}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Pekerja1</h5>
                            {{-- <h6 class="text-muted mb-0">@johnducky</h6> --}}
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('admin/images/faces/5.jpg')}}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Pekerja2</h5>
                            {{-- <h6 class="text-muted mb-0">@imdean</h6> --}}
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('admin/images/faces/1.jpg')}}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Pekerja3</h5>
                            {{-- <h6 class="text-muted mb-0">@dodoljohn</h6> --}}
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Pemberitahuan</button>
                    </div>
                </div>
            </div>
            <div class="card">
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
    
</script>
@endsection