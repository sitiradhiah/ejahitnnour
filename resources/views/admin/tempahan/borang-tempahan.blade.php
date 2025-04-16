
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
                                <h4 class="mb-0">Borang Tempahan Baru</h4>
                                <a href="{{ route('tempahan.senarai') }}" class="btn btn-secondary ms-2">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('tempahan.store') }}" method="POST" class="px-3">
                            @csrf
                            <!-- Select Existing User -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="existing_user" class="form-label">Pilih Pengguna Sedia Ada</label>
                                    <select class="form-control" id="existing_user" name="existing_user">
                                        <option value="" disabled selected>Pilih Pengguna</option>
                                        @foreach($tempahan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_pelanggan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Customer and Order Details -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombor_telefon" class="form-label">Nombor Telefon</label>
                                    <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Remaining Form Fields -->
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="jenis_tempahan" class="form-label">Jenis Tempahan</label>
                                    <select class="form-control" id="jenis_tempahan" name="jenis_tempahan" required>
                                        <option value="" disabled selected>Pilih Jenis Tempahan</option>
                                        <option value="Baju Kurung">Baju Kurung</option>
                                        <option value="Baju Melayu">Baju Melayu</option>
                                        <option value="Blouse">Blouse</option>
                                        <option value="Jubah">Jubah</option>
                                        <option value="Kemeja">Kemeja</option>
                                        <option value="Seluar">Seluar</option>
                                        <option value="Pakaian Kanak-Kanak">Pakaian Kanak-Kanak</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="tarikh_tempahan" class="form-label">Tarikh Tempahan</label>
                                    <input type="date" class="form-control" id="tarikh_tempahan" name="tarikh_tempahan" required>
                                </div>
                            </div>

                            <!-- Measurements -->
                            <h5 class="mb-3">Ukuran Badan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="chest_size" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="chest_size" name="chest_size" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="waist_size" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="waist_size" name="waist_size" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="shoulder_width" class="form-label">Lebar Bahu (cm)</label>
                                    <input type="number" class="form-control" id="shoulder_width" name="shoulder_width" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sleeve_length" class="form-label">Panjang Lengan (cm)</label>
                                    <input type="number" class="form-control" id="sleeve_length" name="sleeve_length" required>
                                </div>
                            </div>

                            <!-- Fabric and Size Details -->
                            <h5 class="mb-3">Maklumat Kain</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                    <input type="text" class="form-control" id="jenis_kain" name="jenis_kain" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="warna_kain" class="form-label">Warna Kain</label>
                                    <input type="text" class="form-control" id="warna_kain" name="warna_kain" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="size" class="form-label">Saiz</label>
                                    <select class="form-control" id="size" name="size" required>
                                        <option value="" disabled selected>Pilih Saiz</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="harga_tempahan" class="form-label">Harga Tempahan (RM)</label>
                                    <input type="number" class="form-control" id="harga_tempahan" name="harga_tempahan" required>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="additional_notes" class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">Simpan</button>
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
           