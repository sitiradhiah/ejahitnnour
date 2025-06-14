@extends('layouts.admin-main')

@section('css')
<style>

    .card {
        margin-bottom: 20px;
    }

    .btn-generate {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-generate:hover {
        background-color: #0056b3;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Janaan Laporan</h3>
</div>
<div class="container">
    <!-- Laporan Tempahan -->
    <div class="card shadow p-3">
        <div class="card-header">
            <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Tapisan</label>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex flex-column me-2">
                    <label for="filter-date-from" class="form-label mb-1">Tarikh Dari:</label>
                    <input type="date" id="filter-date-from" class="form-control w-auto mb-2">
                </div>
                <div class="d-flex flex-column me-2">
                    <label for="filter-date-to" class="form-label mb-1">Tarikh Hingga:</label>
                    <input type="date" id="filter-date-to" class="form-control w-auto mb-2">
                </div>
                <div class="d-flex flex-column me-2">
                    <label for="filter-status" class="form-label mb-1">Pilih Status:</label>
                    <select id="filter-status" class="form-control w-auto mb-2">
                        <option value="">Semua</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Batal">Batal</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-success"><i class="fa-solid fa-download"></i> Excel</button>
                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-download"></i> PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Senarai Tempahan</label>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tarikh Tempahan</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ali Bin Ahmad</td>
                        <td>2025-01-10</td>
                        <td>Selesai</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-download"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Binti Hassan</td>
                        <td>2025-01-11</td>
                        <td>Dalam Proses</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-download"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Abu Bin Kassim</td>
                        <td>2025-01-12</td>
                        <td>Batal</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-download"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- <!-- Laporan Stok -->
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Janaan Laporan Stok</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bahan</th>
                        <th>Kuantiti</th>
                        <th>Harga Per Kuantiti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kain Cotton</td>
                        <td>50</td>
                        <td>RM20.00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Benang Jahit</td>
                        <td>100</td>
                        <td>RM5.00</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Butang Baju</td>
                        <td>200</td>
                        <td>RM0.50</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn-generate mt-3">Jana Laporan Stok</button>
        </div>
    </div> --}}
</div>
@endsection
