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

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table {
        margin-bottom: 0;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        color: white;
    }

    .status-pending {
        background-color: #ffc107;
    }

    .status-resolved {
        background-color: #28a745;
    }

    .status-rejected {
        background-color: #dc3545;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Aduan & Cadangan</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Senarai Aduan dan Cadangan</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tajuk</th>
                        <th>Kategori</th>
                        <th>Tarikh</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ali Bin Ahmad</td>
                        <td>Kualiti Produk</td>
                        <td>Aduan</td>
                        <td>2025-01-10</td>
                        <td><span class="status-badge status-pending">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Binti Hassan</td>
                        <td>Servis Pelanggan</td>
                        <td>Cadangan</td>
                        <td>2025-01-11</td>
                        <td><span class="status-badge status-resolved">Selesai</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Abu Bin Kassim</td>
                        <td>Harga Produk</td>
                        <td>Aduan</td>
                        <td>2025-01-12</td>
                        <td><span class="status-badge status-rejected">Ditolak</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
