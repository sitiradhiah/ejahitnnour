
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

                            <!-- Pilih pengguna sedia ada -->
                            <div class="mb-3">
                                <label class="form-label">Pengguna</label></br>
                                <small>
                                    <strong>Nota:</strong> Hanya pengguna yang mempunyai nombor telefon akan dipaparkan di sini.
                                </small>
                                <select class="form-control mt-1" id="existing_user" name="existing_user" disabled>
                                    <option value="" disabled>Pilih Pengguna</option>
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
                                                {{ $tempahan->user_id == $user->id ? 'selected' : '' }}
                                            >
                                                {{ $user->name }} ({{ $user->phone }})
                                            </option>
                                            @php $usedPhones[] = $user->phone; @endphp
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="existing_user" value="{{ $tempahan->user_id }}">
                            </div>
                            <!-- Maklumat Pelanggan -->
                            <h5 class="mb-3">Maklumat Pelanggan</h5>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $tempahan->nama_pelanggan) }}" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="nombor_telefon" class="form-label">Nombor Telefon</label>
                                    <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon" value="{{ old('nombor_telefon', $tempahan->nombor_telefon) }}">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="alamat" class="form-label">Alamat (optional)</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="1">{{ old('alamat', $tempahan->alamat) }}</textarea>
                                </div>
                            </div>

                            <!-- Tempahan -->
                            <h5 class="mb-3">Maklumat Tempahan</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_tempahan" class="form-label">Kategori</label>
                                    <select class="form-control" id="jenis_tempahan" name="jenis_tempahan" onchange="filterRekaBentuk()" required>
                                        <option value="">--Pilih Jenis Kategori--</option>
                                        @foreach($katelogs->pluck('kategori')->unique() as $kategori)
                                            <option value="{{ $kategori }}" {{ $tempahan->jenis_tempahan == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                        @endforeach
                                        <option value="lain-lain" {{ $tempahan->jenis_tempahan == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="reka_bentuk" class="form-label">Jenis Reka Bentuk (optional)</label>
                                    <select class="form-control" id="reka_bentuk" name="reka_bentuk">
                                        <option value="">--Pilih Reka Bentuk--</option>
                                        @foreach($katelogs as $katelog)
                                            <option value="{{ $katelog->nama }}" data-jenis="{{ $katelog->kategori }}" {{ $tempahan->reka_bentuk == $katelog->nama ? 'selected' : '' }}>{{ $katelog->nama }}</option>
                                        @endforeach
                                        <option value="lain-lain" {{ $tempahan->reka_bentuk == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                    </select>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var jenisTempahan = document.getElementById('jenis_tempahan');
                                        var rekaBentuk = document.getElementById('reka_bentuk');
                                        if(jenisTempahan.value) rekaBentuk.disabled = false;
                                        jenisTempahan.addEventListener('change', function() {
                                            rekaBentuk.disabled = false;
                                        });
                                    });
                                    </script>
                                </div>
                                <div class="col-md-4">
                                    <label for="tarikh_tempahan" class="form-label">Tarikh Tempahan</label>
                                    <input type="date" class="form-control" id="tarikh_tempahan" name="tarikh_tempahan" value="{{ old('tarikh_tempahan', $tempahan->tarikh_tempahan ? date('Y-m-d', strtotime($tempahan->tarikh_tempahan)) : '') }}" required>
                                </div>
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
                                // Auto-filter on load
                                document.addEventListener('DOMContentLoaded', function() {
                                    filterRekaBentuk();
                                });
                                </script>
                            </div>

                            <!-- Ukuran -->
                            <h5 class="mb-3">Ukuran Badan</h5>
                            <div class="row mb-3">
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_dada" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_dada" name="ukuran_dada" value="{{ old('ukuran_dada', $tempahan->ukuran_dada) }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_pinggang" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_pinggang" name="ukuran_pinggang" value="{{ old('ukuran_pinggang', $tempahan->ukuran_pinggang) }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="lebar_bahu" class="form-label">Lebar Bahu (cm)</label>
                                    <input type="number" class="form-control" id="lebar_bahu" name="lebar_bahu" value="{{ old('lebar_bahu', $tempahan->lebar_bahu) }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="panjang_lengan" class="form-label">Panjang Lengan (cm)</label>
                                    <input type="number" class="form-control" id="panjang_lengan" name="panjang_lengan" value="{{ old('panjang_lengan', $tempahan->panjang_lengan) }}">
                                </div>
                            </div>

                            <!-- Kain -->
                            <h5 class="mb-3">Maklumat Kain</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                    <input type="text" class="form-control" id="jenis_kain" name="jenis_kain" value="{{ old('jenis_kain', $tempahan->jenis_kain) }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="warna_kain" class="form-label">Warna Kain</label>
                                    <input type="text" class="form-control" id="warna_kain" name="warna_kain" value="{{ old('warna_kain', $tempahan->warna_kain) }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="harga_tempahan" class="form-label">Harga Tempahan (RM)</label>
                                    <input type="number" class="form-control" id="harga_tempahan" name="harga_tempahan" value="{{ old('harga_tempahan', $tempahan->harga_tempahan) }}">
                                </div>
                            </div>

                            <!-- Nota Tambahan -->
                            <div class="mb-3">
                                <h5 class="mb-3">Catatan Tambahan</h5>
                                <textarea class="form-control" id="catatan_tambahan" name="catatan_tambahan" rows="3">{{ old('catatan_tambahan', $tempahan->catatan_tambahan) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Kemaskini</button>
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

