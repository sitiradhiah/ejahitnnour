@extends('layouts.main')

@section('css')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #fff4fd, #ffe3ef);
    }

    /* Styling untuk Image Slider */
    .hero-slider {
        width: 100%;
        margin-bottom: 20px;
    }

    .slider-container {
        overflow: hidden;
        position: relative;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slider img {
        width: 100%;
        height: auto;
        object-fit: cover;
        max-height: 400px; /* Saiz maksimum untuk gambar slider */
        display: block;
    }

    /* Animasi untuk slider */
    @keyframes slide {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(-200%);
        }
    }

    .hero-banner {
        width: 100%;
        background: linear-gradient(to right, #fce4ec, #f1afc6);
        padding: 40px 20px; /* Kecilkan sedikit padding */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
    }

    .hero-banner h2 {
        font-size: 2.6rem;
        font-weight: 700;
        color: #880e4f;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pre-order-text {
        font-size: 2.4rem;
        font-weight: 700;
        color: #c2185b;
        text-transform: uppercase;
        margin-bottom: 15px;
        background: linear-gradient(to left, #ff4081, #880e4f);
        -webkit-background-clip: text;
        color: transparent;
        letter-spacing: 2px;
        animation: pulse 1.5s infinite;
    }

    .catchphrase {
        font-size: 1.2rem;
        color: #6a1b9a;
        font-weight: 500;
        margin-top: 15px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        background: transparent; /* Set background transparent */
    }

    .filter-bar select {
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #c2185b; /* New border color to make it stand out */
        font-size: 1rem;
        background-color: #fff; /* Set background transparent */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .filter-bar select:hover {
        border-color: #880e4f; /* Make border darker on hover */
        transform: scale(1.02);
    }

    .filter-bar select:focus {
        outline: none;
        border-color: #880e4f;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add box-shadow on focus */
    }

    .catalogue-container {
            display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        padding: 30px 20px;
        animation: fadeIn 1s ease-in-out;
        margin-top: 20px; /* Memberi sedikit ruang antara slider dan katalog */
    }

    .product-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        text-align: center;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .product-card img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-bottom: 2px solid #e0e0e0;
    }

    .product-details {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-weight: 600;
        font-size: 1.2rem;
        color: #a1007d;
        margin-bottom: 8px;
    }

    .product-info {
        font-size: 0.95rem;
        color: #444;
        margin-bottom: 4px;
    }

    .product-price {
        color: #00aaff;
        font-weight: bold;
        font-size: 1.1rem;
        margin-top: 10px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-banner {
            padding: 30px 10px 60px;
        }

        .hero-banner h2 {
            font-size: 1.8rem;
        }

        .filter-bar {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
@endsection


@section('content')

<section class="hero-slider">
    <div class="slider-container">
        <div class="slider">
            <img src="{{ asset('images/Slider1.jpg') }}" alt="Slider 1">
            <img src="{{ asset('images/Slider2.jpg') }}" alt="Slider 2">
            <img src="{{ asset('images/Slider3.jpg') }}" alt="Slider 3">
        </div>
    </div>
</section>

<section class="hero-banner">
    <h2>KATALOG REKA BENTUK PAKAIAN</h2>
    <p class="pre-order-text">PRE-ORDER NOW!</p>
    <p class="catchphrase">Tempah ikut citarasa anda. Cepat dan mudah.</p>
    
    <form method="GET" class="filter-bar">
        <select name="kategori" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->name }}" {{ request('kategori') == $cat->name ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="warna" onchange="this.form.submit()">
            <option value="">Semua Warna</option>
            @foreach($warnaList as $w)
                <option value="{{ $w }}" {{ request('warna') == $w ? 'selected' : '' }}>
                    {{ $w }}
                </option>
            @endforeach
        </select>

        <select name="saiz" onchange="this.form.submit()">
            <option value="">Semua Saiz</option>
            @foreach($saizList as $s)
                <option value="{{ $s }}" {{ request('saiz') == $s ? 'selected' : '' }}>
                    {{ $s }}
                </option>
            @endforeach
        </select>
    </form>
</section>

<!-- ✅ Fade effect antara layer -->
<div class="fade-divider"></div>

<section class="catalogue-section py-5">
    <div class="container">
        <div class="catalogue-container">
            @foreach($katalogs as $item)
            <div class="product-card">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                <div class="product-details">
                    <div class="product-name">{{ $item->nama }}</div>
                    <div class="product-info">Kategori: {{ $item->kategori ?? '-' }}</div>
                    <div class="product-info">Warna: {{ $item->warna ?? '-' }}</div>
                    <div class="product-info">Saiz: {{ $item->saiz ?? 'S - 2XL' }}</div>
                    <div class="product-info mt-2">{{ $item->penerangan ?? '' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection