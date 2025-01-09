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
    <div class="search-bar-container">
        <input type="text" name="q" placeholder="Cari reka bentuk atau perkhidmatan..." required>
        <button type="submit">Cari</button>
      </form>
    </div>
  </div>
</div>

@endsection
