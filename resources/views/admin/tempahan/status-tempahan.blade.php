<table class="table">
    <thead>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Jenis Tempahan</th>
            <th>Tarikh Tempahan</th>
            <th>Status</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tempahan as $item)
        <tr>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->jenis_tempahan }}</td>
            <td>{{ $item->tarikh_tempahan }}</td>
            <td id="status-{{ $item->id }}">{{ $item->status }}</td>
            <td>
                <!-- Dropdown untuk mengubah status tempahan -->
                <select class="form-control status-dropdown" data-tempahan-id="{{ $item->id }}">
                    <option value="Dalam Pelaksanaan" {{ $item->status == 'Dalam Pelaksanaan' ? 'selected' : '' }}>Dalam Pelaksanaan</option>
                    <option value="Sudah Selesai" {{ $item->status == 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                </select>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
