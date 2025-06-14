@extends('layouts.admin-main')

@section('css')
<style>
    /* Custom modal styling */
    .modal-content {
        border-radius: 8px;
        border: 2px solid #007bff;
    }

    .modal-header {
        background-color: #007bff;
        color: #fff;
    }

    .modal-body {
        font-size: 16px;
    }

    .modal-footer {
        border-top: none;
    }

    .modal-title {
        font-weight: bold;
    }

    .btn-filter-status {
        background-color: #CC6600; /* oren gelap */
        color: white;
        border: none;
        font-weight: 500;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-filter-status:hover,
    .btn-filter-status:focus,
    .btn-filter-status:active,
    .show > .btn-filter-status.dropdown-toggle {
        background-color: #FF8C00; /* oren terang */
        color: white;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #ffe5cc;
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Tempahan Jahitan</h3>
</div>
<div class="container">
    <!-- Senarai Tempahan -->
    <div class="card shadow p-3">
        <div class="card-header">
            <!-- <div class="mb-2" style="font-size: 0.85rem; color: #555;">
                <em>NOTA: Butang <strong>Tindakan</strong> hanya digunakan jika tempahan aktif. </em>
            </div> -->

            <label class="me-2 fw-bold text-dark text-decoration-underline">Tapisan</label>

            <form method="GET" action="{{ route('tempahan.senarai') }}">
                <div class="row g-2 align-items-end">
                    <!-- Jenis Tempahan -->
                    <div class="col-12 col-md-auto me-2">
                        <label for="jenis_tempahan" class="form-label mb-1">Jenis Tempahan:</label>
                        <select name="jenis_tempahan" id="jenis_tempahan" class="form-select form-select-sm">
                            <option value="">--Semua--</option>
                            @foreach($jenisList as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis_tempahan') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
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

                    <!-- Butang Tapisan -->
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="fa fa-filter"></i> Tapis
                        </button>
                    </div>


                </div>
            </form>
        </div>
         <div class="card-body">
            <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Senarai Tempahan</label>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Tarikh Tempahan</th>
                            <th >Jenis Tempahan</th>
                            <th >Nama Pelanggan</th>
                            <th style="text-align: center;">Harga (RM)</th>
                            <th >Tukar Status ?</th>
                            <th style="width: 15%; text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tempahan as $index => $item)
                        <tr>
                            <td style="text-align: center; width: 1%;">{{ $index + 1 }}</td>
                            <td style="text-align: center; width: 10%;">{{ $item->tarikh_tempahan }}</td>
                            <td >{{ $item->jenis_tempahan }}</td>
                            <td >{{ $item->nama_pelanggan }}</td>
                            <th style="text-align: center;">
                                {{ number_format($item->harga_tempahan, 2) }}
                            </th>
                            <td style="text-align: center; width: 15%;">
                                <div class="dropdown-wrapper my-2">
                                    <select class="form-control dropdown-status status-dropdown" data-tempahan-id="{{ $item->id }}">
                                        <option value="Dalam Pelaksanaan" {{ $item->status == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                            Dalam Pelaksanaan
                                        </option>
                                        <option value="Sudah Selesai" {{ $item->status == 'Sudah Selesai' ? 'selected' : '' }}>
                                            Sudah Selesai
                                        </option>
                                    </select>
                                    <span class="dropdown-icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </span>
                                </div>
                            </td>
                            <td style="text-align: center; width: 10%;">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}"><i class="fa-solid fa-eye"></i></button>
                                <a href="{{ route('tempahan.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('tempahan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal for Info -->
                        <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Detail Tempahan: {{ $item->nama_pelanggan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Pelanggan:</strong> {{ $item->nama_pelanggan }}</p>
                                        <p><strong>Jenis Tempahan:</strong> {{ $item->jenis_tempahan }}</p>
                                        <p><strong>Tarikh Tempahan:</strong> {{ $item->tarikh_tempahan }}</p>
                                        <p><strong>Alamat:</strong> {{ $item->alamat }}</p>
                                        <p><strong>Nombor Telefon:</strong> {{ $item->nombor_telefon }}</p>
                                        <p><strong>Ukuran Dada:</strong> {{ $item->chest_size }} cm</p>
                                        <p><strong>Ukuran Pinggang:</strong> {{ $item->waist_size }} cm</p>
                                        <p><strong>Lebar Bahu:</strong> {{ $item->shoulder_width }} cm</p>
                                        <p><strong>Panjang Lengan:</strong> {{ $item->sleeve_length }} cm</p>
                                        <p><strong>Jenis Kain:</strong> {{ $item->jenis_kain }}</p>
                                        <p><strong>Warna Kain:</strong> {{ $item->warna_kain }}</p>
                                        <p><strong>Saiz:</strong> {{ $item->size }}</p>
                                        <p><strong>Harga Tempahan:</strong> RM {{ $item->harga_tempahan }}</p>
                                        <p><strong>Catatan Tambahan:</strong> {{ $item->additional_notes }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </div>
    </div>
</div>

@endsection

@section('scripts')
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

