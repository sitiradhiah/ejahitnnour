<!-- Modal Edit Produk -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <form method="POST" id="editProductForm" action="" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" id="editNama" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Kategori</label>
                <select name="kategori" id="editKategori" class="form-select" required>
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label>Warna</label>
                <input type="text" name="warna" id="editWarna" class="form-control">
              </div>
              <!-- <div class="col-md-6 mb-3">
                <label>Saiz</label>
                <input type="text" name="saiz" id="editSaiz" class="form-control">
              </div> -->
              <!-- <div class="col-md-6 mb-3">
                <label>Harga (RM)</label>
                <input type="number" step="0.01" name="harga" id="editHarga" class="form-control">
              </div> -->
              <div class="col-md-6 mb-3">
                <label>Penerangan Produk</label>
                <textarea name="penerangan" id="editPenerangan" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-12 mb-3">
                <label>Kemaskini Gambar Produk (Optional)</label>
                <input type="file" name="gambar" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100">Kemaskini Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
