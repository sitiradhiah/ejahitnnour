@extends('layouts.admin-main')

@section('content')
<div class="order-check-section">
    <h2>Semakan Pesanan Anda (Dashboard)</h2>

    <!-- Form untuk mencari status tempahan -->
    <form id="order-check-form">
        <input type="text" id="query" placeholder="Masukkan nama atau no telefon" name="query" required>
        <button type="button" id="search-btn"><i class="fa fa-search"></i> Cari</button>
    </form>

    <!-- Paparan status tempahan melalui include -->
    <div id="status-section" class="mt-4">
        @include('admin.tempahan.status-tempahan', ['tempahan' => $tempahan])
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      // Event listener untuk butang Cari
      $('#search-btn').on('click', function() {
          // Ambil nilai input carian
          var query = $('#query').val();
  
          // Pastikan input tidak kosong
          if(query.trim() !== '') {
              // Hantar permintaan AJAX ke route semakan-pesanan dashboard
              $.ajax({
                  url: '{{ route("semakan-pesanan.dashboard") }}', // Route untuk dashboard
                  method: 'GET',
                  data: { query: query },
                  success: function(response) {
                      // Paparkan hasil semakan di bawah form
                      $('#status-section').html(response);
                  },
                  error: function() {
                      alert('Ralat semasa memuatkan semakan.');
                  }
              });
          } else {
              alert('Sila masukkan nama atau nombor telefon.');
          }
      });

      // Event listener untuk perubahan status
      $(document).on('change', '.status-dropdown', function() {
          var status = $(this).val();
          var tempahanId = $(this).data('tempahan-id');

          // Hantar permintaan AJAX untuk mengemaskini status tempahan
          $.ajax({
              url: '{{ route("tempahan.update.status", ":id") }}'.replace(':id', tempahanId),
              method: 'PATCH',
              data: { status: status, _token: '{{ csrf_token() }}' },
              success: function(response) {
                  // Setelah status dikemaskini, kemaskini status yang dipaparkan di halaman
                  $('#status-' + tempahanId).text(response.status);
              },
              error: function() {
                  alert('Ralat semasa mengemaskini status.');
              }
          });
      });
  });
</script>
@endsection
