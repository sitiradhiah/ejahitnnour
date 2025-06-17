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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Borang Tempahan Baru</h4>
                            <a href="{{ route('tempahan.senarai') }}" class="btn btn-sm btn-secondary ms-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <form action="{{ route('tempahan.store') }}" method="POST" class="px-3">
                            @csrf

                            <!-- Pilih pengguna sedia ada -->
                            <!-- Nota: Hanya pengguna yang mempunyai nombor telefon akan dipaparkan di sini. -->
                            <!-- <div class="alert alert-info mb-2"> -->
                            <!-- </div> -->
                            <div class="mb-3">
                                <label  class="form-label">Pilih Pengguna Sedia Ada ?</label></br>
                                 <small>
                                    <strong>Nota:</strong> Hanya pengguna yang mempunyai nombor telefon akan dipaparkan di sini.
                                </small>
                                <select class="form-control mt-1" id="existing_user" name="existing_user"
                                    onchange="autoFillUser(this)">
                                    <option value="" disabled selected>Pilih Pengguna</option>
                                    @php
                                        $usedPhones = [];
                                    @endphp
                                    @foreach($users as $user)
                                        @if(
                                            !empty($user->phone) &&
                                            !in_array($user->phone, $usedPhones) &&
                                            !in_array($user->peranan, ['pentadbir', 'pekerja'])
                                        )
                                            <option
                                                value="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-phone="{{ $user->phone }}"
                                            >
                                                {{ $user->name }} ({{ $user->phone }})
                                            </option>
                                            @php $usedPhones[] = $user->phone; @endphp
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <!-- Maklumat Pelanggan -->
                             <h5 class="mb-3">Maklumat Pelanggan</h5>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan  <span style="color: red">***</span></label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="nombor_telefon" class="form-label">Nombor Telefon <span style="color: red">***</span></label>
                                    <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="alamat" class="form-label">Alamat </label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="1"></textarea>
                                </div>
                            </div>

                            <!-- Tempahan -->
                             <h5 class="mb-3">Maklumat Tempahan</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_tempahan" class="form-label">Kategori <span style="color: red">***</span></label>
                                    <select class="form-control" id="jenis_tempahan" name="jenis_tempahan" onchange="filterRekaBentuk()" required>
                                        <option value="" selected>--Pilih Jenis Kategori--</option>
                                        @foreach($katelogs->pluck('kategori')->unique() as $kategori)
                                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                                        @endforeach
                                        <option value="lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="reka_bentuk" class="form-label">Jenis Reka Bentuk </label>
                                    <select class="form-control" id="reka_bentuk" name="reka_bentuk" disabled>
                                        <option value="" selected>--Pilih Reka Bentuk--</option>
                                        @foreach($katelogs as $katelog)
                                            <option value="{{ $katelog->nama }}" data-jenis="{{ $katelog->kategori }}">{{ $katelog->nama }}</option>
                                        @endforeach
                                        <option value="lain-lain">Lain-lain</option>
                                    </select>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var jenisTempahan = document.getElementById('jenis_tempahan');
                                        var rekaBentuk = document.getElementById('reka_bentuk');
                                        jenisTempahan.addEventListener('change', function() {
                                            rekaBentuk.disabled = false;
                                        });
                                    });
                                    </script>
                                </div>
                                <div class="col-md-4">
                                    <label for="tarikh_tempahan" class="form-label">Tarikh Tempahan <span style="color: red">***</span></label>
                                    <input type="date" class="form-control" id="tarikh_tempahan" name="tarikh_tempahan" required>
                                </div>
                                @section('scripts')
                                @parent
                                <script>
                                function filterRekaBentuk() {
                                    var jenis = document.getElementById('jenis_tempahan').value;
                                    var rekaBentuk = document.getElementById('reka_bentuk');
                                    for (var i = 0; i < rekaBentuk.options.length; i++) {
                                        var opt = rekaBentuk.options[i];
                                        if (opt.value === "" || opt.getAttribute('data-jenis') === jenis) {
                                            opt.style.display = '';
                                        } else {
                                            opt.style.display = 'none';
                                        }
                                    }
                                    rekaBentuk.selectedIndex = 0;
                                }
                                </script>
                                @endsection
                            </div>

                            <!-- Ukuran -->
                            <h5 class="mb-3">Ukuran Badan</h5>
                            <div class="row mb-3">
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_dada" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_dada" name="ukuran_dada">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_pinggang" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_pinggang" name="ukuran_pinggang">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="lebar_bahu" class="form-label">Lebar Bahu (cm)</label>
                                    <input type="number" class="form-control" id="lebar_bahu" name="lebar_bahu">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="panjang_lengan" class="form-label">Panjang Lengan (cm)</label>
                                    <input type="number" class="form-control" id="panjang_lengan" name="panjang_lengan">
                                </div>
                            </div>

                            <!-- Kain -->
                            <h5 class="mb-3">Maklumat Kain</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                    <input type="text" class="form-control" id="jenis_kain" name="jenis_kain">
                                </div>
                                <div class="col-md-4">
                                    <label for="warna_kain" class="form-label">Warna Kain</label>
                                    <input type="text" class="form-control" id="warna_kain" name="warna_kain">
                                </div>
                                <div class="col-md-4">
                                    <label for="harga_tempahan" class="form-label">Harga Tempahan (RM)</label>
                                    <input type="number" class="form-control" id="harga_tempahan" name="harga_tempahan">
                                </div>
                            </div>

                            <!-- Nota Tambahan -->
                            <div class="mb-3">
                                 <h5 class="mb-3">Catatan Tambahan</h5>
                                <textarea class="form-control" id="catatan_tambahan" name="catatan_tambahan" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
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
function autoFillUser(select) {
    var selected = select.options[select.selectedIndex];
    var name = selected.getAttribute('data-name') || '';
    var phone = selected.getAttribute('data-phone') || '';
    if(name) document.getElementById('nama_pelanggan').value = name;
    if(phone) document.getElementById('nombor_telefon').value = phone;
}
</script>
@endsection
