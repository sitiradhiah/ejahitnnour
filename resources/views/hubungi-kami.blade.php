@extends('layouts.main')

{{-- @section('title', 'Hubungi Kami') --}}

@section('content')
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="detail-box text-center">
            <h2>
              Hubungi Kami
            </h2>
            <p>
                Jika anda mempunyai sebarang masalah, cadangan, atau pertanyaan, 
                sila hubungi kami. Kami sedia membantu dan ingin mendengar daripada anda.
            </p>
          </div>
        </div>
      </div>
      <div class="row  px-5">
        <div class="col-md-6">
          <div class="map-box">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019116048087!2d144.9630579153169!3d-37.81410797975171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d1b6e6e1e0e!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1611810191234!5m2!1sen!2sau" 
                width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-form">
            <form action="/send-message" method="POST">
              @csrf
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="email">Emel:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="message">Ulasan / Pertanyaan</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  <!-- end about section -->
@endsection