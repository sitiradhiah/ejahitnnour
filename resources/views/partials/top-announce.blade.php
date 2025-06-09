<!-- @php
    $announcement = \App\Models\Announcement::first();
@endphp -->

<!-- @if ($announcement && $announcement->is_active)
    <div style="background-color: yellow; color: red; text-align: center; padding: 10px; animation: flash 1s infinite;">
        <strong>{{ $announcement->message }}</strong>
    </div>

    <style>
        @keyframes flash {
            0% { opacity: 1; }
            50% { opacity: 0.2; }
            100% { opacity: 1; }
        }
    </style>
@endif -->

@php
    use App\Models\Announcement;
    $announcement = cache()->remember('announcement', 60, function () {
        return \App\Models\Announcement::first();
    });
@endphp

@if ($announcement && $announcement->is_active)
    <div class="announcement-wrapper">
        <div class="announcement-track">
            <div class="announcement-text">
                {{ $announcement->message }}
            </div>
        </div>
    </div>

    <style>
        .announcement-wrapper {
            position: relative;
            width: 100%;
            height: 30px;
            overflow: hidden;
            background-color:rgba(0, 0, 0, 0.33); /* Light background for visibility */
        }

        .announcement-track {
            position: absolute;
            top: 11%;
            transform: translateY(-50%);
            white-space: nowrap;
            will-change: transform;
            animation: scroll-left 40s linear infinite;
        }

        .announcement-text {
            display: inline-block;
            padding-left: 100vw; /* push start position off screen */
            font-weight: bold;
            color: yellow;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
@endif
