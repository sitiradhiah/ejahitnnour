@extends('layouts.main')

@section('content')
<!-- about section -->
<section class="about_section layout_padding">
    <div class="container-fluid" style="min-height: 60vh;">
        <div class="row align-items-start">
            <!-- Media Section -->
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

            <!-- Detail Section -->
            <div class="col-md-6">
                <div class="detail-box">
                    <h2 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">
                        Tentang Kedai Kami
                    </h2>

                    <h3 style="font-size: 22px; font-weight: bold; margin-top: 20px;">Sejarah Penubuhan</h3>
                    <p style="text-align: justify;">
                        Kedai Jahit N'NOUR telah ditubuhkan pada tahun 2019, bermula dengan operasi kecil-kecilan dari rumah dan kini berkembang menjadi sebuah kedai fizikal yang terletak di Taman Perdana, Ayer Hitam. Dengan dedikasi dan usaha gigih, kami telah berjaya menarik kepercayaan pelanggan dari pelbagai lapisan masyarakat yang menghargai hasil kerja tangan yang berkualiti tinggi serta layanan yang mesra.
                    </p>

                    <h3 style="font-size: 22px; font-weight: bold; margin-top: 20px;">Perkhidmatan Kami</h3>
                    <p style="text-align: justify;">
                        Kami menawarkan pelbagai servis jahitan tempahan pakaian yang direka khas mengikut citarasa pelanggan. Antara perkhidmatan utama kami adalah menjahit pakaian tradisional seperti baju kurung, baju melayu, kebaya, dan kurta, selain pakaian moden yang sesuai untuk pelbagai acara seperti majlis perkahwinan, majlis rasmi, dan perayaan. Setiap tempahan dipastikan mendapat perhatian teliti dan sentuhan perincian yang menjadikan hasil jahitan kami unik dan eksklusif.
                    </p>

                    <h3 style="font-size: 22px; font-weight: bold; margin-top: 20px;">Pengubahsuaian Pakaian</h3>
                    <p style="text-align: justify;">
                        Selain itu, kami juga menyediakan perkhidmatan pengubahsuaian pakaian seperti mengecilkan, membesarkan, atau membaiki pakaian agar sesuai dengan saiz dan keperluan pelanggan. Kami memahami kepentingan pakaian yang tidak hanya kelihatan cantik tetapi juga memberikan keselesaan kepada pemakai. Dengan kepakaran dalam bidang jahitan, kami memastikan setiap pengubahsuaian dilakukan dengan sempurna tanpa mengorbankan kualiti atau reka bentuk asal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .about_section .row {
        align-items: flex-start; /* Pastikan konten sejajar di atas */
    }

    .img_container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .media-box {
        margin-bottom: 20px;
    }

    .media-item {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .detail-box {
        padding: 20px;
    }

    h2, h3 {
        color: #444;
    }

    h3 {
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }
</style>
@endsection
