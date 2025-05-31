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

    .status-read {
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

            <!-- FORM CARIAN + FILTER STATUS -->
            <div class="d-flex mb-3">
                <form method="GET" action="{{ route('aduan-cadangan.index') }}" class="me-2 d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama, tajuk, status..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>

                @php
                    $statusList = $aduans->pluck('status')->unique()->filter()->values();
                @endphp

                <select id="filterStatus" class="form-select w-auto" onchange="filterByStatus()">
                    <option value="">Semua</option>
                    @foreach ($statusList as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>

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
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="aduan-table-body">
                    @forelse($aduans as $aduan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $aduan->nama_pelanggan }}</td>
                        <td>{{ $aduan->tajuk }}</td>
                        <td>{{ $aduan->kategori }}</td>
                        <td>{{ $aduan->tarikh->format('Y-m-d') }}</td>
                        <td>
                            <span id="status-aduan-{{ $aduan->id }}" class="status-badge 
                                @if($aduan->status == 'Menunggu') status-pending 
                                @elseif($aduan->status == 'Selesai') status-resolved 
                                @elseif($aduan->status == 'Dibaca') status-read 
                                @else status-rejected 
                                @endif">
                                {{ $aduan->status }}
                            </span>
                        </td>
                        <td class="d-flex gap-2">
                            <button type="button" class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal{{ $aduan->id }}"
                                onclick="markAsRead({{ $aduan->id }})">
                                Lihat
                            </button>

                            <form id="delete-form-{{ $aduan->id }}" action="{{ route('aduan-cadangan.destroy', $aduan->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $aduan->id }})">
                                Padam
                            </button>
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
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tiada aduan tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Message if filter result is empty -->
            <div id="noResults" class="text-center text-muted mt-2" style="display:none;">
                Tiada aduan dijumpai untuk status ini.
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert2 for Delete
    function confirmDelete(id) {
        Swal.fire({
            title: 'Anda pasti?',
            text: "Tindakan ini akan padam aduan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, padam!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // AJAX update status to 'Dibaca'
    function markAsRead(id) {
        fetch(`/admin/aduan-cadangan/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        }).then(response => {
            if (response.ok) {
                const badge = document.getElementById('status-aduan-' + id);
                badge.classList.remove('status-pending');
                badge.classList.add('status-read');
                badge.innerText = 'Dibaca';
            }
        }).catch(error => {
            console.error('Gagal update status:', error);
        });
    }

    // Filter status dropdown
    function filterByStatus() {
        const selected = document.getElementById("filterStatus").value.toLowerCase();
        let visibleCount = 0;

        document.querySelectorAll("#aduan-table-body tr").forEach(row => {
            const statusCell = row.querySelector("td:nth-child(6)");
            if (!statusCell) return;

            const status = statusCell.innerText.toLowerCase();
            const show = !selected || status === selected;

            row.style.display = show ? "" : "none";
            if (show) visibleCount++;
        });

        const noResults = document.getElementById("noResults");
        if (noResults) {
            noResults.style.display = (visibleCount === 0) ? "block" : "none";
        }
    }
</script>
@endsection
