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

    .btn-add {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    .btn-info, .btn-edit, .btn-delete {
        font-weight: bold;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-edit {
        background-color: #007bff;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Senarai Pekerja</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Senarai Pekerja</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pekerja</th>
                        <th>Jawatan</th>
                        <th>No Telefon</th>
                        <th>Email</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ali Bin Ahmad</td>
                        <td>Admin</td>
                        <td>012-3456789</td>
                        <td>ali@admin.com</td>
                        <td>
                            <button class="btn-info">Info</button>
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Binti Hassan</td>
                        <td>Pekerja</td>
                        <td>013-4567890</td>
                        <td>siti@worker.com</td>
                        <td>
                            <button class="btn-info">Info</button>
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ahmad Bin Kassim</td>
                        <td>Pekerja</td>
                        <td>014-5678901</td>
                        <td>ahmad@worker.com</td>
                        <td>
                            <button class="btn-info">Info</button>
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nabilah Binti Zainal</td>
                        <td>Pekerja</td>
                        <td>015-6789012</td>
                        <td>nabilah@worker.com</td>
                        <td>
                            <button class="btn-info">Info</button>
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
