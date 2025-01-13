@extends('layouts.admin-main')

@section('css')
<style>
    .page-heading {
        margin-bottom: 20px;
        text-align: center;
    }

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
            <h4>Janaan Laporan Tempahan</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tarikh Tempahan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ali Bin Ahmad</td>
                        <td>2025-01-10</td>
                        <td>Selesai</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Binti Hassan</td>
                        <td>2025-01-11</td>
                        <td>Dalam Proses</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Abu Bin Kassim</td>
                        <td>2025-01-12</td>
                        <td>Batal</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn-generate mt-3">Jana Laporan Tempahan</button>
        </div>
    </div>

    <!-- Laporan Stok -->
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Janaan Laporan Stok</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
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
    </div>
</div>
@endsection
