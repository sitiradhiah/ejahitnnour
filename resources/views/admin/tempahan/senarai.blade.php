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
                                <h4 class="mb-0">Senarai Tempahan</h4>
                                <div class="d-flex">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filter Jenis Tempahan
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filter-btn" href="#" data-filter="All">All</a></li>
                                            @foreach($tempahan->unique('jenis_tempahan') as $item)
                                                <li><a class="dropdown-item filter-btn" href="#" data-filter="{{ $item->jenis_tempahan }}">{{ $item->jenis_tempahan }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Filter Status Pelanggan -->
                                    <div class="btn-group ms-2">
                                        <button type="button" class="btn btn-filter-status dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filter Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filter-status-btn" href="#" data-status="All">Semua</a></li>
                                            <li><a class="dropdown-item filter-status-btn" href="#" data-status="Aktif">Tempahan Aktif</a></li>
                                            <li><a class="dropdown-item filter-status-btn" href="#" data-status="Lama">Pelanggan Lama</a></li>
                                        </ul>
                                    </div>


                                    <a href="{{ route('tempahan.baru') }}" class="btn btn-success ms-2">
                                        <i class="bi bi-plus"></i> Tempahan Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Tarikh Tempahan</th>
                                    <th >Jenis Tempahan</th>
                                    <th >Nama Pelanggan</th>
                                    <th >Status</th>
                                    <th style="width: 15%; text-align: center;">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempahan as $index => $item)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td style="text-align: center;">{{ $item->tarikh_tempahan }}</td>
                                    <td >{{ $item->jenis_tempahan }}</td>
                                    <td >{{ $item->nama_pelanggan }}</td>
                                    <td id="status-{{ $item->id }}">{{ $item->status }}</td>
                                    <td style="text-align: center;">
                                        <!-- Info Button triggers modal -->
                                         <select class="form-control status-dropdown my-2" data-tempahan-id="{{ $item->id }}">
                                            <option value="Dalam Pelaksanaan" {{ $item->status == 'Dalam Pelaksanaan' ? 'selected' : '' }}>Dalam Pelaksanaan</option>
                                            <option value="Sudah Selesai" {{ $item->status == 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                        </select>
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
    </section>
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

