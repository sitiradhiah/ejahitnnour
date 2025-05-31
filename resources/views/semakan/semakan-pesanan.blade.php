@extends('layouts.main')

@section('content')
<div class="order-check-section">
    <h2>Semakan Pesanan Anda</h2>

    <!-- Form untuk mencari status tempahan -->
    <form id="order-check-form">
        <input type="text" id="query" placeholder="Masukkan nama atau no telefon" name="query" required>
        <button type="button" id="search-btn"><i class="fa fa-search"></i> Cari</button>
    </form>

    <!-- Paparan status tempahan -->
    <div id="status-section" class="mt-4">
        @include('semakan.statusawam-pesanan', ['tempahan' => $tempahan])
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $('#search-btn').on('click', function() {
          var query = $('#query').val();

          if(query.trim() !== '') {
              $.ajax({
                  url: '{{ route("semakan-pesanan") }}',
                  method: 'GET',
                  data: { query: query },
                  success: function(response) {
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
  });
</script>
@endsection
