@extends('layouts.main')

@section('css')
<style>
    /* Tab Navigation Styles */
    .tabs {
        list-style: none;
        padding: 0;
        margin: 0 0 10px;
        display: flex;
    }

    .tab-item {
        padding: 10px 20px;
        cursor: pointer;
        background-color: #eee;
        border: 1px solid #ccc;
        margin-right: 5px;
    }

    .tab-item.active {
        background-color: #b42e8b;
        color: white;
        font-weight: bold;
    }

    /* Tab Content Styles */
    .tab-content {
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #fff;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Default: For mobile devices */
    .containerKt {
        display: grid;
        grid-template-columns: 1fr; /* 1 item per row */
        gap: 10px;
    }

    /* Medium screens (tablets, small desktops) */
    @media (min-width: 600px) {
        .containerKt {
            grid-template-columns: repeat(3, 1fr); /* 3 items per row */
        }
    }

    /* Large screens (desktops, large tablets) */
    @media (min-width: 1024px) {
        .containerKt {
            grid-template-columns: repeat(4, 1fr); /* 4 items per row */
        }
    }

    /* Grid Item Style */
    .containerKt div {
        background-color: #f4f4f4;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
        height: 200px; /* Ensure fixed height for each item */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-grid {
        width: 100%; /* Make the image fill the width of the parent */
        height: 100%; /* Set height to fill the div */
        object-fit: contain; /* Ensure the full image is visible and retains its aspect ratio */
    }

</style>
@endsection

@section('content')
<section class="about_section py-5 px-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Grid Layout</h2>
                <p>A Grid Layout must have a parent element with the <em>display</em> property set to <em>grid</em> or <em>inline-grid</em>.</p>
                <div class="tabs-container">
                    <!-- Tab Navigation -->
                    <ul class="tabs">
                        <li class="tab-item active" data-tab="tab1">Category 1</li>
                        <li class="tab-item" data-tab="tab2">Category 2</li>
                        <li class="tab-item" data-tab="tab3">Category 3</li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <div class="containerKt">
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/ig.png') }}" alt="" class="image-grid"></div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="containerKt">
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/fb.png') }}" alt="" class="image-grid"></div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane">
                            <div class="containerKt">
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                                <div><img src="{{ asset('images/tiktok.png') }}" alt="" class="image-grid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.tab-item').forEach(item => {
        item.addEventListener('click', function () {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-item').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked tab and corresponding pane
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
</script>

@endsection
