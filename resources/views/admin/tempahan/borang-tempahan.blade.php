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
                            <div class="mb-3">
                                <label for="existing_user" class="form-label">Pilih Pengguna Sedia Ada</label>
                                <select class="form-control" id="existing_user" name="existing_user">
                                    <option value="" disabled selected>Pilih Pengguna</option>
                                    @foreach($tempahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_pelanggan }} ({{ $item->nombor_telefon }})</option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- Maklumat Pelanggan -->
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
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                            </div>

                            <!-- Tempahan -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jenis_tempahan" class="form-label">Jenis Tempahan</label>
                                    <select class="form-control" id="jenis_tempahan" name="jenis_tempahan" required>
                                        <option disabled selected>Pilih Jenis Tempahan</option>
                                        @foreach(['Baju Kurung','Baju Melayu','Blouse','Jubah','Kemeja','Seluar','Pakaian Kanak-Kanak','Custom'] as $jenis)
                                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tarikh_tempahan" class="form-label">Tarikh Tempahan</label>
                                    <input type="date" class="form-control" id="tarikh_tempahan" name="tarikh_tempahan" required>
                                </div>
                            </div>

                            <!-- Ukuran -->
                            <h5 class="mb-3">Ukuran Badan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ukuran_dada" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_dada" name="ukuran_dada">
                                </div>
                                <div class="col-md-6">
                                    <label for="ukuran_pinggang" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_pinggang" name="ukuran_pinggang">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lebar_bahu" class="form-label">Lebar Bahu (cm)</label>
                                    <input type="number" class="form-control" id="lebar_bahu" name="lebar_bahu">
                                </div>
                                <div class="col-md-6">
                                    <label for="panjang_lengan" class="form-label">Panjang Lengan (cm)</label>
                                    <input type="number" class="form-control" id="panjang_lengan" name="panjang_lengan">
                                </div>
                            </div>

                            <!-- Kain -->
                            <h5 class="mb-3">Maklumat Kain</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                    <input type="text" class="form-control" id="jenis_kain" name="jenis_kain">
                                </div>
                                <div class="col-md-6">
                                    <label for="warna_kain" class="form-label">Warna Kain</label>
                                    <input type="text" class="form-control" id="warna_kain" name="warna_kain">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="size" class="form-label">Saiz</label>
                                    <select class="form-control" id="size" name="size">
                                        <option disabled selected>Pilih Saiz</option>
                                        @foreach(['S','M','L','XL','Custom'] as $saiz)
                                            <option value="{{ $saiz }}">{{ $saiz }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="harga_tempahan" class="form-label">Harga Tempahan (RM)</label>
                                    <input type="number" class="form-control" id="harga_tempahan" name="harga_tempahan">
                                </div>
                            </div>

                            <!-- Nota Tambahan -->
                            <div class="mb-3">
                                <label for="catatan_tambahan" class="form-label">Catatan Tambahan</label>
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
    document.getElementById('existing_user').addEventListener('change', function () {
        var selectedId = this.value;

        // Correct the fetch URL
        fetch(`/admin/tempahan/pelanggan/${selectedId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('nama_pelanggan').value = data.nama_pelanggan || '';
                document.getElementById('nombor_telefon').value = data.nombor_telefon || '';
                document.getElementById('alamat').value = data.alamat || '';
                document.getElementById('jenis_tempahan').value = data.jenis_tempahan || '';
                document.getElementById('tarikh_tempahan').value = (data.tarikh_tempahan || '').substring(0,10);
                document.getElementById('ukuran_dada').value = data.chest_size || '';
                document.getElementById('ukuran_pinggang').value = data.waist_size || '';
                document.getElementById('lebar_bahu').value = data.shoulder_width || '';
                document.getElementById('panjang_lengan').value = data.sleeve_length || '';
                document.getElementById('jenis_kain').value = data.jenis_kain || '';
                document.getElementById('warna_kain').value = data.warna_kain || '';
                document.getElementById('size').value = data.size || '';
                document.getElementById('harga_tempahan').value = data.harga_tempahan || '';
                document.getElementById('catatan_tambahan').value = data.additional_notes || '';
            })
            .catch(error => console.error('Gagal ambil data pelanggan:', error));
    });
    </script>
@endsection
