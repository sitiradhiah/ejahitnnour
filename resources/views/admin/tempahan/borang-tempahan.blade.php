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
                                <label class="form-label">Pilih Maklumat Penempah Lama ?</label><br>
                                <small><strong>Nota:</strong> Anda hanya perlu memilih salah satu maklumat penempah jahitan sama ada mereka pelanggan atau (pekerja / pentadbir).</small>

                                <div class="row mt-2">
                                    <!-- Column 1: Pelanggan -->
                                    <div class="col-md-5">
                                        <label for="existing_user" class="form-label">Pelanggan</label>
                                        <select class="form-control" id="existing_user" name="existing_user" onchange="autoFillUser(this)">
                                            <option value="" disabled selected>Pilih Pengguna</option>
                                            @php $usedPhones = []; @endphp
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
                                                        data-email="{{ $user->email }}"
                                                    >
                                                        {{ $user->name }} ({{ $user->phone }})
                                                    </option>
                                                    @php $usedPhones[] = $user->phone; @endphp
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Column 2: Pekerja / Pentadbir -->
                                    <div class="col-md-5">
                                        <label for="pekerja_id" class="form-label">Pekerja / Pentadbir</label>
                                        <select class="form-control" id="pekerja_id" name="pekerja_id" onchange="autoFillPekerja(this)">
                                            <option value="" disabled selected>Pilih Pengguna</option>
                                            @foreach($pekerjas as $pekerja)
                                                <option value="{{ $pekerja->id }}"
                                                 data-name="{{ $pekerja->name }}"
                                                data-phone="{{ $pekerja->phone }}"
                                                data-email="{{ $pekerja->email }}">
                                                    {{ $pekerja->name }} ({{ $pekerja->peranan }}) - ({{ $pekerja->phone }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="clearSelections()">
                                            Kosongkan Pilihan
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Maklumat Pelanggan -->
                             <h5 class="mb-3">Maklumat Pelanggan</h5>
                            <div class="row mb-3">
                                <div class="col-12 col-md-3">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan  <span style="color: red">***</span></label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="nombor_telefon" class="form-label">Nombor Telefon <span style="color: red">***</span></label>
                                    <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon" required>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="email" class="form-label">Emel <span style="color: red">***</span></label>
                                    <input type="text" class="form-control" id="email" name="email" required style="text-transform: lowercase;" oninput="this.value = this.value.toLowerCase();">
                                </div>
                                <div class="col-12 col-md-3">
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
                            <!-- Info Button & Modal Trigger -->
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="mb-0 me-3">Ukuran Badan</h5>
                                <button type="button" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#infoModal">
                                    click untuk info <i class="bi bi-info-circle"></i>
                                </button>
                            </div>

                            <!-- Info Modal -->
                            <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModalLabel">Cara Pengiraan Anggaran Kain</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Pengiraan ini berdasarkan ukuran badan (dada, pinggang, bahu, lengan) dan direka untuk baju berlengan panjang menggunakan kain lebar 60 inci.</p>
                                        <p><strong>Formula:</strong></p>
                                        <code>(Ukuran Dada + 10) × 2 ÷ 100 + 0.5 (lengan) + 0.3 (seam) = jumlah meter kain</code>
                                        <p>Jumlah ini adalah anggaran minimum untuk disediakan oleh tukang jahit.</p>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_dada" class="form-label">Ukuran Dada (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_dada" name="ukuran_dada" value="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="ukuran_pinggang" class="form-label">Ukuran Pinggang (cm)</label>
                                    <input type="number" class="form-control" id="ukuran_pinggang" name="ukuran_pinggang" value="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="lebar_bahu" class="form-label">Lebar Bahu (cm)</label>
                                    <input type="number" class="form-control" id="lebar_bahu" name="lebar_bahu" value="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="panjang_lengan" class="form-label">Panjang Lengan (cm)</label>
                                    <input type="number" class="form-control" id="panjang_lengan" name="panjang_lengan" value="">
                                </div>
                            </div>
                            <div id="fabric_estimate" class="alert alert-warning d-none">
                                <strong>Anggaran Kain Diperlukan:</strong> <span id="kainMeter"></span> meter
                            </div>

                           <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const dadaInput = document.getElementById('ukuran_dada');
                                const pinggangInput = document.getElementById('ukuran_pinggang');
                                const bahuInput = document.getElementById('lebar_bahu');
                                const lenganInput = document.getElementById('panjang_lengan');
                                const kainText = document.getElementById('kainMeter');
                                const fabricEstimateDiv = document.getElementById('fabric_estimate');

                                function calculateFabric() {
                                    const dada = parseFloat(dadaInput.value);
                                    const pinggang = parseFloat(pinggangInput.value);
                                    const bahu = parseFloat(bahuInput.value);
                                    const lengan = parseFloat(lenganInput.value);

                                    // Check if all fields have valid numbers
                                    if (!isNaN(dada) && !isNaN(pinggang) && !isNaN(bahu) && !isNaN(lengan)) {
                                        const body = (dada + pinggang + bahu) / 100;
                                        const sleeve = (lengan * 2) / 100;
                                        const seam = 0.3;
                                        const total = body + sleeve + seam;

                                        const rounded = Math.ceil(total * 4) / 4; // Round up to nearest 0.25
                                        kainText.textContent = rounded.toFixed(2);
                                        fabricEstimateDiv.classList.remove('d-none');
                                    } else {
                                        kainText.textContent = "";
                                        fabricEstimateDiv.classList.add('d-none');
                                    }
                                }

                                // Attach listener to all 4 fields
                                [dadaInput, pinggangInput, bahuInput, lenganInput].forEach(input => {
                                    input.addEventListener('input', calculateFabric);
                                });

                                // Run on page load if values are already filled
                                calculateFabric();
                            });
                            </script>

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

                            <h5 class="mb-3">Maklumat Pekerja</h5>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Adakah anda yang akan membuat tugasan ini?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pekerja_bertugas" id="pekerja_ya" value="1" required>
                                        <label class="form-check-label" for="pekerja_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pekerja_bertugas" id="pekerja_tidak" value="0" required>
                                        <label class="form-check-label" for="pekerja_tidak">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Jika tidak, sila pilih pekerja yang akan membuat tugasan ini.</small>
                                    <select class="form-control mt-2" id="pekerja_id" name="pekerja_id">
                                        <option value="" selected>--Pilih Pekerja--</option>
                                        @foreach($pekerjas as $pekerja)
                                            <option value="{{ $pekerja->id }}">{{ $pekerja->name }}</option>
                                        @endforeach
                                    </select>
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
    var email = selected.getAttribute('data-email') || '';
    if(name) document.getElementById('nama_pelanggan').value = name;
    if(phone) document.getElementById('nombor_telefon').value = phone;
    if(email) document.getElementById('email').value = email;

     // Make inputs readonly
    document.getElementById('nama_pelanggan').readOnly = true;
    document.getElementById('nombor_telefon').readOnly = true;
    document.getElementById('email').readOnly = true;

    // Clear pekerja selection
    var pekerjaSelect = document.getElementById('pekerja_id');
    if (pekerjaSelect) pekerjaSelect.selectedIndex = 0;
}
function autoFillPekerja(select) {
    var selected = select.options[select.selectedIndex];
    var name = selected.getAttribute('data-name') || '';
    var phone = selected.getAttribute('data-phone') || '';
    var email = selected.getAttribute('data-email') || '';

    document.getElementById('nama_pelanggan').value = name;
    document.getElementById('nombor_telefon').value = phone;
    document.getElementById('email').value = email;

     // Make inputs readonly
    document.getElementById('nama_pelanggan').readOnly = true;
    document.getElementById('nombor_telefon').readOnly = true;
    document.getElementById('email').readOnly = true;

    // Clear pelanggan selection
    var pelangganSelect = document.getElementById('existing_user');
    if (pelangganSelect) pelangganSelect.selectedIndex = 0;
}

function clearSelections() {
    // Clear both selects
    const userSelect = document.getElementById('existing_user');
    const pekerjaSelect = document.getElementById('pekerja_id');
    if (userSelect) userSelect.selectedIndex = 0;
    if (pekerjaSelect) pekerjaSelect.selectedIndex = 0;

    // Clear the auto-filled fields
    document.getElementById('nama_pelanggan').value = '';
    document.getElementById('nombor_telefon').value = '';
    document.getElementById('email').value = '';
    
    document.getElementById('nama_pelanggan').readOnly = false;
    document.getElementById('nombor_telefon').readOnly = false;
    document.getElementById('email').readOnly = false;
}
</script>
<script>
document.querySelectorAll('input[name="pekerja_bertugas"]').forEach(function(elem) {
    elem.addEventListener('change', function() {
        const dropdown = document.getElementById('pekerja_id');
        if (this.value == '0') {
            dropdown.disabled = false;
        } else {
            dropdown.disabled = true;
            dropdown.selectedIndex = 0; // reset selection
        }
    });
});
</script>
@endsection
