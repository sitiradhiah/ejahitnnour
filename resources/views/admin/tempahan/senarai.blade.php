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
                            <th style="text-align: center;">Harga (RM)</th>
                            <th>Tukar Status ?</th>
                            <th style="width: 15%; text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tempahan as $index => $item)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td style="text-align: center;">{{ $item->tarikh_tempahan }}</td>
                            <td style="text-align: center;">{{ $item->jenis_tempahan }}</td>
                            <td style="text-align: center;">{{ $item->nama_design }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td style="text-align: center;">{{ number_format($item->harga_tempahan, 2) }}</td>
                            <td style="text-align: center;">
                                <select class="form-control status-dropdown" data-tempahan-id="{{ $item->id }}">
                                    <option value="Dalam Pelaksanaan" {{ $item->status == 'Dalam Pelaksanaan' ? 'selected' : '' }}>Dalam Pelaksanaan</option>
                                    <option value="Sudah Selesai" {{ $item->status == 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                    <option value="Pra-tempahan" {{ $item->status == 'Pra-tempahan' ? 'selected' : '' }}>Pra-Tempahan</option>
                                </select>
                                <span id="status-{{ $item->id }}" style="display:none;">{{ $item->status }}</span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-info btn-sm btn-view"
                                        data-id="{{ $item->id }}"
                                        data-nama_pelanggan="{{ $item->nama_pelanggan }}"
                                        data-tarikh_tempahan="{{ $item->tarikh_tempahan }}"
                                        data-jenis_tempahan="{{ $item->jenis_tempahan }}"
                                        data-status="{{ $item->status }}"
                                        data-harga_tempahan="{{ number_format($item->harga_tempahan, 2) }}">
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
                    </tbody>
                </table>
                <ul class="pagination justify-content-center mt-3" id="pagination-tempahan"></ul>
            </div>
        </div>
    </div>
</div>

<!-- ✅ SINGLE REUSABLE MODAL -->
<div class="modal fade" id="dynamicViewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Maklumat Tempahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-2 text-center">Maklumat Pelanggan</h6>
                <table class="table table-striped table-bordered mb-0" style="font-size: 0.95rem;">
                    <tr>
                        <th style="width: 40%;">Nama Pelanggan</th>
                        <td id="modal-nama_pelanggan"></td>
                    </tr>
                </table>

                <h6 class="mb-2 text-center">Maklumat Tempahan</h6>
                <table class="table table-striped table-bordered mb-3" style="font-size: 0.95rem;">
                    <tr>
                        <th style="width: 40%;">Tarikh Tempahan</th>
                        <td id="modal-tarikh_tempahan"></td>
                    </tr>
                    <tr>
                        <th>Jenis Tempahan</th>
                        <td id="modal-jenis_tempahan"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="modal-status"></td>
                    </tr>
                    <tr>
                        <th>Harga (RM)</th>
                        <td id="modal-harga_tempahan"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
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
$(document).ready(function() {
    $('.btn-view').click(function() {
        $('#modal-nama_pelanggan').text($(this).data('nama_pelanggan'));
        $('#modal-tarikh_tempahan').text($(this).data('tarikh_tempahan'));
        $('#modal-jenis_tempahan').text($(this).data('jenis_tempahan'));
        $('#modal-status').text($(this).data('status'));
        $('#modal-harga_tempahan').text($(this).data('harga_tempahan'));
        $('#dynamicViewModal').modal('show');
    });
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
      $(document).on('change', '.status-dropdown', function() {
          var status = $(this).val();
          var tempahanId = $(this).data('tempahan-id');

          $.ajax({
              url: '{{ route("tempahan.update.status", ":id") }}'.replace(':id', tempahanId),
              method: 'PATCH',
              data: { status: status, _token: '{{ csrf_token() }}' },
              success: function(response) {
                    if (response.success) {
                        $('#alert-container')
                            .removeClass('d-none')
                            .text(response.success);

                        setTimeout(function() {
                            $('#alert-container').addClass('d-none').text('');
                        }, 100000);
                    }
                  $('#status-' + tempahanId).text(response.status);
              },
              error: function() {
                  alert('Ralat semasa mengemaskini status.');
              }
          });
    });
});
</script>
@endsection
