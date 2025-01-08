@extends('layouts.main')

@section('css')
<style>
  .hero_area {
    background: url('images/about1.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    min-height: 40vh !important;
    position: relative;
  }

  .slider_section {
    padding: 0;
  }

  .slider_bg_box {
    background: rgba(0, 0, 0, 0.5);
    min-height: 80vh;
  }

  .carousel-inner {
    min-height: 80vh;
  }

  .carousel-inner img {
    min-height: 80vh;
  }

  .detail-box {
    color: #fff;
    padding: 100px 0;
  }

  .detail-box h1 {
    font-size: 50px;
    font-weight: 700;
  }

  .detail-box p {
    font-size: 18px;
    margin-top: 20px;
  }

  .btn-box {
    margin-top: 20px;
  }

  .btn1,
  .btn2 {
    background: #ff304f;
    color: #fff;
    padding: 10px 20px;
    border-radius: 30px;
    margin-right: 10px;
    text-transform: uppercase;
  }

  .btn2 {
    background: #fff;
    color: #000;
  }

  .btn1:hover,
  .btn2:hover {
    text-decoration: none;
  }

  .carousel-indicators {
    bottom: 20px;
  }

  .carousel-indicators li {
    background: #ff304f;
    border-radius: 50%;
  }

  .carousel-indicators .active {
    background: #fff;
  }
</style>
@endsection

@section('content')
   
  <div class="hero_area">
    <!-- slider section -->
    <section class="slider_section">
      <div class="slider_bg_box">
        {{-- <img src="images/slider-bg.jpg" alt=""> --}}
      </div>
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container d-flex align-items-end" style="min-height: 50vh;">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box" style="background: rgba(0, 0, 0, 0.473); padding: 10px; border-radius: 10px;">
                    <h1> KEDAI JAHIT N'NOUR </h1>
                    <p>
                      Selamat Datang ke Kedai Jahit N'NOUR, sila lihat reka bentuk tempahan dan perkhidmatan yang di tawarkan.
                    </p>
                    <div class="btn-box">
                      <!-- Link to Hubungi Kami page -->
                      <a href="{{ route('hubungi.kami') }}" class="btn1">
                        Hubungi Kami
                      </a>
                      <!-- Link to Tentang Kami page -->
                      <a href="{{ route('about') }}" class="btn2">
                        Tentang Kami
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
  
  <!-- end info_section -->
@endsection
