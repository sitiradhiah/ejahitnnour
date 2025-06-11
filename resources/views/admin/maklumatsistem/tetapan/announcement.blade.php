 <div class="card shadow p-3">

        <p>Anda boleh mengemaskini mesej pengumuman yang akan dipaparkan kepada pengguna di laman utama.</p>

        <form method="POST" action="{{ route('tetapan.announcement.update') }}">
            @csrf
            <input type="hidden" name="active_tab" value="announcement">

            <div class="form-group">
                <label class="mb-3">Mesej Pengumuman </label>
                <textarea name="message" class="form-control" rows="4" style="width:100%;">{{ old('message', $announcement->message ?? '') }}</textarea>
            </div>

            <div class="form-check my-2">
                <input type="checkbox" name="is_active" class="form-check-input" id="activeCheck" {{ isset($announcement) && $announcement->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="activeCheck">Paparkan Pengumuman ?</label>
            </div>

            <button type="submit" class="btn btn-primary mt-1 mb-2">Kemaskini</button>
        </form>
 </div>
