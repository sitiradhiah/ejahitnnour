
@extends('layouts.admin-main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>TEMPAHAN JAHITAN</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow p-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Borang Kemaskini Tempahan</h4>
                                <a href="{{ route('tempahan.senarai') }}" class="btn btn-sm btn-secondary ms-2">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('tempahan.update', $tempahan->id) }}" method="POST" class="px-3">
                            @csrf
                            @method('PUT')

                            <!-- Nama Pelanggan -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                                        value="{{ old('nama_pelanggan', $tempahan->nama_pelanggan) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="nombor_telefon" class="form-label">Nombor Telefon</label>
                                    <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon"
                                        value="{{ old('nombor_telefon', $tempahan->nombor_telefon) }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="1">{{ old('alamat', $tempahan->alamat) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_tempahan" class="form-label">Jenis Tempahan</label>
                                    <select class="form-control" id="jenis_tempahan" name="jenis_tempahan" required>
                                        @foreach(['Baju Kurung','Baju Melayu','Blouse','Jubah','Kemeja','Seluar','Pakaian Kanak-Kanak','Custom'] as $jenis)
                                            <option value="{{ $jenis }}" {{ old('jenis_tempahan', $tempahan->jenis_tempahan) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="tarikh_tempahan" class="form-label">Tarikh Tempahan</label>
                                    <input type="date" class="form-control" id="tarikh_tempahan" name="tarikh_tempahan"
                                        value="{{ old('tarikh_tempahan', $tempahan->tarikh_tempahan) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="size" class="form-label">Saiz</label>
                                    <select class="form-control" id="size" name="size" required>
                                        @foreach(['S','M','L','XL','Custom'] as $saiz)
                                            <option value="{{ $saiz }}" {{ old('size', $tempahan->size) == $saiz ? 'selected' : '' }}>{{ $saiz }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="chest_size" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="chest_size" name="chest_size"
                                        value="{{ old('chest_size', $tempahan->chest_size) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="waist_size" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="waist_size" name="waist_size"
                                        value="{{ old('waist_size', $tempahan->waist_size) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                    <input type="text" class="form-control" id="jenis_kain" name="jenis_kain"
                                        value="{{ old('jenis_kain', $tempahan->jenis_kain) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="warna_kain" class="form-label">Warna Kain</label>
                                    <input type="text" class="form-control" id="warna_kain" name="warna_kain"
                                        value="{{ old('warna_kain', $tempahan->warna_kain) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="harga_tempahan" class="form-label">Harga Tempahan (RM)</label>
                                    <input type="number" class="form-control" id="harga_tempahan" name="harga_tempahan"
                                        value="{{ old('harga_tempahan', $tempahan->harga_tempahan) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="additional_notes" class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" id="additional_notes" name="additional_notes" rows="1">{{ old('additional_notes', $tempahan->additional_notes) }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100">Kemaskini</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Dummy data for existing users (optional if you're not using dynamic fetching)
    document.getElementById('existing_user').addEventListener('change', function () {
        var selectedUserId = this.value;

        // Fetch the selected user details and populate the form fields if needed
        // You can use AJAX to fetch the data if you prefer dynamic population
    });
</script>
@endsection

