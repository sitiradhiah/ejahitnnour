 <div class="card shadow p-3">

        <p>Ini adalah ruang maklumat tetapan email bagi fungsi notifikasi</p>

        <form method="POST" action="{{ route('tetapan.email.update') }}">
        @csrf

        <input type="hidden" name="active_tab" value="email">

        <div class="form-group mb-2">
            <label>MAIL HOST</label>
            <input type="text" name="MAIL_HOST" value="{{ old('MAIL_HOST', $mail_host) }}" class="form-control @error('MAIL_HOST') is-invalid @enderror">
            @error('MAIL_HOST')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label>MAIL PORT</label>
            <input type="text" name="MAIL_PORT" value="{{ old('MAIL_PORT', $mail_port) }}" class="form-control @error('MAIL_PORT') is-invalid @enderror">
            @error('MAIL_PORT')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label>MAIL USERNAME</label>
            <input type="text" name="MAIL_USERNAME" value="{{ old('MAIL_USERNAME', $mail_username) }}" class="form-control @error('MAIL_USERNAME') is-invalid @enderror">
            @error('MAIL_USERNAME')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label>MAIL PASSWORD</label>
            <input type="text" name="MAIL_PASSWORD" value="{{ old('MAIL_PASSWORD', $mail_password) }}" class="form-control @error('MAIL_PASSWORD') is-invalid @enderror">
            @error('MAIL_PASSWORD')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>MAIL ENCRYPTION</label>
            <input type="text" name="MAIL_ENCRYPTION" value="{{ old('MAIL_ENCRYPTION', $mail_encryption) }}" class="form-control @error('MAIL_ENCRYPTION') is-invalid @enderror">
            @error('MAIL_ENCRYPTION')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" name="test_email" value="1" class="btn btn-secondary">
            Uji Hantar Emel
        </button>
    </form>
 </div>
