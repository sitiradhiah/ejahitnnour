
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
                                    <select class="form-control" id="existing_user">
                                        <option value="" disabled selected>Pilih Pengguna</option>
                                        <option value="user1">Ali Bin Ahmad</option>
                                        <option value="user2">Siti Binti Hassan</option>
                                        <option value="user3">Abu Bin Kassim</option>
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
    // Dummy data for existing users
    const userData = {
        user1: {
            nama: "Ali Bin Ahmad",
            telefon: "0123456789",
            alamat: "123, Jalan Merah, Kuala Lumpur",
            chest_size: 100,
            waist_size: 90,
            shoulder_width: 50,
            sleeve_length: 60
        },
        user2: {
            nama: "Siti Binti Hassan",
            telefon: "0134567890",
            alamat: "456, Taman Hijau, Selangor",
            chest_size: 95,
            waist_size: 85,
            shoulder_width: 48,
            sleeve_length: 58
        },
        user3: {
            nama: "Abu Bin Kassim",
            telefon: "0145678901",
            alamat: "789, Kampung Biru, Johor",
            chest_size: 110,
            waist_size: 100,
            shoulder_width: 55,
            sleeve_length: 65
        }
    };

    document.getElementById('existing_user').addEventListener('change', function () {
        const selectedUser = this.value;
        if (userData[selectedUser]) {
            document.getElementById('nama_pelanggan').value = userData[selectedUser].nama;
            document.getElementById('nombor_telefon').value = userData[selectedUser].telefon;
            document.getElementById('alamat').value = userData[selectedUser].alamat;
            document.getElementById('chest_size').value = userData[selectedUser].chest_size;
            document.getElementById('waist_size').value = userData[selectedUser].waist_size;
            document.getElementById('shoulder_width').value = userData[selectedUser].shoulder_width;
            document.getElementById('sleeve_length').value = userData[selectedUser].sleeve_length;
        }
    });
</script>
@endsection
           