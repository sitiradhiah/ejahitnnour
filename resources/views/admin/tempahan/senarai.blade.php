@extends('layouts.admin-main')
@section('title', 'Senarai Tempahan')

@section('css')
<style>
    .card {
        margin-bottom: 20px;
    }
    .btn-generate {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-generate:hover {
        background-color: #0056b3;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Tempahan Jahitan</h3>
</div>
<div class="container">
    <div id="alert-container" class="alert alert-success d-none mt-3" role="alert"></div>

    <div class="card shadow p-3">
        <div class="card-header">
            <label class="me-2 fw-bold text-dark text-decoration-underline">Tapisan</label>
            <form method="GET" action="{{ route('tempahan.senarai') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-auto me-2">
                        <label for="jenis_tempahan" class="form-label mb-1">Jenis Tempahan (Kategori):</label>
                        <select name="jenis_tempahan" id="jenis_tempahan" class="form-select form-select-sm">
                            <option value="">--Semua--</option>
                            @php $jenisOptions = \DB::table('tempahans')->distinct()->pluck('jenis_tempahan'); @endphp
                            @foreach($jenisOptions as $jenis)
                                @if(!is_null($jenis))
                                    <option value="{{ $jenis }}" {{ request('jenis_tempahan') == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-auto me-2">
                        <label for="status" class="form-label mb-1">Status:</label>
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="">--Semua--</option>
                            @foreach($statusList as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-auto me-2">
                        <label for="search" class="form-label mb-1">Carian Nama / No Tel:</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Masukkan Cari...">
                    </div>
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="fa fa-filter"></i> Tapis
                        </button>
                    </div>
                    <div class="col-12 col-md-auto">
                        <a href="{{ route('tempahan.baru') }}" class="btn btn-success btn-sm w-100">
                            <i class="fa fa-plus"></i> Borang Tempahan Baru
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <label class="me-2 fw-bold text-dark text-decoration-underline">Senarai Tempahan</label>
            <div class="table-responsive">
                <table class="table table-striped table-bordered paginated-table" data-per-page="10" data-pagination-id="pagination-tempahan">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Tarikh Tempahan</th>
                            <th>Jenis Tempahan (Kategori)</th>
                            <th>Nama Reka Bentuk</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Pekerja</th>
                            <th style="text-align: center;">Harga (RM)</th>
                            <th>Tukar Status ?</th>
                            <th style="width: 15%; text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tempahan->isEmpty())
                            <tr>
                                <td colspan="8" style="padding: 15px 0 !important;" class="text-center text-muted">Tiada tempahan dijumpai.</td>
                            </tr>
                        @else
                            @foreach($tempahan as $index => $item)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td style="text-align: center;">{{ $item->tarikh_tempahan }}</td>
                            <td style="text-align: center;">{{ $item->jenis_tempahan }}</td>
                            <td style="text-align: center;">{{ $item->nama_design }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->pekerja->name ?? '-- Pekerja belum ditugaskan --' }}</td>
                            <td style="text-align: center;">{{ number_format($item->harga_tempahan, 2) }}</td>
                            <td style="text-align: center;">
                                <select class="form-control status-dropdown" data-tempahan-id="{{ $item->id }}" data-initial-status="{{ $item->status }}">
                                    <option value="Pra-tempahan"
                                        {{ $item->status == 'Pra-tempahan' ? 'selected disabled' : 'disabled' }}>
                                        Pra-Tempahan
                                    </option>
                                    <option value="Tempahan Baru" {{ $item->status == 'Tempahan Baru' ? 'selected' : '' }}>Tempahan Baru</option>
                                    <option value="Dalam Pelaksanaan" {{ $item->status == 'Dalam Pelaksanaan' ? 'selected' : '' }}>Dalam Pelaksanaan</option>
                                    <option value="Sudah Selesai" {{ $item->status == 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                </select>
                                <span id="status-{{ $item->id }}" style="display:none;">{{ $item->status }}</span>
                            </td>
                                    <!-- data-idpekerja="{{ $item->idPekerja }}" -->
                            <td style="text-align: center;">
                                <button class="btn btn-sm btn-info btn-view"
                                    data-id="{{ $item->id }}"
                                    data-nama_pekerja="{{ $item->pekerja->name ?? 'Pekerja belum ditugaskan' }}"
                                    data-idpelanggan="{{ $item->idPelanggan }}"
                                    data-nama_pelanggan="{{ $item->nama_pelanggan }}"
                                    data-nombor_telefon="{{ $item->nombor_telefon }}"
                                    data-alamat="{{ $item->alamat }}"
                                    data-jenis_tempahan="{{ $item->jenis_tempahan }}"
                                    data-nama_design="{{ $item->nama_design }}"
                                    data-tarikh_tempahan="{{ $item->tarikh_tempahan }}"
                                    data-harga_tempahan="{{ number_format($item->harga_tempahan, 2) }}"
                                    data-additional_notes="{{ $item->additional_notes }}"
                                    data-chest_size="{{ $item->chest_size }}"
                                    data-waist_size="{{ $item->waist_size }}"
                                    data-shoulder_width="{{ $item->shoulder_width }}"
                                    data-sleeve_length="{{ $item->sleeve_length }}"
                                    data-size="{{ $item->size }}"
                                    data-jenis_kain="{{ $item->jenis_kain }}"
                                    data-warna_kain="{{ $item->warna_kain }}"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>

                                <a href="{{ route('tempahan.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('tempahan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <ul class="pagination justify-content-center mt-3" id="pagination-tempahan"></ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dynamicViewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Maklumat Tempahan Penuh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" style="font-size: 0.95rem;">

                {{-- Maklumat Rekod --}}
                <h6 class="text-center mb-2">Maklumat Rekod</h6>
                <table class="table styled-table mb-3">
                    <tr><th>ID Tempahan</th><td id="modal-id"></td></tr>
                    <tr><th>Nama Pekerja</th><td id="modal-nama_pekerja"></td></td></tr>
                    <!-- <tr><th>ID Pelanggan</th><td id="modal-idPelanggan"></td></tr> -->
                </table>

                {{-- Maklumat Pelanggan --}}
                <h6 class="text-center mb-2">Maklumat Pelanggan</h6>
                <table class="table styled-table mb-3">
                    <tr><th>Nama Pelanggan</th><td id="modal-nama_pelanggan"></td></tr>
                    <tr><th>Nombor Telefon</th><td id="modal-nombor_telefon"></td></tr>
                    <tr><th>Alamat</th><td id="modal-alamat"></td></tr>
                </table>

                {{-- Maklumat Tempahan --}}
                <h6 class="text-center mb-2">Maklumat Tempahan</h6>
                <table class="table styled-table mb-3">
                    <tr><th>Jenis Tempahan</th><td id="modal-jenis_tempahan"></td></tr>
                    <tr><th>Nama Rekaan</th><td id="modal-nama_design"></td></tr>
                    <tr><th>Tarikh Tempahan</th><td id="modal-tarikh_tempahan"></td></tr>
                    <tr><th>Harga (RM)</th><td id="modal-harga_tempahan"></td></tr>
                    <tr><th>Catatan Tambahan</th><td id="modal-additional_notes"></td></tr>
                </table>

                {{-- Ukuran Badan --}}
                <h6 class="text-center mb-2">Ukuran Badan</h6>
                <table class="table styled-table mb-3">
                    <tr><th>Ukuran Dada</th><td id="modal-chest_size"></td></tr>
                    <tr><th>Ukuran Pinggang </th><td id="modal-waist_size"></td></tr>
                    <tr><th>Ukuran Bahu </th><td id="modal-shoulder_width"></td></tr>
                    <tr><th>Ukuran Lengan </th><td id="modal-sleeve_length"></td></tr>
                    <tr><th>Ukuran Umum</th><td id="modal-size"></td></tr>
                </table>

                {{-- Maklumat Kain --}}
                <h6 class="text-center mb-2">Maklumat Kain</h6>
                <table class="table styled-table mb-3">
                    <tr><th>Jenis Kain</th><td id="modal-jenis_kain"></td></tr>
                    <tr><th>Warna Kain</th><td id="modal-warna_kain"></td></tr>
                </table>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div> -->
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
    <div id="statusToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toast-message">
                Status tempahan berjaya dikemaskini.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$('.btn-view').click(function() {
    $('#modal-id').text($(this).data('id'));
    // $('#modal-idPekerja').text($(this).data('idpekerja'));
    $('#modal-nama_pekerja').text($(this).data('nama_pekerja'));
    $('#modal-idPelanggan').text($(this).data('idpelanggan'));
    $('#modal-nama_pelanggan').text($(this).data('nama_pelanggan'));
    $('#modal-nombor_telefon').text($(this).data('nombor_telefon'));
    $('#modal-alamat').text($(this).data('alamat'));

    $('#modal-jenis_tempahan').text($(this).data('jenis_tempahan'));
    $('#modal-nama_design').text($(this).data('nama_design'));
    $('#modal-tarikh_tempahan').text($(this).data('tarikh_tempahan'));
    $('#modal-harga_tempahan').text($(this).data('harga_tempahan'));
    $('#modal-additional_notes').text($(this).data('additional_notes'));

    $('#modal-chest_size').text($(this).data('chest_size'));
    $('#modal-waist_size').text($(this).data('waist_size'));
    $('#modal-shoulder_width').text($(this).data('shoulder_width'));
    $('#modal-sleeve_length').text($(this).data('sleeve_length'));
    $('#modal-size').text($(this).data('size'));

    $('#modal-jenis_kain').text($(this).data('jenis_kain'));
    $('#modal-warna_kain').text($(this).data('warna_kain'));

    $('#dynamicViewModal').modal('show');
});


</script>
<script>
    let currentFilterJenis = 'All';
    let currentFilterStatus = 'All';

    function applyFilters() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            const jenisTempahan = row.querySelector('td:nth-child(3)').textContent.trim();
            const statusTempahan = row.querySelector('td:nth-child(5)').textContent.trim();

            const matchJenis = (currentFilterJenis === 'All' || jenisTempahan === currentFilterJenis);
            const matchStatus = (currentFilterStatus === 'All' || statusTempahan === currentFilterStatus);

            if (matchJenis && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Penapis Jenis Tempahan
    document.querySelectorAll('.filter-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            currentFilterJenis = this.getAttribute('data-filter');
            applyFilters();
        });
    });

    // Penapis Status Tempahan
    document.querySelectorAll('.filter-status-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            currentFilterStatus = this.getAttribute('data-status');
            applyFilters();
        });
    });
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
$(document).ready(function() {

    // Simpan status asal sebelum tukar
    $(document).on('focusin', '.status-dropdown', function () {
        $(this).data('previous', this.value);
    });

    // Bila tukar dropdown status
    $(document).on('change', '.status-dropdown', function () {
        const currentSelect = $(this);
        const previous = currentSelect.data('previous');
        const current = currentSelect.val();
        const tempahanId = currentSelect.data('tempahan-id');

        // Jika tukar dari "Pra-tempahan", sahkan dahulu
        if (previous === 'Pra-tempahan') {
            const confirmChange = confirm("Anda tidak boleh memilih 'Pra-tempahan' semula selepas menukar status. Teruskan?");
            if (!confirmChange) {
                currentSelect.val(previous); // revert
                return; // stop AJAX
            }
        }

        // AJAX PATCH request
        $.ajax({
            url: '{{ route("tempahan.update.status", ":id") }}'.replace(':id', tempahanId),
            method: 'PATCH',
            data: { status: current, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    // Simpan mesej dalam sessionStorage supaya kekal selepas reload
                    sessionStorage.setItem('statusMessage', response.success);
                    location.reload(); // reload page
                }
            },
            error: function() {
                alert('Ralat semasa mengemaskini status.');
                currentSelect.val(previous);
            }
        });
    });

    // Selepas reload, paparkan mesej jika ada dalam sessionStorage
    const message = sessionStorage.getItem('statusMessage');
    if (message) {
        $('#alert-container')
            .removeClass('d-none')
            .text(message);

        setTimeout(function () {
            $('#alert-container').addClass('d-none').text('');
        }, 5000);

        sessionStorage.removeItem('statusMessage'); // padam selepas guna
    }
});
</script>

@endsection
