@extends('layouts.main')

@section('css')
<style>
  .h1-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .p-custom {
        text-align: center;
        color: #555;
        font-size: 1rem;
        margin-bottom: 40px;
    }
</style>

@section('content')
  <!-- About Section -->
  <section class="about_section layout_padding py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="h1-custom">HUBUNGI KAMI</h1>
      <p class="p-custom">
        Jika anda mempunyai sebarang masalah, cadangan, atau pertanyaan,
        sila hubungi kami. Kami sedia membantu dan ingin mendengar daripada anda.
      </p>
    </div>

    <div class="row g-4 align-items-start">
      <!-- Map -->
      <div class="col-lg-6">
        <div class="map-box rounded overflow-hidden shadow-sm">
          <iframe
            src="https://maps.google.com/maps?q=50,%20Jalan%20Abdul%20Aziz,%20Taman%20Perdana,%2086100%20Ayer%20Hitam,%20Johor&hl=en&z=15&output=embed"
            width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
          </iframe>
        </div>
      </div>

            <!-- Contact Form -->
      <div class="col-lg-6">
        <div class="contact-form bg-white p-4 rounded shadow-sm">
          
          <!-- Success Message (kalau nak guna flash message) -->
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form action="{{ route('aduan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label fw-bold">Nama:</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Siti Aisyah" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Emel:</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Contoh: siti@gmail.com" required>
            </div>

            <div class="mb-3">
              <label for="no_telefon" class="form-label fw-bold">No Telefon:</label>
              <input type="text" name="no_telefon" id="no_telefon" class="form-control" placeholder="Contoh: 012-3456789" required>
            </div>

            <div class="mb-3">
              <label for="message" class="form-label fw-bold">Ulasan / Pertanyaan:</label>
              <textarea name="message" id="message" rows="5" class="form-control" placeholder="Tulis pertanyaan anda di sini..." required></textarea>
            </div>

            <button type="submit" class="btn w-100 text-white" style="background: linear-gradient(90deg, #c13584, #00b4d8);">
              Hantar Mesej
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- end about section -->
@endsection
