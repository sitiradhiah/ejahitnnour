@extends('layouts.main')

@section('css')
<style>
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.h2-custom {
    text-align: center;
    color: #b42e8b;
    font-size: 2.8rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.p-custom {
    text-align: center;
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 40px;
}

.filter-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 800px;
    margin: 0 auto 20px;
    gap: 20px;
}

.form-control, .form-select {
    width: 100%;
    max-width: 250px;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.filter-container input, .filter-container select {
    font-size: 1rem;
    color: #333;
}

.catalogue-container {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    padding: 0 15px;
}

.product-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.product-card img {
    width: 100%;
    height: 300px;
    object-fit: cover; /* Ensures image maintains aspect ratio */
    transition: transform 0.3s ease-in-out;
}

.product-card:hover img {
    transform: scale(1.05);
}

.product-card p {
    padding: 15px;
    font-size: 1rem;
    font-weight: bold;
    color: #333;
    text-align: center;
}

.tabs {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
}

.tab-item {
    padding: 10px 20px;
    cursor: pointer;
    background-color: #eee;
    border: 1px solid #ddd;
    border-radius: 30px;
    font-weight: 500;
    transition: 0.3s ease-in-out;
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

</style>
@endsection

@section('content')
<section class="catalogue-section py-5">
    <div class="container">
        <h2 class="h2-custom">KATALOG PRODUK DAN PERKHIDMATAN</h2>
        <p class="p-custom">Bahagian ini memaparkan katalog produk dan perkhidmatan yang ditawarkan oleh Kedai Jahit N'NOUR.</p>

        <!-- Filter Section -->
        <div class="filter-container">
            <form action="{{ route('KatalogUmum') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Cari nama produk..." value="{{ request('search') }}">
                <select id="categoryFilter" name="kategori" class="form-select">
                    <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}" {{ request('kategori') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab-item active" data-tab="tab1">PAKAIAN HARIAN</div>
            <div class="tab-item" data-tab="tab2">PAKAIAN RASMI</div>
            <div class="tab-item" data-tab="tab3">AKSESORI</div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <div class="catalogue-container">
                    @foreach($katalogs->where('kategori', 'Pakaian Harian') as $item)
                    <div class="product-card">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                        <p>{{ $item->nama }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div id="tab2" class="tab-pane">
                <div class="catalogue-container">
                    @foreach($katalogs->where('kategori', 'Pakaian Rasmi') as $item)
                    <div class="product-card">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                        <p>{{ $item->nama }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div id="tab3" class="tab-pane">
                <div class="catalogue-container">
                    @foreach($katalogs->where('kategori', 'Aksesori') as $item)
                    <div class="product-card">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                        <p>{{ $item->nama }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

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
            pane.querySelectorAll('.product-card').forEach(item => {
                const name = item.querySelector('p').textContent.toLowerCase();
                item.style.display = name.includes(searchVal) ? 'block' : 'none';
            });
        });
    }

    document.getElementById('searchInput').addEventListener('input', filterProducts);
    document.getElementById('categoryFilter').addEventListener('change', filterProducts);
</script>
@endsection
