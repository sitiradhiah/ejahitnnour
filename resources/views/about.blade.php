@extends('layouts.main')

@section('css')
<style>
    .about_section .row {
        align-items: flex-start; /* Ensure content is aligned at the top */
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
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Added subtle shadow for depth */
    }

    .media-item:hover {
        transform: scale(1.05); /* Zoom-in effect on hover */
        transition: transform 0.3s ease;
    }

    .detail-box {
        padding: 20px;
    }

    .h1-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
        background: linear-gradient(90deg, #b42e8b, #f056a1);
        -webkit-background-clip: text;
        color: transparent;
    }

    h2, h3 {
        color: #444;
    }

    h3 {
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        line-height: 2.0; /* Increased line height for readability */
        color: #333;
    }

    .font1 {
        font-size: 1.5em;
        margin-top: 20px; /* Added margin to separate sections */
    }

    /* Add subtle fade-in effect for sections */
    .about_section .row {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    /* Button style */
    .btn1 {
        background-color: #b42e8b;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 1.2em;
        display: inline-block;
        text-align: center;
        margin-top: 30px;
    }

    .btn1:hover {
        background-color: #f056a1;
    }
</style>
@endsection

@section('content')
<!-- about section -->
<section class="about_section layout_padding">
    <header class="text-center">
        <h1 class="h1-custom">
            TENTANG KEDAI KAMI
        </h1>
    </header>
    <div class="container-fluid" style="min-height: 60vh;">
        <div class="row p-5">
            <div class="col">
                <img class="media-item" src="images/about1.jpg" alt="Gambar Kedai">
            </div>
            <div class="col">
                <span class="font1 fw-bold">Sejarah Penubuhan</span>
                <p class="font1" style="text-align: justify;">
                    Kedai Jahit N'NOUR telah ditubuhkan pada tahun 2019, 
                    bermula dengan operasi kecil-kecilan dari rumah dan kini berkembang menjadi sebuah kedai 
                    fizikal yang terletak di Taman Perdana, Ayer Hitam. Dengan dedikasi dan usaha gigih, 
                    kami telah berjaya menarik kepercayaan pelanggan dari pelbagai lapisan masyarakat yang menghargai 
                    hasil kerja tangan yang berkualiti tinggi serta layanan yang mesra.
                </p>
            </div>
            <div class="w-100 my-2"></div>
            <div class="col">
                <span class="font1 fw-bold">Perkhidmatan Kami</span>
                <p class="font1" style="text-align: justify;">
                    Kami menawarkan pelbagai servis jahitan tempahan pakaian yang direka khas mengikut citarasa pelanggan. 
                    Antara perkhidmatan utama kami adalah menjahit pakaian tradisional seperti baju kurung, baju melayu, kebaya,
                     dan kurta, selain pakaian moden yang sesuai untuk pelbagai acara seperti majlis perkahwinan, majlis rasmi, 
                     dan perayaan. Setiap tempahan dipastikan mendapat perhatian teliti dan sentuhan perincian yang menjadikan 
                     hasil jahitan kami unik dan eksklusif.
                </p>
            </div>
            <div class="col">
                <video class="media-item" controls>
                    <source src="images/alter2.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="w-100 my-2"></div>
            <div class="col">
                <video class="media-item" controls>
                    <source src="images/alter1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="col">
                <span class="font1 fw-bold">Pengubahsuaian Pakaian</span>
                <p class="font1" style="text-align: justify;">
                    Selain itu, kami juga menyediakan perkhidmatan pengubahsuaian pakaian seperti mengecilkan, 
                    membesarkan, atau membaiki pakaian agar sesuai dengan saiz dan keperluan pelanggan. 
                    Kami memahami kepentingan pakaian yang tidak hanya kelihatan cantik tetapi juga memberikan 
                    keselesaan kepada pemakai. Dengan kepakaran dalam bidang jahitan, kami memastikan setiap
                    pengubahsuaian dilakukan dengan sempurna tanpa mengorbankan kualiti atau reka bentuk asal.
                </p>
            </div>
        </div>
        <!-- Call-to-action Button linked to 'Hubungi Kami' page -->
        <a href="{{ route('hubungi.kami') }}" class="btn1">Hubungi Kami</a>
    </div>
</section>

@endsection
