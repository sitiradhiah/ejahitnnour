@extends('layouts.admin-main')

@section('content')
<div class="order-check-section">
    <h2>Senarai Tempahan (Admin)</h2>

    <!-- Paparan status tempahan -->
    @include('admin.tempahan.status-pesanan', ['tempahan' => $tempahan])
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $(document).on('change', '.status-dropdown', function() {
          var status = $(this).val();
          var tempahanId = $(this).data('tempahan-id');

          $.ajax({
              url: '{{ route("tempahan.update.status", ":id") }}'.replace(':id', tempahanId),
              method: 'PATCH',
              data: { status: status, _token: '{{ csrf_token() }}' },
              success: function(response) {
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
