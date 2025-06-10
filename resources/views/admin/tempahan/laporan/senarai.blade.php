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
            <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Tapisan</label>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex flex-column me-2">
                    <label for="filter-date-from" class="form-label mb-1">Tarikh Dari:</label>
                    <input type="date" id="filter-date-from" class="form-control w-auto mb-2">
                </div>
                <div class="d-flex flex-column me-2">
                    <label for="filter-date-to" class="form-label mb-1">Tarikh Hingga:</label>
                    <input type="date" id="filter-date-to" class="form-control w-auto mb-2">
                </div>
                <div class="d-flex flex-column me-2">
                    <label for="filter-status" class="form-label mb-1">Pilih Status:</label>
                    <select id="filter-status" class="form-control w-auto mb-2">
                        <option value="">Semua</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Batal">Batal</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-success" id="btn-export-excel"><i class="fa-solid fa-download"></i> Senarai Excel</button>
                    <script>
                    document.getElementById('btn-export-excel').addEventListener('click', function () {
                        // Get table
                        var table = document.querySelector('.table-striped');
                        var rows = Array.from(table.rows);
                        var csv = [];

                        rows.forEach(function(row, rowIndex) {
                            var cols = Array.from(row.cells);
                            // Exclude last column (Tindakan)
                            if (cols.length > 0) {
                                // Remove last cell
                                cols = cols.slice(0, -1);
                            }
                            var rowData = cols.map(function(cell) {
                                // Escape double quotes
                                return '"' + cell.innerText.replace(/"/g, '""') + '"';
                            });
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
                    </script>
                    <button class="btn btn-sm btn-danger" id="btn-export-pdf"><i class="fa-solid fa-download"></i> Senarai PDF</button>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.0/jspdf.plugin.autotable.min.js"></script>
                    <script>
                    document.getElementById('btn-export-pdf').addEventListener('click', function () {
                        const { jsPDF } = window.jspdf;
                        var doc = new jsPDF();

                        // Title
                        doc.setFontSize(16);
                        doc.text('Senarai Tempahan', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

                        // Get table data
                        var table = document.querySelector('.table-striped');
                        var rows = Array.from(table.querySelectorAll('tbody tr'));
                        var headers = Array.from(table.querySelectorAll('thead th'));
                        // Remove last header (Tindakan)
                        var headerData = headers.slice(0, -1).map(th => th.innerText);

                        var bodyData = rows.map(function(row) {
                            var cells = Array.from(row.querySelectorAll('td'));
                            // Remove last cell (Tindakan)
                            cells = cells.slice(0, -1);
                            return cells.map(cell => cell.innerText);
                        });

                        doc.autoTable({
                            head: [headerData],
                            body: bodyData,
                            startY: 22,
                            styles: { fontSize: 10 },
                            headStyles: { fillColor: [0, 123, 255] },
                            theme: 'striped'
                        });

                        doc.save('senarai_tempahan.pdf');
                    });
                    </script>
                </div>
            </div>
        </div>
        <div class="card-body">
            <label class="me-2" style="font-weight: bold; color: black; text-decoration: underline;">Senarai Tempahan</label>
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
                        <td style="text-align: center; width: 1%;">{{ $index + 1 }}</td>
                        <td style="text-align: center; width: 15%;">{{ $item->tarikh_tempahan }}</td>
                        <td >{{ $item->jenis_tempahan }}</td>
                        <td >{{ $item->nama_pelanggan }}</td>
                        <!-- <td id="status-{{ $item->id }}">{{ $item->status }}</td> -->
                        <td style="text-align: center; width: 15%;">
                            <span>{{ $item->status }}</span>
                        </td>
                        <td style="text-align: center; width: 10%;">
                            <button class="btn btn-sm btn-primary" onclick="window.open('{{ route('tempahan.laporan.pdf', $item->id) }}', '_blank')">
                                <i class="fa-solid fa-download"></i>
                            </button>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- <!-- Laporan Stok -->
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Janaan Laporan Stok</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bahan</th>
                        <th>Kuantiti</th>
                        <th>Harga Per Kuantiti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kain Cotton</td>
                        <td>50</td>
                        <td>RM20.00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Benang Jahit</td>
                        <td>100</td>
                        <td>RM5.00</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Butang Baju</td>
                        <td>200</td>
                        <td>RM0.50</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn-generate mt-3">Jana Laporan Stok</button>
        </div>
    </div> --}}
</div>
@endsection
