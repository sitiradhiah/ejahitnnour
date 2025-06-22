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
            <h1>Borang Pra-Temujanji / Pra-Tempahan</h1>
            <!-- Tambah borang maklumat peribadi tempahan dari pelanggan -->
            <form action="{{ route('pra-tempahan.submit') }}" method="POST" class="tempahan-form" style="max-width: 500px; margin: 0 auto; text-align: left;">
                @csrf
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Anda <span style="color: yellow">***</span></label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombor_telefon" class="form-label">No. Telefon <span style="color: yellow">***</span></label>
                        <input type="text" class="form-control" id="nombor_telefon" name="nombor_telefon" placeholder="" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Emel <span style="color: yellow">***</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <small id="emailWarning" class="text-danger d-none">Emel ini telah digunakan. Sila guna emel lain.</small>
                        <small id="workerWarning" class="text-warning d-none">Emel ini dimiliki pekerja/pentadbir. Sila log masuk untuk membuat tempahan.</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <div class="alert alert-info" style="font-size: 0.95rem;">
                        <strong>Nota:</strong> Sila lihat <a href="{{ route('KatalogUmum') }}" target="_blank">katalog</a> terlebih dahulu untuk contoh design sebelum membuat pilihan kategori dan design.
                    </div>
                    <label for="jenis_Kategori" class="form-label">Jenis Kategori <span style="color: yellow">***</span></label>
                    @php
                        $kategoriList = \App\Models\Katelog::distinct()->pluck('kategori');
                    @endphp
                    <select class="form-control" id="jenis_Kategori" name="jenis_Kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                        @endforeach
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_Kategori" class="form-label">Nama Design</label>

                    <select class="form-control" id="nama_design" name="nama_design" disabled>
                        <option value="">-- Pilih Kategori Dahulu --</option>
                        {{-- Options akan diisi secara dinamik melalui JavaScript --}}
                    </select>

                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan (Jika Ada)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                </div>
                <button type="submit" class="btn1" style="background-color: #007bff; color: #fff;">Hantar Pra-Tempahan</button>
                <button type="button" class="btn1" style="background-color: #17a2b8; color: #fff;" onclick="showFirstSection()">Kembali</button>
            </form>
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
    // Auto-show second section if URL has ?show=form or #form
    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        const hash = window.location.hash;

        if (urlParams.get('show') === 'form' || hash === '#form') {
            showSecondSection();
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('jenis_Kategori');
    const designSelect = document.getElementById('nama_design');

    // ✅ Only run this logic if user *interacts* with dropdown
    kategoriSelect.addEventListener('change', function() {
        const kategori = this.value;
        designSelect.innerHTML = '<option value="">-- Pilih Design --</option><option value="Lain-lain">Lain-lain</option>'; // Reset

        if (kategori) {
            designSelect.disabled = false;

            fetch(`/public/get-designs-by-kategori?kategori=${encodeURIComponent(kategori)}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    if (Array.isArray(data)) {
                        data.forEach(function(design) {
                            const option = document.createElement('option');
                            option.value = design;
                            option.textContent = design;
                            designSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching designs:', error);
                });
        } else {
            designSelect.disabled = true;
            designSelect.innerHTML = '<option value="">-- Pilih Kategori Dahulu --</option>';
        }
    });

     const emailInput = document.getElementById('email');
    const emailWarning = document.getElementById('emailWarning');
    const workerWarning = document.getElementById('workerWarning');
    const form = document.querySelector('.tempahan-form');

    let emailValid = true;

    emailInput.addEventListener('input', function () {
        const email = emailInput.value.trim();

        // Reset warnings if empty
        if (!email) {
            emailWarning.classList.add('d-none');
            workerWarning.classList.add('d-none');
            emailValid = true;
            return;
        }

        fetch(`/check-email-exists?email=${encodeURIComponent(email)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    if (data.isWorker) {
                        workerWarning.classList.remove('d-none');
                        emailWarning.classList.add('d-none');
                        emailValid = false;
                    } else {
                        emailWarning.classList.remove('d-none');
                        workerWarning.classList.add('d-none');
                        emailValid = false;
                    }
                } else {
                    // Clear all warnings
                    emailWarning.classList.add('d-none');
                    workerWarning.classList.add('d-none');
                    emailValid = true;
                }
            });
    });

    form.addEventListener('submit', function (e) {
        if (!emailValid) {
            e.preventDefault();
            alert("Emel tidak sah. Sila periksa mesej di bawah medan emel.");
        }
    });
});

</script>

@endsection
