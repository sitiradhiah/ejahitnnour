<div class="modal fade" id="viewModal-{{ $item->id }}" tabindex="-1" aria-labelledby="viewModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel-{{ $item->id }}">Maklumat Tempahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-2">Maklumat Pelanggan</h6>
                <table class="table table-borderless mb-0" style="font-size: 0.95rem;">
                    <tr>
                        <th style="width: 40%;">Nama Pelanggan</th>
                        <td>{{ $item->nama_pelanggan }}</td>
                    </tr>
                </table>

                <h6 class="mb-2">Maklumat Tempahan</h6>
                <table class="table table-borderless mb-3" style="font-size: 0.95rem;">
                    <tr>
                        <th style="width: 40%;">Tarikh Tempahan</th>
                        <td>{{ $item->tarikh_tempahan }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Tempahan</th>
                        <td>{{ $item->jenis_tempahan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $item->status }}</td>
                    </tr>
                    <tr>
                        <th>Harga (RM)</th>
                        <td>{{ $item->harga_tempahan }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
