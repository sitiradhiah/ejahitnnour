@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

<style>
  .hero_area {
    background: url('images/gambarkedai1.png') no-repeat;
    background-size: cover;
    background-position: center;
    min-height: 80vh;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .h2-custom {
    color: #b42e8b;
  }

  .detail-box {
    background: rgba(15, 15, 15, 0.7);
    padding: 50px 40px;
    border-radius: 20px;
    color: #fff;
    text-align: center;
    max-width: 900px;
    width: 90%;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
  }

  .detail-box h1 {
    font-size: 65px;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .detail-box p {
    font-size: 20px;
    margin-bottom: 30px;
    line-height: 1.8;
  }

  /* Divider yang lebih minimalis */
  .divider {
    height: 0;
    margin: 40px 0;
    border: none;
    background: transparent;
  }

  /* Mengganti divider dengan garis halus dan lebih bersih */
  .divider::before {
    content: '';
    display: block;
    width: 80%;
    height: 2px;
    background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153));
    margin: 0 auto;
  }

  .btn-box {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn1,
  .btn2 {
    background: #72ca4f;
    color: #fff;
    padding: 15px 30px;
    border-radius: 30px;
    margin: 10px;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 18px;
    text-decoration: none;
  }

  .btn2 {
    background: #fff;
    color: #000;
  }

  .btn1:hover,
  .btn2:hover {
    transform: scale(1.05);
    transition: 0.3s ease-in-out;
  }

  .search-bar-container {
    margin-top: 30px;
  }

  .search-bar-container form {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
  }

  .search-bar-container input[type="text"] {
    width: 70%;
    padding: 15px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 30px 0 0 30px;
    outline: none;
  }

  .search-bar-container button {
    padding: 15px 30px;
    font-size: 18px;
    border: none;
    background-color: #2faee0;
    color: #fff;
    cursor: pointer;
    border-radius: 0 30px 30px 0;
  }

  .search-bar-container button:hover {
    background-color: #d0002b;
  }

  .testimoni-section {
    padding: 80px 20px;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(200, 230, 255, 0.7));
    text-align: center;
  }

  .testimoni-section h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 40px;
    color: #b42e8b;
  }

  .swiper {
    width: 100%;
    max-width: 900px;
    padding-top: 20px;
    padding-bottom: 50px;
  }

  .swiper-slide {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
    text-align: center;
  }

  .swiper-slide img {
    width: 700px;
    height: 500px;
    border-radius: 0;
    margin-bottom: 20px;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .testimoni-name {
    font-weight: bold;
    margin-top: 10px;
    color: #333;
  }

  .testimoni-text {
    font-style: italic;
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
  }

  /* --- Tambahan untuk Order Check Section --- */

  .order-check-section {
    background: #f0f8ff;
    padding: 80px 20px;
    text-align: center;
    border-radius: 15px;
    max-width: 600px;
    margin: 40px auto;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .order-check-section h2 {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: #333;
  }

  .order-check-section p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: #555;
  }

  .order-check-form {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .order-check-form input[type="text"] {
    padding: 12px 20px;
    font-size: 1rem;
    border: 2px solid #ccc;
    border-radius: 8px;
    width: 70%;
    max-width: 400px;
    transition: border-color 0.3s ease;
  }

  .order-check-form input[type="text"]:focus {
    border-color: #b42e8b;
    outline: none;
  }

  .order-check-form button {
    background-color: #b42e8b;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .order-check-form button:hover {
    background-color: #8a2167;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    .detail-box {
      padding: 30px 20px;
      max-width: 100%;
    }

    .detail-box h1 {
      font-size: 40px;
    }

    .detail-box p {
      font-size: 16px;
    }

    .btn-box {
      flex-direction: column;
    }

    .btn1, .btn2 {
      width: 80%;
      margin: 5px 0;
      font-size: 16px;
    }

    .search-bar-container input[type="text"] {
      width: 100%;
      border-radius: 30px 30px 0 0;
    }

    .search-bar-container button {
      width: 100%;
      border-radius: 0 0 30px 30px;
    }

    .search-bar-container form {
      flex-direction: column;
    }

    .order-check-form {
      flex-direction: column;
    }

    .order-check-form input[type="text"] {
      width: 100%;
      margin-bottom: 15px;
    }

    .order-check-form button {
      width: 100%;
      padding: 15px;
    }
  }
</style>
@endsection


@section('content')

<div class="hero_area">
  <div class="detail-box">
    <h1>KEDAI JAHIT N'NOUR</h1>
    <p>Selamat Datang ke Kedai Jahit N'NOUR, sila lihat reka bentuk tempahan dan perkhidmatan yang di tawarkan.</p>
    <div class="btn-box">
      <a href="{{ route('hubungi.kami') }}" class="btn1">Tempah Sekarang!!</a>
      <a href="{{ route('about') }}" class="btn2">Tentang Kami</a>
    </div>
    <div class="search-bar-container">
      <form id="searchForm" action="{{ route('KatalogUmum') }}" method="GET">
        <input type="text" id="searchInput" name="search" placeholder="Cari reka bentuk atau perkhidmatan..." required>
        <button type="submit">Cari</button>
      </form>
    </div>
  </div>
</div>

<!-- Divider telah dikurangkan dan ditukar dengan gaya yang lebih bersih -->
<div class="divider"></div>

<div style="text-align: center; padding: 100px 0;">
  <h2 style="font-size: 2.5rem; font-weight: bold;">Perkhidmatan Dan Produk Berkualiti Pada Harga Berpatutan</h2>
</div>

<div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; text-align: center; padding: 50px;">
  @foreach (['talkbubble' => 'Bercakap dengan Tukang Jahit', 'talitape' => 'Menemui Padanan', 'tempahankhas' => 'Tempahan Khas', 'bergaya' => 'Kelihatan Hebat, Rasa Hebat'] as $icon => $title)
    <div style="max-width: 250px;">
      <img src="{{ asset('images/' . $icon . '.png') }}" alt="{{ $title }}" style="width: 80px;">
      <h3 class="h2-custom">{{ $title }}</h3>
      <p>Deskripsi pendek untuk {{ strtolower($title) }}.</p>
    </div>
  @endforeach
</div>

<!-- Divider telah dikurangkan dan ditukar dengan gaya yang lebih bersih -->
<div class="divider"></div>

<div class="order-check-section">
  <h2>Semakan Pesanan Anda</h2>
  <p>Semak tempahan anda untuk mengetahui kemajuan</p>
  <form class="order-check-form" id="order-check-form">
      <input type="text" id="query" placeholder="Masukkan nama atau no telefon" name="query" required>
      <button type="button" id="search-btn"><i class="fa fa-search"></i> Cari</button>
  </form>

  <!-- Paparan status tempahan akan muncul di bawah form semakan -->
  <div id="status-section" class="mt-4"></div>
</div>


<div class="divider"></div>

@php
    $testimonials = \App\Models\Testimonial::all();
@endphp

<section class="testimoni-section">
  <h2>Apa Kata Pelanggan Kami</h2>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      @foreach($testimonials as $testi)
      <div class="swiper-slide">
        <!-- Pastikan gambar diambil dari folder public/images -->
        @if($testi->image && file_exists(public_path('storage/images/' . $testi->image)))
          <img src="{{ asset('storage/images/' . $testi->image) }}" alt="{{ $testi->name }}"/>
        @else
          <img src="{{ asset('images/default-user.png') }}" alt="Default Image"/>
        @endif
        <div class="testimoni-name">{{ $testi->name }}</div>
        <div class="testimoni-text">"{{ $testi->feedback }}"</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
var swiper = new Swiper(".mySwiper", {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});
</script>

<script>
  jQuery(document).ready(function() {
      // Event listener untuk butang Cari
      jQuery('#search-btn').on('click', function() {
          // Ambil nilai input carian
          var query = jQuery('#query').val();
    
          // Pastikan input tidak kosong
          if(query.trim() !== '') {
              // Hantar permintaan AJAX ke route semakan-pesanan
              jQuery.ajax({
                  url: '{{ route("semakan-pesanan") }}', // Route yang akan dipanggil
                  method: 'GET',
                  data: { query: query },
                  success: function(response) {
                      // Paparkan hasil semakan di bawah form
                      jQuery('#status-section').html(response);
                  },
                  error: function() {
                      alert('Ralat semasa memuatkan semakan.');
                  }
              });
          } else {
              alert('Sila masukkan nama atau nombor telefon.');
          }
      });
  });
</script>

@endsection
