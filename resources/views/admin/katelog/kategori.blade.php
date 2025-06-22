@extends('layouts.admin-main')

@section('css')
<style>

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
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tindakan</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <!-- Edit button triggering modal -->
                            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal" onclick="editCategory({{ $category->id }})"><i class="fa-solid fa-pen-to-square"></i></button>
                            <!-- Delete button with form -->
                            <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    @endforeach
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
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required placeholder="Masukkan nama kategori">
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
                <form action="{{ route('kategori.update', '') }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" required>
                    </div>
                    <button type="submit" class="btn-edit w-100"><i class="fa-solid fa-pen-to-square"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Edit Category function
    function editCategory(id) {
        fetch(`/admin/kategori/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editCategoryName').value = data.name;
                document.getElementById('editCategoryForm').action = `/admin/kategori/${id}`;
            });
    }
</script>
@endsection
