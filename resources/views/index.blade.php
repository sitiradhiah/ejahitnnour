@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    {{-- Include the extracted CSS --}}
    @include('partials.css-index')
@endsection

@section('content')
<div id="first-section">
    <div class="hero_area py-5">
        <div class="detail-box">
            <h1 class="mb-0">Selamat Datang ke Laman Web Kedai Jahit N'NOUR</h1>
            <h3 style="font-weight: normal; font-size: 1.5rem; margin-bottom: 10px;">(Ayer Hitam, Johor)</h3>
            <p>Kami menyediakan pelbagai perkhidmatan jahitan dan reka bentuk pakaian yang berkualiti tinggi. Dari jahitan biasa hingga tempahan khas, kami berkomitmen untuk memberikan hasil yang memuaskan kepada pelanggan kami. Untuk maklumat lanjut,
            sila lihat reka bentuk tempahan dan perkhidmatan yang di tawarkan.</p>

            <div class="btn-box">
                <button type="button" class="btn1" onclick="showSecondSection()">Tempah Sekarang!!</button>
            </div>

            <div class="search-bar-container">
            <form id="searchForm" action="{{ route('KatalogUmum') }}" method="GET">
                <input type="text" id="searchInput" name="search" placeholder="Cari reka bentuk atau perkhidmatan..." required>
                <button type="submit">Cari</button>
            </form>
            </div>
        </div>
    </div>

    <div style="text-align: center; padding: 50px 0 0 0;">
        <h3 class="h3-custom">Perkhidmatan Dan Produk Berkualiti Pada Harga Berpatutan</h3>
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
    <h3 class="h3-custom">Semakan Pesanan Anda</h3>
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
        if (!isset($testimonials) || $testimonials->isEmpty()) {
            $testimonials = collect();
        }
    @endphp

    <section class="testimoni-section">
        <h3 class="h3-custom">Apa Kata Pelanggan Kami</h3>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            @if(isset($testimonials) && $testimonials->count())
            @foreach($testimonials as $testi)
            <div class="swiper-slide">
                @if(isset($testi->image) && $testi->image && file_exists(public_path('storage/images/' . $testi->image)))
                <img src="{{ asset('storage/images/' . $testi->image) }}" alt="{{ $testi->name }}"/>
                @else
                <img src="{{ asset('images/default-user.png') }}" alt="Default Image"/>
                @endif
                <div class="testimoni-name">{{ $testi->name }}</div>
                <div class="testimoni-text">"{{ $testi->feedback }}"</div>
            </div>
            @endforeach
            @else
            <div class="swiper-slide">
                <img src="{{ asset('images/default-user.png') }}" alt="Default Image"/>
                <div class="testimoni-name">Tiada Testimoni</div>
                <div class="testimoni-text">"Belum ada testimoni pelanggan."</div>
            </div>
            @endif
            </div>
        </div>
    </section>
</div>

<div id="second-section">
    <div class="container py-5 d-flex justify-content-center align-items-center flex-column" style="text-align: center;">
        <div class="detail-box">
            <h1 class="mb-0">Borang Pra-Temujanji / Pra-Tempahan</h1>
            <!-- Tambah borang maklumat peribadi tempahan dari pelanggan -->
            <button type="button" onclick="showFirstSection()">Kembali</button>
        </div>
    </div>
</div>
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

<!-- Tempahan  -->
 <script>
    function showSecondSection() {
        document.getElementById("first-section").style.display = "none";
        document.getElementById("second-section").style.display = "block";
        window.scrollTo(0, 0); // Optional: scroll to top
    }

    function showFirstSection() {
        document.getElementById("second-section").style.display = "none";
        document.getElementById("first-section").style.display = "block";
        window.scrollTo(0, 0); // Optional
    }
</script>

@endsection
