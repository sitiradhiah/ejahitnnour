@extends('layouts.main')

{{-- @section('title', 'About Us') --}}

@section('content')
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container-fluid" style="min-height: 45vh;">
      <div class="row">
        <div class="col-md-6">
          <div class="img_container">
            <div class="media-box">
              <img class="media-item" src="images/about1.jpg" alt="Gambar Kedai">
            </div>
            <div class="media-box">
              <video class="media-item" controls>
                <source src="images/alter1.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="media-box">
              <video class="media-item" controls>
                <source src="images/alter2.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <h2>
              Tentang Kedai Kami
            </h2>
            <p class="short-text">
              Kedai Jahit N'NOUR telah ditubuhkan pada tahun 2019, bermula dengan operasi dari rumah...
            </p>
            <p class="long-text" style="display: none; text-align: justify;">
              Kedai Jahit N'NOUR telah ditubuhkan pada tahun 2019, bermula dengan operasi dari rumah dan kini berkembang menjadi sebuah kedai fizikal yang terletak di Taman Perdana, Ayer Hitam. 
              Kami menawarkan pelbagai servis jahitan tempahan pakaian, termasuk baju tradisional, moden, dan pakaian khas untuk pelbagai acara seperti perkahwinan, majlis rasmi, dan lain-lain. 
              Selain itu, kami juga menyediakan perkhidmatan pengubahsuaian pakaian seperti mengecilkan atau membesarkan saiz untuk memastikan pakaian anda sesuai dan selesa dipakai.
              Dengan lokasi strategik, Kedai Jahit N'NOUR memudahkan pelanggan untuk berbincang secara langsung dan mendapatkan hasil jahitan yang berkualiti tinggi mengikut keperluan anda. Kami berkomitmen untuk memberikan perkhidmatan terbaik bagi memenuhi setiap permintaan pelanggan dengan kepakaran dan sentuhan profesional.
            </p>
            <button class="read-more-btn">Lihat Lagi</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* Button Styling */
    .read-more-btn {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #4CAF50; /* Green background */
      color: #fff; /* White text */
      border: none;
      border-radius: 5px;
      text-transform: uppercase;
      font-weight: bold;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .read-more-btn:hover {
      background-color: #45a049; /* Slightly darker green */
      transform: translateY(-2px); /* Slight lift */
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .read-more-btn:active {
      transform: translateY(0); /* Reset lift */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ensure all media items (images and videos) have the same dimensions */
    .media-box {
      margin-bottom: 20px; /* Add spacing between items */
    }

    .media-item {
      width: 100%;
      height: auto; /* Maintain aspect ratio */
      max-height: 300px; /* Set a consistent maximum height */
      object-fit: cover; /* Ensures content fits within dimensions */
      border: 1px solid #ddd; /* Optional border for styling */
      border-radius: 8px; /* Optional rounded corners */
    }
  </style>

  <script>
    // JavaScript for Read More functionality
    document.querySelector('.read-more-btn').addEventListener('click', function () {
      const shortText = document.querySelector('.short-text');
      const longText = document.querySelector('.long-text');
      const button = this;

      if (longText.style.display === 'none') {
        shortText.style.display = 'none';
        longText.style.display = 'block';
        button.textContent = 'Kembali';
      } else {
        shortText.style.display = 'block';
        longText.style.display = 'none';
        button.textContent = 'Lihat Lagi';
      }
    });
  </script>


  <!-- end about section -->


 
  @endsection