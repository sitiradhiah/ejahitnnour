<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTestimonialModalLabel">Tambah Testimonial</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
  
          <div class="modal-body">
            {{-- Alert jika ada error --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
  
            {{-- Nama --}}
            <div class="form-group mb-3">
              <label for="name">Nama</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
  
            {{-- Kata-kata pelanggan --}}
            <div class="form-group mb-3">
              <label for="feedback">Kata-Kata Pelanggan</label>
              <textarea name="feedback" id="feedback" class="form-control" required></textarea>
            </div>
  
            {{-- Gambar --}}
            <div class="form-group mb-3">
              <label for="image">Gambar</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
          </div>
  
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  