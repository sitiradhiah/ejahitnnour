@extends('layouts.main')

@section('css')
<style>
    .catalogue-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        padding: 20px 0;
    }

    .product-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: 0.3s;
        text-align: center;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    .product-details {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-name {
        font-weight: bold;
        font-size: 1.2rem;
        color: #b42e8b;
        margin-bottom: 8px;
    }

    .product-info {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 3px;
    }

    .product-price {
        color: #00b4d8;
        font-weight: bold;
        font-size: 1.1rem;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<section class="catalogue-section py-5">
    <div class="container">
        <h2 class="h2-custom text-center">KATALOG PRODUK DAN PERKHIDMATAN</h2>
        <p class="p-custom text-center">Bahagian ini memaparkan katalog produk dan perkhidmatan yang ditawarkan oleh Kedai Jahit N'NOUR.</p>

        <!-- (Filter Bar di sini, kalau nak tambah boleh bagitau) -->

        <div class="catalogue-container">
            @foreach($katalogs as $item)
            <div class="product-card">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                <div class="product-details">
                    <div class="product-name">{{ $item->nama }}</div>
                    <div class="product-info">Kategori: {{ $item->kategori ?? '-' }}</div>
                    <div class="product-info">Warna: {{ $item->warna ?? '-' }}</div>
                    <div class="product-info">Saiz: {{ $item->saiz ?? 'S - 2XL' }}</div>
                    <div class="product-price">RM {{ number_format($item->harga ?? 0, 2) }}</div>
                    <div class="product-info mt-2">{{ $item->penerangan ?? '' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
