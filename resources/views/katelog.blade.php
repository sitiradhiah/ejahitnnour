@extends('layouts.main')

@section('css')
<style>
    /* General Styles */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
    }

    h2 {
        text-align: center;
        color: #b42e8b;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    p {
        text-align: center;
        color: #555;
        font-size: 1rem;
        margin-bottom: 40px;
    }

    /* Tabs Navigation */
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

    /* Tab Content */
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

    /* Portrait Grid Styling */
    .containerKt {
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr; /* Default to single column for portrait */
        padding: 0 20px;
        max-height: 600px; /* Set maximum height */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    @media (min-width: 768px) {
        .containerKt {
            grid-template-columns: repeat(2, 1fr); /* Tablet */
        }
    }

    @media (min-width: 1024px) {
        .containerKt {
            grid-template-columns: repeat(3, 1fr); /* Desktop */
        }
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
        height: 300px; /* Adjust height for portrait layout */
    }

    .containerKt div:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .image-grid {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover; /* Ensures images fit within the div */
    }

    /* Scrollbar Customization (Optional) */
    .containerKt::-webkit-scrollbar {
        width: 6px;
    }

    .containerKt::-webkit-scrollbar-thumb {
        background: #b42e8b;
        border-radius: 5px;
    }

    .containerKt::-webkit-scrollbar-thumb:hover {
        background: #9e2676;
    }
</style>
@endsection

@section('content')
<section class="about_section py-5 px-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>KATALOG PRODUK DAN PERKHIDMATAN</h2>
                <p>Bahagian ini memaparkan katalog produk dan perkhidmatan yang ditawarkan oleh Kedai Jahit N'NOUR.</p>
                <div class="tabs-container">
                    <!-- Tab Navigation -->
                    <ul class="tabs">
                        <li class="tab-item active" data-tab="tab1">PAKAIAN HARIAN</li>
                        <li class="tab-item" data-tab="tab2">PAKAIAN RASMI</li>
                        <li class="tab-item" data-tab="tab3">AKSESORI</li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <div class="containerKt">
                                <div class="item"><img src="{{ asset('images/kemejabiru.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/kemejamerah.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/bajukurungmoden.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/bajukurungkedah1.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/kemejahitam.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/ig.png') }}" alt="Pakaian Harian" class="image-grid"></div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="containerKt">
                                <div class="item"><img src="{{ asset('images/bajulayang.png') }}" alt="Pakaian Rasmi" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/fb.png') }}" alt="Pakaian Rasmi" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/fb.png') }}" alt="Pakaian Rasmi" class="image-grid"></div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane">
                            <div class="containerKt">
                                <div class="item"><img src="{{ asset('images/tanjak1.png') }}" alt="Aksesori" class="image-grid"></div>
                                <div class="item"><img src="{{ asset('images/tiktok.png') }}" alt="Aksesori" class="image-grid"></div>
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
