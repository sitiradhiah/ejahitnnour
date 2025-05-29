@extends('layouts.main')

@section('css')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #fff4fd, #ffe3ef);
    }

    /* Container gabungan slider + banner */
    .hero-section {
        background: linear-gradient(to right, #fce4ec, #f1afc6);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        padding: 0;
        margin-bottom: 30px;
        overflow: hidden;
    }

    /* Styling for the slider */
    .slider-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        margin: auto;
        overflow: hidden;
    }

    /* Slider setup: hide all images initially */
    .slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        width: 100%;
        display: none; /* Hide all slides by default */
    }

    /* Make sure all images fill the container */
    .slider img {
        width: 100%;
        height: 400px; /* Adjust height as needed */
        object-fit: cover;
    }

    /* Navigation buttons */
    .slider-navigation {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .prev, .next {
        font-size: 30px;
        color: white;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        cursor: pointer;
    }

    /* Dots for slider navigation */
    .dots-container {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
    }

    .dot {
        height: 10px;
        width: 10px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .dot.active {
        background-color: #717171;
    }

    /* Add styling for mobile responsiveness */
    @media (max-width: 768px) {
        .slider img {
            height: 250px; /* Smaller height for mobile */
        }
    }


    /* Banner bawah slider */
    .hero-banner {
        padding: 30px 20px;
        text-align: center;
        color: #880e4f;
        border-radius: 0 0 12px 12px;
    }

    .hero-banner h2 {
        font-size: 2.6rem;
        font-weight: 700;
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

    /* Pulse animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        background: transparent;
    }

    .filter-bar select {
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #c2185b;
        font-size: 1rem;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .filter-bar select:hover {
        border-color: #880e4f;
        transform: scale(1.02);
    }

    .filter-bar select:focus {
        outline: none;
        border-color: #880e4f;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Container katalog produk */
    .catalogue-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        padding: 30px 20px;
        animation: fadeIn 1s ease-in-out;
        margin-top: 20px; /* Ruang antara banner dan katalog */
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

        .slider img {
            height: 250px; /* lebih kecil di mobile */
        }
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
@endsection


@section('content')

<section class="hero-section">
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <img src="{{ asset('images/Slider1.jpg') }}" alt="Slider 1">
            </div>
            <div class="slide">
                <img src="{{ asset('images/Slider2.jpg') }}" alt="Slider 2">
            </div>
            <div class="slide">
                <img src="{{ asset('images/Slider3.jpg') }}" alt="Slider 3">
            </div>
        </div>
        <div class="slider-navigation">
            <span class="prev" onclick="moveSlide(-1)">&#10094;</span>
            <span class="next" onclick="moveSlide(1)">&#10095;</span>
        </div>
        <!-- Dots for slider navigation -->
        <div class="dots-container">
            <span class="dot" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>
    

    <div class="hero-banner">
        <h2>KATALOG REKA BENTUK PAKAIAN</h2>
        <p class="pre-order-text">JOM TEMPAH SEKARANG!</p>
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
    </div>
</section>

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


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
let currentIndex = 0;

function moveSlide(step) {
    const slides = document.querySelectorAll('.slide');
    currentIndex += step;
    if (currentIndex < 0) {
        currentIndex = slides.length - 1;
    } else if (currentIndex >= slides.length) {
        currentIndex = 0;
    }
    updateSlider();
}

function currentSlide(index) {
    currentIndex = index;
    updateSlider();
}

function updateSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    slides.forEach((slide, i) => {
        slide.style.display = i === currentIndex ? 'block' : 'none';  // Show current slide
    });

    dots.forEach((dot, i) => {
        dot.classList.remove('active');
        if (i === currentIndex) {
            dot.classList.add('active');  // Add active class to the current dot
        }
    });
}

// Initialize the slider
updateSlider();

</script>
@endsection


