@extends('layouts.admin-main')

@section('css')
<style>
    .h2-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .btn-add-item {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-add-item:hover {
        background-color: #218838;
    }

    .katelog-item {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        transition: transform 0.2s ease;
        padding: 15px;
    }

    .katelog-item:hover {
        transform: scale(1.05);
    }

    .katelog-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .katelog-item p {
        font-weight: bold;
        padding: 10px;
        margin: 0;
        font-size: 1.1rem;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding-top: 10px;
    }

    .btn-edit, .btn-delete {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-edit {
        background-color: #007bff;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .kategori-section {
        margin-bottom: 30px;
    }

    .kategori-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #b42e8b;
        padding-bottom: 10px;
    }

    .kategori-content {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

</style>
@endsection

@section('content')
<section class="katelog-section py-5">
    <div class="container">
        <h2 class="h2-custom">Pengurusan Katelog</h2>

        <!-- Butang Tambah Gambar -->
        <div class="text-end mb-4">
            <button class="btn-add-item" data-bs-toggle="modal" data-bs-target="#addImageModal">+ Tambah Gambar</button>
        </div>

        <!-- Modal Tambah Gambar -->
        <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addImageModalLabel">Tambah Gambar Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('katelog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Tajuk</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Baju Kurung Moden" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" class="form-select" required>
                                        <option value="Pakaian Harian">Pakaian Harian</option>
                                        <option value="Pakaian Rasmi">Pakaian Rasmi</option>
                                        <option value="Aksesori">Aksesori</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Pilih Gambar</label>
                                <input type="file" name="gambar" class="form-control" id="imageInput" required>
                            </div>
                            <div class="mb-3">
                                <div id="image-container">
                                    <!-- Cropped image will appear here -->
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Simpan Gambar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" />


        <!-- Paparan Mengikut Kategori -->
        @foreach(['Pakaian Harian', 'Pakaian Rasmi', 'Aksesori'] as $kategori)
        <div class="kategori-section">
            <div class="kategori-title">{{ $kategori }}</div>
            <div class="kategori-content">
                @foreach($katelogs->where('kategori', $kategori) as $item)
                <div class="katelog-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    <p>{{ $item->nama }}</p>
                    <div class="action-buttons">
                        <form action="{{ route('katelog.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nama" value="{{ $item->nama }}">
                            <input type="file" name="gambar" onchange="this.form.submit()" style="display:none;" id="fileInput-{{ $item->id }}">
                            <button type="button" class="btn-edit" onclick="document.getElementById('fileInput-{{ $item->id }}').click()">Kemaskini</button>
                        </form>
                        <form action="{{ route('katelog.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Padam</button>
                        </form>
                    </div>
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
    let cropper;
    document.getElementById('imageInput').addEventListener('change', function (e) {
        let reader = new FileReader();
        reader.onload = function (event) {
            let img = document.createElement('img');
            img.src = event.target.result;
            document.getElementById('image-container').innerHTML = '';
            document.getElementById('image-container').appendChild(img);
            cropper = new Cropper(img, {
                aspectRatio: 3/4, // Portrait aspect ratio
                viewMode: 1,
                responsive: true,
                autoCropArea: 0.8,
                minCropBoxWidth: 100,
                minCropBoxHeight: 200
            });
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
