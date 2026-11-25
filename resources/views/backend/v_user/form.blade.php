    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $edit->nama ?? '') }}"
                    class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama"
                    required autofocus>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $edit->email ?? '') }}"
                    class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="Masukkan Email" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" placeholder="Kosongkan jika tidak ingin mengubah">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                    placeholder="Konfirmasi Password">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="hp" class="form-label">Nomor HP</label>
                <input type="text" name="hp" value="{{ old('hp', $edit->hp ?? '') }}"
                    class="form-control @error('hp') is-invalid @enderror" id="hp"
                    placeholder="Masukkan Nomor HP">
                @error('hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="role" class="form-label">Hak Akses</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="1" {{ old('role', $edit->role ?? '') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="0" {{ old('role', $edit->role ?? '') == '0' ? 'selected' : '' }}>User Biasa
                    </option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                    required>
                    <option value="1" {{ old('status', $edit->status ?? '') == '1' ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="0" {{ old('status', $edit->status ?? '') == '0' ? 'selected' : '' }}>Tidak
                        Aktif
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="foto" class="form-label">Foto Profil</label>
                <input type="file" name="foto" id="foto"
                    class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($edit->foto) && $edit->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/img-user/' . $edit->foto) }}" alt="Foto Profil Saat Ini"
                            class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        <small class="text-muted d-block">Foto profil saat ini.</small>
                    </div>
                @elseif(isset($edit) && !$edit->foto)
                    <div class="mt-2">
                        <img src="https://placehold.co/150x150/cccccc/ffffff?text=No+Photo" alt="No Photo"
                            class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        <small class="text-muted d-block">Tidak ada foto profil saat ini.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
