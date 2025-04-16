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
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h1 class="h1-custom">HUBUNGI KAMI</h1>
          <p class="p-custom">
            Jika anda mempunyai sebarang masalah, cadangan, atau pertanyaan, 
            sila hubungi kami. Kami sedia membantu dan ingin mendengar daripada anda.
          </p>
        </div>
      </div>
      <div class="row px-5">
        <div class="col-md-6">
          <div class="map-box">
            <iframe 
              src="https://maps.google.com/maps?q=50,%20Jalan%20Abdul%20Aziz,%20Taman%20Perdana,%2086100%20Ayer%20Hitam,%20Johor&hl=en&z=15&output=embed" 
              width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
            </iframe>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-form">
            <form action="{{ route('send-message') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="email">Emel:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="message">Ulasan / Pertanyaan:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Hantar Mesej</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->
@endsection
