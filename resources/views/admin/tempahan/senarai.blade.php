
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
                                            @foreach(collect($tempahan)->unique('jenis_tempahan') as $item)
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
                                    <!-- <th><input type="checkbox" id="select-all"></th> -->
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
                                    <!-- <td><input type="checkbox" class="select-item"></td> -->
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td >{{ $item->nama_pelanggan }}</td>
                                    <td style="text-align: center;">{{ $item->jenis_tempahan }}</td>
                                    <td style="text-align: center;">{{ $item->tarikh_tempahan }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('tempahan.show', $item->id) }}" class="btn btn-info btn-sm">Info</a>
                                        <a href="{{ route('tempahan.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('tempahan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                            <script>
                                document.getElementById('select-all').onclick = function() {
                                    var checkboxes = document.querySelectorAll('.select-item');
                                    for (var checkbox of checkboxes) {
                                        checkbox.checked = this.checked;
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
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