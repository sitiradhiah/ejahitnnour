@extends('layouts.main')

@section('css')
<style>
  .hero_area {
    background: url('images/gambarkedai1.png') no-repeat;
    background-size: cover;
    background-position: center;
    min-height: 80vh; /* Increased height */
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .h2-custom {
        color: #b42e8b;
        /* font-weight: bold; */
        
    }

  .detail-box {
    background: rgba(15, 15, 15, 0.7); /* Darker background for better visibility */
    padding: 50px 40px; /* More padding for spacious content */
    border-radius: 20px;
    color: #fff;
    text-align: center;
    max-width: 900px; /* Increased width */
    width: 90%; /* Makes it responsive */
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3); /* Deeper shadow */
  }

  .detail-box h1 {
    font-size: 65px; /* Larger font size for the title */
    font-weight: 800;
    margin-bottom: 20px;
  }

  .detail-box p {
    font-size: 20px;
    margin-bottom: 30px;
    line-height: 1.8; /* Better readability */
  }

  .divider {
    height: 50px;
    background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153)); 
      border-bottom: 10px solid rgba(132, 11, 92, 0.995);
}


  .btn-box {
    margin-top: 20px;
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
  }

  .btn2 {
    background: #fff;
    color: #000;
  }

  .btn1:hover,
  .btn2:hover {
    text-decoration: none;
    transform: scale(1.05);
    transition: 0.3s ease-in-out;
  }

  /* Search Bar Styles */
  .search-bar-container {
    margin-top: 30px;
  }

  .search-bar-container form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }

  .search-bar-container input[type="text"] {
    width: 70%; /* Wider search bar */
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


  
</style>
@endsection

@section('content')

<div class="hero_area">
  <div class="detail-box">
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
    <!-- Search Bar -->
    <!-- Search Bar -->
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

<div style="display: flex; justify-content: space-around; text-align: center; padding: 50px;">
  <div style="max-width: 300px;">
      <img src="images/talkbubble.png" alt="Tailor Icon" style="width: 80px;">
      <h3 class="h2-custom">Bercakap dengan Tukang Jahit</h3>
      <p>Teliti koleksi produk dan perkhidmatan kami dan hubungi tukang jahit untuk tempahan anda.</p>
  </div>

  <div style="max-width: 300px;">
      <img src="images/talitape.png" alt="Fit Icon" style="width: 80px;">
      <h3 class="h2-custom">Menemui Padanan</h3>
      <p>Proses menyesuaikan padanan pakaian dengan bantuan tukang jahit berpengalaman untuk memastikan keselesaan dan gaya.</p>
  </div>

  <div style="max-width: 300px;">
      <img src="images/tempahankhas.png" alt="Bespoke Icon" style="width: 80px;">
      <h3 class="h2-custom">Tempahan Khas</h3>
      <p>Pembuatan pakaian khas dengan perhatian terhadap setiap perincian dan kehendak peribadi pelanggan.</p>
  </div>

  <div style="max-width: 300px;">
      <img src="images/bergaya.png" alt="Style Icon" style="width: 80px;">
      <h3 class="h2-custom">Kelihatan Hebat, Rasa Hebat</h3>
      <p>Penampilan elegan dan selesa untuk setiap majlis dengan tempahan pakaian eksklusif dari kami.</p>
  </div>
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





@endsection
