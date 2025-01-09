@extends('layouts.main')

@section('css')
<style>
    .h2-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .kategori-section {
        margin-bottom: 40px;
    }

    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #f8f8f8;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .kategori-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .btn-add-item {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-add-item:hover {
        background-color: #218838;
    }

    .kategori-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px 0;
    }

    .katalog-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .katalog-item img {
        max-width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background-color: #007bff;
        color: white;
        margin-right: 5px;
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
</style>
@endsection

@section('content')
<section class="katalog-section py-5">
    <div class="container">
        <h2 class="h2-custom">Pengurusan Katalog</h2>

        <!-- Loop through categories -->
        @foreach(['Pakaian Harian', 'Pakaian Rasmi', 'Aksesori'] as $kategori)
        <div class="kategori-section">
            <!-- Header -->
            <div class="kategori-header">
                <span class="kategori-title">{{ $kategori }}</span>
            </div>

            <!-- Borang Tambah Gambar -->
            <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data" style="margin: 20px 0;">
                @csrf
                <input type="text" name="nama" placeholder="Nama Item" required style="margin-right: 10px; padding: 5px; width: 20%;">
                <select name="kategori" required style="margin-right: 10px; padding: 5px; width: 20%;">
                    <option value="Pakaian Harian" {{ $kategori == 'Pakaian Harian' ? 'selected' : '' }}>Pakaian Harian</option>
                    <option value="Pakaian Rasmi" {{ $kategori == 'Pakaian Rasmi' ? 'selected' : '' }}>Pakaian Rasmi</option>
                    <option value="Aksesori" {{ $kategori == 'Aksesori' ? 'selected' : '' }}>Aksesori</option>
                </select>
                <input type="file" name="gambar" required style="margin-right: 10px; padding: 5px; width: 20%;">
                <button type="submit" class="btn-add-item" style="padding: 5px 10px;">Tambah Gambar</button>
            </form>
            <!-- Katalog Content -->
            <div class="kategori-content">
                @foreach($katalogs->where('kategori', $kategori) as $item)
                <div class="katalog-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    <p>{{ $item->nama }}</p>
                    <form action="{{ route('katalog.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="nama" value="{{ $item->nama }}" placeholder="Nama Item" required>
                        <input type="file" name="gambar">
                        <button type="submit" class="btn-edit">Kemaskini</button>
                    </form>
                    <form action="{{ route('katalog.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Padam</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Handle add, edit, delete button functionality (if needed)
    document.addEventListener("DOMContentLoaded", function () {
        // Add custom JS logic here if required
    });
</script>
@endsection
