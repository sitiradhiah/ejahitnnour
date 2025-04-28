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

  .divider {
    height: 50px;
    background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153));
    border-bottom: 10px solid rgba(132, 11, 92, 0.995);
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
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 20px;
    object-fit: cover;
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
  }
</style>
@endsection

@section('content')

<div class="hero_area">
  <div class="detail-box">
    <h1>KEDAI JAHIT N'NOUR</h1>
    <p>Selamat Datang ke Kedai Jahit N'NOUR, sila lihat reka bentuk tempahan dan perkhidmatan yang di tawarkan.</p>
    <div class="btn-box">
      <a href="{{ route('hubungi.kami') }}" class="btn1">Hubungi Kami</a>
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

<div class="divider"></div>

<div style="text-align: center; padding: 100px 0;">
  <h2>Pengesanan Tempahan Anda</h2>
  <p>Jejaki tempahan berdasarkan format nombor penjejakan</p>
  <div class="form-group">
    <input type="text" placeholder="Nombor penjejakan (ID)">
    <button><i class="fa fa-search"></i> Cari</button>
  </div>
</div>

<div class="divider"></div>

<section class="testimoni-section">
  <h2>Apa Kata Pelanggan Kami</h2>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="{{ asset('images/user1.jpg') }}" alt="Nurul Ain">
        <div class="testimoni-name">Nurul Ain</div>
        <div class="testimoni-text">"Saya sangat berpuas hati dengan hasil jahitan dari N'NOUR. Servis terbaik dan pantas!"</div>
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('images/user2.jpg') }}" alt="Siti Khadijah">
        <div class="testimoni-name">Siti Khadijah</div>
        <div class="testimoni-text">"Material kain sangat selesa, design ikut apa yang saya minta. Recommended!"</div>
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('images/user3.jpg') }}" alt="Azman Hakim">
        <div class="testimoni-name">Azman Hakim</div>
        <div class="testimoni-text">"Tempahan siap cepat dan kualiti sangat memuaskan. Terima kasih!"</div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper(".mySwiper", {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});
</script>
@endsection
