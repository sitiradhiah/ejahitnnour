@extends('layouts.admin-main')
@section('title', 'Laporan Tempahan')

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
        <h3>Janaan Laporan</h3>
    </div>
    <div class="container">
        <!-- Laporan Tempahan -->
        <div class="card shadow p-3">
            <div class="card-header">
                <div class="mb-2" style="font-size: 0.85rem; color: #555;">
                    <em>NOTA: Butang <strong>Muat Turun Invois</strong> hanya untuk tempahan yang telah selesai sahaja. </em>
                </div>
                <label class="me-2 fw-bold text-dark text-decoration-underline">Tapisan</label>
                <div class="row g-2 align-items-end">
                    <!-- Tarikh Dari -->
                    <div class="col-4 col-md-auto">
                        <label for="filter-date-from" class="form-label mb-1">Tarikh Dari:</label>
                        <input type="date" id="filter-date-from" class="form-control form-control-sm">
                    </div>

                    <!-- Tarikh Hingga -->
                    <div class="col-4 col-md-auto">
                        <label for="filter-date-to" class="form-label mb-1">Tarikh Hingga:</label>
                        <input type="date" id="filter-date-to" class="form-control form-control-sm">
                    </div>

                    <!-- Status -->
                    <div class="col-4 col-md-auto">
                        <label for="filter-status" class="form-label mb-1">Status:</label>
                        <select id="filter-status" class="form-control form-control-sm">
                            <option value="">Semua</option>
                            <option value="Sudah Selesai">Sudah Selesai</option>
                            <option value="Dalam Pelaksanaan">Dalam Pelaksanaan</option>
                        </select>
                    </div>

                    <!-- Tapis -->
                    <div class="col-12 col-md-auto">
                        <button id="btn-apply-filter" class="btn btn-sm btn-primary w-100">
                            <i class="fa fa-filter"></i> Tapis
                        </button>
                    </div>

                    <!-- Excel -->
                    <div class="col-6 col-md-auto">
                        <button class="btn btn-sm btn-success w-100" id="btn-export-excel">
                            <i class="fa-solid fa-download"></i> Senarai Excel
                        </button>
                    </div>

                    <!-- PDF -->
                    <div class="col-6 col-md-auto">
                        <button class="btn btn-sm btn-danger w-100" id="btn-export-pdf">
                            <i class="fa-solid fa-download"></i> Senarai PDF
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Senarai Tempahan</label>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="mt-2">
                            <strong>Jumlah Harga Tempahan Telah Selesai Tahun {{ date('Y') }} adalah RM
                            {{ number_format($totalHarga, 2) }}</strong>
                            <!-- <span id="total-harga-tempahan">{{ number_format($totalHarga, 2) }}</span> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm w-100" id="table-tempahan" >
                        <thead>
                            <tr>
                                <th style="text-align: center; padding: 0.2rem;">No</th>
                                <th style="text-align: center; padding: 0.2rem;">Tarikh Tempahan</th>
                                <th style="padding: 0.2rem;">Jenis Tempahan</th>
                                <th style="padding: 0.2rem;">Nama Pelanggan</th>
                                <th style="padding: 0.2rem;">Status</th>
                                <th style="text-align: center; padding: 0.2rem;">Harga (RM)</th>
                                <th style="width: 15%; text-align: center; padding: 0.2rem;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="tempahan-body">
                            @foreach($tempahan as $index => $item)
                            <tr>
                                <td style="text-align: center; width: 1%; padding: 0.2rem;">{{ $index + 1 }}</td>
                                <td style="text-align: center; width: 15%; padding: 0.2rem;">{{ $item->tarikh_tempahan }}</td>
                                <td style="padding: 0.2rem;">{{ $item->jenis_tempahan }}</td>
                                <td style="padding: 0.2rem;">{{ $item->nama_pelanggan }}</td>
                                <td style="text-align: center; width: 15%; padding: 0.2rem;">
                                    <span>{{ $item->status }}</span>
                                </td>
                                <td style="text-align: center; width: 10%; padding: 0.2rem;">
                                    {{ $item->harga_tempahan }}
                                </td>
                                <td style="text-align: center; width: 10%;">
                                    @if($item->status === 'Sudah Selesai')
                                        <button class="btn btn-sm btn-primary" onclick="exportRowToPDF({{ $item->id }})">
                                            <i class="fa-solid fa-download"></i> Invois
                                        </button>
                                    @endif
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $item->id }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    @include('admin.tempahan.laporan.modal-view')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<!-- download  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.0/jspdf.plugin.autotable.min.js"></script>
<script>
    // EXPORT EXCEL
    document.getElementById('btn-export-excel').addEventListener('click', function () {
        var table = document.querySelector('.table-striped');
        var rows = Array.from(table.rows);
        var csv = [];
        var today = new Date();
        var currentDate = today.toLocaleDateString('ms-MY');

        // Add Title & Summary
        csv.push('"Kedai Jahit N\'Nour"');
        csv.push('"Laporan ini dijana pada tarikh: ' + currentDate + '"');
        csv.push('"Jumlah Harga Tempahan Telah Selesai Tahun {{ date("Y") }} adalah RM {{ number_format($totalHarga, 2) }}"');
        csv.push('');

        rows.forEach(function(row) {
            var cols = Array.from(row.cells);
            if (cols.length > 0) cols = cols.slice(0, -1); // Exclude last column
            var rowData = cols.map(cell => '"' + cell.innerText.replace(/"/g, '""') + '"');
            csv.push(rowData.join(','));
        });

        var csvString = csv.join('\n');
        var blob = new Blob([csvString], { type: 'text/csv' });
        var url = window.URL.createObjectURL(blob);

        var a = document.createElement('a');
        a.href = url;
        a.download = 'senarai_tempahan.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    });

    // EXPORT PDF (FULL LIST)
    document.getElementById('btn-export-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const today = new Date();
        const currentDate = today.toLocaleDateString('ms-MY');

        // Title & Header
        doc.setTextColor(204, 0, 102);
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.text("Kedai Jahit N'Nour", doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

        doc.setFontSize(12);
        doc.setTextColor(0, 0, 0);
        doc.setFont(undefined, 'normal');
        doc.text('Laporan ini dijana pada tarikh: ' + currentDate, 14, 25);
        doc.text('Jumlah Harga Tempahan Telah Selesai Tahun {{ date("Y") }} adalah RM {{ number_format($totalHarga, 2) }}', 14, 32);

        // Table Data
        var table = document.querySelector('.table-striped');
        var rows = Array.from(table.querySelectorAll('tbody tr'));
        var headers = Array.from(table.querySelectorAll('thead th')).slice(0, -1);
        var headerData = headers.map(th => th.innerText);

        var bodyData = rows.map(function(row) {
            var cells = Array.from(row.querySelectorAll('td')).slice(0, -1);
            return cells.map(cell => cell.innerText);
        });

        doc.autoTable({
            head: [headerData],
            body: bodyData,
            startY: 40,
            styles: { fontSize: 10 },
            headStyles: { fillColor: [0, 123, 255] },
            theme: 'striped'
        });

        doc.save('senarai_tempahan.pdf');
    });

    // EXPORT SINGLE ROW TO INVOICE
    function exportRowToPDF(id) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const row = document.querySelector('tr td button[onclick*="exportRowToPDF(' + id + ')"]').closest('tr');
        const cells = Array.from(row.querySelectorAll('td')).slice(0, -1);

        const tarikh = cells[1].innerText;
        const jenisTempahan = cells[2].innerText;
        const namaPelanggan = cells[3].innerText;
        const status = cells[4].innerText;
        const harga = cells[5].innerText;

        const now = new Date();
        const timestamp = now.toISOString().replace(/[-:TZ.]/g, '').slice(0, 14);
        const randomStr = Math.random().toString(36).substring(2, 6).toUpperCase();
        const invoiceCode = `INV-${timestamp}-${randomStr}`;

        // Header - Company Name
        doc.setTextColor(204, 0, 102);
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.text("Kedai Jahit N'Nour", 14, 18);

        // Right Header Info
        doc.setFontSize(11);
        doc.setTextColor(0, 0, 0);
        doc.setFont(undefined, 'normal');
        doc.text(`Kod Invois: ${invoiceCode}`, 150, 18, { align: "right" });
        doc.text(`Tarikh: ${now.toLocaleDateString('ms-MY')}`, 150, 24, { align: "right" });

        // Line separator
        doc.setLineWidth(0.5);
        doc.line(14, 28, 196, 28);

        // Invoice Table
        doc.autoTable({
            startY: 32,
            head: [['Butiran', 'Maklumat']],
            body: [
                ['ID Tempahan', id],
                ['Tarikh Tempahan', tarikh],
                ['Jenis Tempahan', jenisTempahan],
                ['Nama Pelanggan', namaPelanggan],
                ['Status', status],
                ['Jumlah Harga (RM)', harga]
            ],
            styles: { fontSize: 11 },
            headStyles: { fillColor: [0, 123, 255], halign: 'center' },
            columnStyles: {
                0: { cellWidth: 60 },
                1: { cellWidth: 120 }
            }
        });

        doc.save(`invois_tempahan_${id}.pdf`);
    }
</script>


<!-- Filter / tapisan  -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('btn-apply-filter').addEventListener('click', function () {
            const dari = document.getElementById('filter-date-from').value;
            const hingga = document.getElementById('filter-date-to').value;
            const status = document.getElementById('filter-status').value;

            fetch("{{ route('tempahan.laporan.filter') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    tarikh_dari: dari,
                    tarikh_hingga: hingga,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById("tempahan-body");
                tbody.innerHTML = '';

                if (data.data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">Tiada data dijumpai.</td></tr>`;
                    // document.getElementById("total-harga-tempahan").innerText = "0.00";
                    return;
                }

                data.data.forEach((item, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${item.tarikh_tempahan}</td>
                            <td>${item.jenis_tempahan}</td>
                            <td>${item.nama_pelanggan}</td>
                            <td class="text-center">${item.status}</td>
                            <td class="text-center">${item.hargaPerTempahan ?? '-'}</td>
                            <td class="text-center">
                                ${item.status === 'Sudah Selesai' ? `<button class="btn btn-sm btn-primary" onclick="exportRowToPDF(${item.id})"><i class="fa-solid fa-download"></i></button>` : ''}
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal-${item.id}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });

                document.getElementById("total-harga-tempahan").innerText = data.totalHarga;
            });
        });
    });
</script>

@endsection
