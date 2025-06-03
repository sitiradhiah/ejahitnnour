@extends('layouts.admin-main')

@section('css')
<style>
    .page-heading {
        margin-bottom: 20px;
        text-align: center;
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
    <h3>Pengurusan Testimonial</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header d-flex justify-content-between">
            <h4>Senarai Testimonial</h4>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">Tambah Testimonial</button>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Maklum Balas</th>
                        <th>Gambar</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->feedback }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/images/' . $item->image) }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('testimonial.edit', $item->id) }}" class="btn-edit btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('testimonial.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete btn-sm" onclick="return confirm('Padam testimonial ini?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Testimonial --}}
@include('admin.maklumatsistem.testimonial-add')
@endsection
