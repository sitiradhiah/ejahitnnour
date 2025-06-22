<div class="scroll-wrapper" style="overflow-x: auto;">
    <div class="scroll-sync scroll-sync-top"></div>

    <div class="scroll-sync scroll-sync-bottom">
        <div style="min-width: 1000px">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
    .scroll-wrapper {
        width: 100%;
    }

    .scroll-wrapper .table th,
    .scroll-wrapper .table td {
        white-space: normal; /* Benarkan pecahan baris */
        word-wrap: break-word; /* Pecahkan perkataan panjang */
        vertical-align: middle; /* Tengahkan vertikal */
    }

    .scroll-wrapper .table {
        table-layout: auto; /* Biar kandungan tentukan lebar */
        width: 100%;
    }

    .wrap-cell {
        word-break: break-word;     /* Pecahkan bila perlu */
        white-space: normal;        /* Benarkan baris baru */
    }

</style>
