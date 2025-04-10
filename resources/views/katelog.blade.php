@extends('layouts.main')

@section('css')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .h2-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .p-custom {
        text-align: center;
        color: #555;
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .tabs {
        list-style: none;
        padding: 0;
        margin: 0 auto 30px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .tab-item {
        padding: 12px 25px;
        cursor: pointer;
        background-color: #eee;
        border: 1px solid #ddd;
        border-radius: 30px;
        transition: 0.3s ease-in-out;
        font-weight: 500;
    }

    .tab-item.active {
        background-color: #b42e8b;
        color: white;
        font-weight: bold;
        border-color: #b42e8b;
    }

    .tab-item:hover {
        background-color: #ddd;
    }

    .tab-content {
        border: none;
        padding: 0;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    .containerKt {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        padding: 0 20px;
    }

    .item {
        background-color: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease-in-out;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .item p {
        margin-top: 10px;
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    .image-grid {
        border-radius: 12px;
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .filter-container {
        max-width: 500px;
        margin: 0 auto 20px;
    }
</style>
@endsection

@section('content')
<section class="about_section py-5 px-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h2-custom">KATALOG PRODUK DAN PERKHIDMATAN</h2>
                <p class="p-custom">Bahagian ini memaparkan katalog produk dan perkhidmatan yang ditawarkan oleh Kedai Jahit N'NOUR.</p>

                <div class="filter-container">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama produk...">
                    <select id="categoryFilter" class="form-select mt-2">
                        <option value="all">Semua Kategori</option>
                        <option value="tab1">Pakaian Harian</option>
                        <option value="tab2">Pakaian Rasmi</option>
                        <option value="tab3">Aksesori</option>
                    </select>
                </div>

                <div class="tabs-container">
                    <ul class="tabs">
                        <li class="tab-item active" data-tab="tab1">PAKAIAN HARIAN</li>
                        <li class="tab-item" data-tab="tab2">PAKAIAN RASMI</li>
                        <li class="tab-item" data-tab="tab3">AKSESORI</li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Pakaian Harian') as $item)
                                <div class="item">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
                                    <p>{{ $item->nama }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="tab2" class="tab-pane">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Pakaian Rasmi') as $item)
                                <div class="item">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
                                    <p>{{ $item->nama }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="tab3" class="tab-pane">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Aksesori') as $item)
                                <div class="item">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
                                    <p>{{ $item->nama }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Tab Navigation
    document.querySelectorAll('.tab-item').forEach(item => {
        item.addEventListener('click', function () {
            document.querySelectorAll('.tab-item').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Filter Produk
    function filterProducts() {
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('categoryFilter').value;

        document.querySelectorAll('.tab-pane').forEach(pane => {
            const isActive = category === 'all' || pane.id === category;
            pane.style.display = isActive ? 'block' : 'none';
        });

        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.querySelectorAll('.item').forEach(item => {
                const name = item.querySelector('p').textContent.toLowerCase();
                item.style.display = name.includes(searchVal) ? 'flex' : 'none';
            });
        });
    }

    document.getElementById('searchInput').addEventListener('input', filterProducts);
    document.getElementById('categoryFilter').addEventListener('change', filterProducts);
</script>
@endsection
