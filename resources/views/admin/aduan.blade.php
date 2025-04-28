@extends('layouts.admin-main')

@section('css')
<style>
    .page-heading {
        margin-bottom: 20px;
        text-align: center;
    }

    .card {
        margin-bottom: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table {
        margin-bottom: 0;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        color: white;
    }

    .status-pending {
        background-color: #ffc107;
    }

    .status-resolved {
        background-color: #28a745;
    }

    .status-rejected {
        background-color: #dc3545;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Aduan & Cadangan</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Senarai Aduan dan Cadangan</h4>
        </div>
        <div class="card-body">

            <!-- FORM CARIAN -->
            <form method="GET" action="{{ route('aduan-cadangan.index') }}" class="mb-4 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari nama, tajuk, status..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <!-- TABLE -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tajuk</th>
                        <th>Kategori</th>
                        <th>Tarikh</th>
                        <th>Status</th>
                        <th>Tindakan</th> <!-- Column tindakan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($aduans as $aduan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $aduan->nama_pelanggan }}</td>
                        <td>{{ $aduan->tajuk }}</td>
                        <td>{{ $aduan->kategori }}</td>
                        <td>{{ $aduan->tarikh->format('Y-m-d') }}</td>
                        <td>
                            <span class="status-badge 
                                @if($aduan->status == 'Menunggu') status-pending 
                                @elseif($aduan->status == 'Selesai') status-resolved 
                                @else status-rejected 
                                @endif">
                                {{ $aduan->status }}
                            </span>
                        </td>
                        <td class="d-flex gap-2">
                            <!-- Butang Lihat -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal{{ $aduan->id }}">
                                Lihat
                            </button>

                            <!-- Butang Padam -->
                            <form action="{{ route('aduan-cadangan.destroy', $aduan->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk padam aduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Padam</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Preview -->
                    <div class="modal fade" id="previewModal{{ $aduan->id }}" tabindex="-1" aria-labelledby="previewModalLabel{{ $aduan->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="previewModalLabel{{ $aduan->id }}">Preview Mesej</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama:</strong> {{ $aduan->nama_pelanggan }}</p>
                                    <p><strong>Email:</strong> {{ $aduan->email ?? '-' }}</p>
                                    <p><strong>No Telefon:</strong> {{ $aduan->no_telefon ?? '-' }}</p>
                                    <p><strong>Tarikh:</strong> {{ $aduan->tarikh->format('d-m-Y') }}</p>
                                    <p><strong>Status:</strong> {{ $aduan->status }}</p>
                                    <hr>
                                    <p><strong>Mesej:</strong></p>
                                    <p>{{ $aduan->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
