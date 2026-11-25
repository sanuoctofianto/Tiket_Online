    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="user_id" class="form-label">User Pemesan</label>
                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                    <option value="">-- Pilih User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $pemesanan->user_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="konser_id" class="form-label">Konser</label>
                <select name="konser_id" id="konser_id" class="form-control @error('konser_id') is-invalid @enderror"
                    required>
                    <option value="">-- Pilih Konser --</option>
                    @foreach ($konserList as $konserItem)
                        <option value="{{ $konserItem->id }}" data-harga="{{ $konserItem->harga }}"
                            {{ old('konser_id', $pemesanan->konser_id ?? '') == $konserItem->id ? 'selected' : '' }}>
                            {{ $konserItem->nama_konser }} - {{ $konserItem->artis }} (Rp
                            {{ number_format($konserItem->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('konser_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" id="jumlah_tiket"
                    class="form-control @error('jumlah_tiket') is-invalid @enderror"
                    value="{{ old('jumlah_tiket', $pemesanan->jumlah_tiket ?? '') }}" min="1" required>
                @error('jumlah_tiket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" name="total_harga" id="total_harga"
                    class="form-control @error('total_harga') is-invalid @enderror"
                    value="{{ old('total_harga', number_format($pemesanan->total_harga ?? 0, 2, ',', '.')) }}"
                    readonly>
                @error('total_harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="kode_pemesanan" class="form-label">Kode Pemesanan</label>
                <input type="text" name="kode_pemesanan" id="kode_pemesanan"
                    class="form-control @error('kode_pemesanan') is-invalid @enderror"
                    value="{{ old('kode_pemesanan', $pemesanan->kode_pemesanan ?? '') }}"
                    placeholder="Kode akan digenerate otomatis" readonly>
                @error('kode_pemesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran"
                    class="form-control @error('status_pembayaran') is-invalid @enderror" required>
                    <option value="pending"
                        {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'pending' ? 'selected' : '' }}>
                        Pending</option>
                    <option value="paid"
                        {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'paid' ? 'selected' : '' }}>
                        Paid</option>
                    <option value="failed"
                        {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'failed' ? 'selected' : '' }}>
                        Failed</option>
                    <option value="refunded"
                        {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'refunded' ? 'selected' : '' }}>
                        Refunded</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status_pemesanan" class="form-label">Status Pemesanan</label>
                <select name="status_pemesanan" id="status_pemesanan"
                    class="form-control @error('status_pemesanan') is-invalid @enderror" required>
                    <option value="pending"
                        {{ old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'pending' ? 'selected' : '' }}>
                        Pending</option>
                    <option value="confirmed"
                        {{ old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'confirmed' ? 'selected' : '' }}>
                        Confirmed</option>
                    <option value="cancelled"
                        {{ old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'cancelled' ? 'selected' : '' }}>
                        Cancelled</option>
                    <option value="completed"
                        {{ old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'completed' ? 'selected' : '' }}>
                        Completed</option>
                </select>
                @error('status_pemesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                <input type="datetime-local" name="tanggal_pemesanan" id="tanggal_pemesanan"
                    class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                    value="{{ old('tanggal_pemesanan', isset($pemesanan->tanggal_pemesanan) ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('Y-m-d\TH:i') : '') }}">
                @error('tanggal_pemesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const konserSelect = document.getElementById('konser_id');
                const jumlahTiketInput = document.getElementById('jumlah_tiket');
                const totalHargaInput = document.getElementById('total_harga');

                function calculateTotalPrice() {
                    const selectedOption = konserSelect.options[konserSelect.selectedIndex];
                    const hargaPerTiket = parseFloat(selectedOption.dataset.harga || 0);
                    const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;

                    const totalHarga = hargaPerTiket * jumlahTiket;
                    totalHargaInput.value = totalHarga.toLocaleString('id-ID', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }

                konserSelect.addEventListener('change', calculateTotalPrice);
                jumlahTiketInput.addEventListener('input', calculateTotalPrice);

                // Panggil saat halaman dimuat untuk mengisi nilai awal jika ada
                calculateTotalPrice();
            });
        </script>
    @endpush
