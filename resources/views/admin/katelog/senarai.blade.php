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
    <h3>Pengurusan Katalog</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header d-flex justify-content-between">
            <h4>Senarai Katalog Produk</h4>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fa fa-plus"></i> Tambah Produk</button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tindakan</th>
                        <th>Nama Reka Bentuk</th>
                        <th>Kategori</th>
                        <th>Warna</th>
                        <!-- <th>Saiz</th> -->
                        <!-- <th>Harga</th> -->
                        <th>Penerangan</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($katelogs as $item)
                    <tr>
                        <td width="5%">{{ $loop->iteration }}</td>
                        <td width="10%">
                            <button class="btn btn-sm btn-primary" onclick="editKatalog({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form action="{{ route('katelog.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td width="10%">{{ $item->nama }}</td>
                        <td width="10%">{{ $item->kategori }}</td>
                        <td width="5%">{{ $item->warna }}</td>
                        <!-- <td width="5%">{{ $item->saiz }}</td> -->
                        <!-- <td width="10%">RM {{ number_format($item->harga, 2) }}</td> -->
                        <td width="40%" style="white-space: normal; word-break: break-word; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($item->penerangan, 100) }}
                            @if(strlen($item->penerangan) > 100)
                                <a href="#" style="text-decoration: underline; color: #007bff;" onclick="alert('{{ addslashes($item->penerangan) }}'); return false;"> Baca Lagi</a>
                            @endif
                        </td>
                        <td><img src="{{ asset('storage/' . $item->gambar) }}" width="50"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.katelog.modal-add')
@include('admin.katelog.modal-edit')

<script>
    function editKatalog(id) {
        fetch(`/admin/katelog/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editNama').value = data.nama;
                document.getElementById('editKategori').value = data.kategori;
                document.getElementById('editWarna').value = data.warna;
                // document.getElementById('editSaiz').value = data.saiz;
                // document.getElementById('editHarga').value = data.harga;
                document.getElementById('editPenerangan').value = data.penerangan;

                // Ini fix penting supaya action form betul
                document.getElementById('editProductForm').action = `/admin/katelog/update/${id}`;

        });
}
</script>
@endsection
