@extends('layouts.main')

@section('css')
<style>
    .h2-custom {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .p-custom {
        text-align: center;
        color: #555;
        font-size: 1rem;
        margin-bottom: 40px;
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        padding: 0 20px;
    }

    .containerKt div {
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        transition: 0.3s ease-in-out;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
    }

    .containerKt div:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .image-grid {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
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
                <div class="tabs-container">
                    <!-- Tab Navigation -->
                    <ul class="tabs">
                        <li class="tab-item active" data-tab="tab1">PAKAIAN HARIAN</li>
                        <li class="tab-item" data-tab="tab2">PAKAIAN RASMI</li>
                        <li class="tab-item" data-tab="tab3">AKSESORI</li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Pakaian Harian -->
                        <div id="tab1" class="tab-pane active">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Pakaian Harian') as $item)
                                <div class="item">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
                                    <p>{{ $item->nama }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pakaian Rasmi -->
                        <div id="tab2" class="tab-pane">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Pakaian Rasmi') as $item)
                                <div class="item">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
                                    <p>{{ $item->nama }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Aksesori -->
                        <div id="tab3" class="tab-pane">
                            <div class="containerKt">
                                @foreach($katalogs->where('kategori', 'Aksesori') as $item)
                                <div class="item">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="image-grid">
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
            // Remove active class
            document.querySelectorAll('.tab-item').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked tab
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
</script>
@endsection
