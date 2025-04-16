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
                                    <a href="{{ route('tempahan.baru') }}" class="btn btn-success ms-2">
                                        <i class="bi bi-plus"></i> Tempahan Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th>Nama Pelanggan</th>
                                    <th style="text-align: center;">Jenis Tempahan</th>
                                    <th style="text-align: center;">Tarikh Tempahan</th>
                                    <th style="width: 15%; text-align: center;">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempahan as $index => $item)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td style="text-align: center;">{{ $item->jenis_tempahan }}</td>
                                    <td style="text-align: center;">{{ $item->tarikh_tempahan }}</td>
                                    <td style="text-align: center;">
                                        <!-- Info Button triggers modal -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}">Maklumat</button>
                                        <a href="{{ route('tempahan.edit', $item->id) }}" class="btn btn-primary btn-sm">Kemaskini</a>
                                        <form action="{{ route('tempahan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Padam</button>
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
    // Filter Tempahan by Jenis Tempahan
    document.querySelectorAll('.filter-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var filterValue = this.getAttribute('data-filter');
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var jenisTempahan = row.querySelector('td:nth-child(3)').textContent;
                if (jenisTempahan === filterValue || filterValue === 'All') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
