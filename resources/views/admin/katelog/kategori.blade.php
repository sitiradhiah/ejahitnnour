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

    .btn-add, .btn-edit, .btn-delete {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
    }

    .btn-add {
        background-color: #28a745;
        color: white;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    .btn-edit {
        background-color: #007bff;
        color: white;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
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
    <h3>Kategori Pakaian</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header d-flex justify-content-between">
            <h4>Senarai Kategori Pakaian</h4>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Pakaian Harian</td>
                        <td>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit</button>
                            <button class="btn-delete">Padam</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pakaian Rasmi</td>
                        <td>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit</button>
                            <button class="btn-delete">Padam</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Aksesori</td>
                        <td>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit</button>
                            <button class="btn-delete">Padam</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Masukkan nama kategori">
                    </div>
                    <button type="submit" class="btn-add w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="editCategoryName" value="Pakaian Harian">
                    </div>
                    <button type="submit" class="btn-edit w-100">Kemaskini</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
