<!-- Modal Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <form action="{{ route('katelog.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Kategori</label>
                <select name="kategori" class="form-select" required>
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label>Warna</label>
                <input type="text" name="warna" class="form-control">
              </div>
              <!-- <div class="col-md-6 mb-3">
                <label>Saiz</label>
                <input type="text" name="saiz" class="form-control" placeholder="Contoh: S - 2XL">
              </div>
              <div class="col-md-6 mb-3">
                <label>Harga (RM)</label>
                <input type="number" step="0.01" name="harga" class="form-control">
              </div> -->
              <div class="col-md-6 mb-3">
                <label>Penerangan Produk</label>
                <textarea name="penerangan" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-12 mb-3">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success w-100">Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
