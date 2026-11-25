    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="user_id" class="form-label">User Pemesan</label>
                <select name="user_id" id="user_id" class="form-control <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">-- Pilih User --</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"
                            <?php echo e(old('user_id', $pemesanan->user_id ?? '') == $user->id ? 'selected' : ''); ?>>
                            <?php echo e($user->nama); ?> (<?php echo e($user->email); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="konser_id" class="form-label">Konser</label>
                <select name="konser_id" id="konser_id" class="form-control <?php $__errorArgs = ['konser_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    required>
                    <option value="">-- Pilih Konser --</option>
                    <?php $__currentLoopData = $konserList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $konserItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($konserItem->id); ?>" data-harga="<?php echo e($konserItem->harga); ?>"
                            <?php echo e(old('konser_id', $pemesanan->konser_id ?? '') == $konserItem->id ? 'selected' : ''); ?>>
                            <?php echo e($konserItem->nama_konser); ?> - <?php echo e($konserItem->artis); ?> (Rp
                            <?php echo e(number_format($konserItem->harga, 0, ',', '.')); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['konser_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" id="jumlah_tiket"
                    class="form-control <?php $__errorArgs = ['jumlah_tiket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('jumlah_tiket', $pemesanan->jumlah_tiket ?? '')); ?>" min="1" required>
                <?php $__errorArgs = ['jumlah_tiket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" name="total_harga" id="total_harga"
                    class="form-control <?php $__errorArgs = ['total_harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('total_harga', number_format($pemesanan->total_harga ?? 0, 2, ',', '.'))); ?>"
                    readonly>
                <?php $__errorArgs = ['total_harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="kode_pemesanan" class="form-label">Kode Pemesanan</label>
                <input type="text" name="kode_pemesanan" id="kode_pemesanan"
                    class="form-control <?php $__errorArgs = ['kode_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('kode_pemesanan', $pemesanan->kode_pemesanan ?? '')); ?>"
                    placeholder="Kode akan digenerate otomatis" readonly>
                <?php $__errorArgs = ['kode_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran"
                    class="form-control <?php $__errorArgs = ['status_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="pending"
                        <?php echo e(old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'pending' ? 'selected' : ''); ?>>
                        Pending</option>
                    <option value="paid"
                        <?php echo e(old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'paid' ? 'selected' : ''); ?>>
                        Paid</option>
                    <option value="failed"
                        <?php echo e(old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'failed' ? 'selected' : ''); ?>>
                        Failed</option>
                    <option value="refunded"
                        <?php echo e(old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'refunded' ? 'selected' : ''); ?>>
                        Refunded</option>
                </select>
                <?php $__errorArgs = ['status_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status_pemesanan" class="form-label">Status Pemesanan</label>
                <select name="status_pemesanan" id="status_pemesanan"
                    class="form-control <?php $__errorArgs = ['status_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="pending"
                        <?php echo e(old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'pending' ? 'selected' : ''); ?>>
                        Pending</option>
                    <option value="confirmed"
                        <?php echo e(old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'confirmed' ? 'selected' : ''); ?>>
                        Confirmed</option>
                    <option value="cancelled"
                        <?php echo e(old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'cancelled' ? 'selected' : ''); ?>>
                        Cancelled</option>
                    <option value="completed"
                        <?php echo e(old('status_pemesanan', $pemesanan->status_pemesanan ?? '') == 'completed' ? 'selected' : ''); ?>>
                        Completed</option>
                </select>
                <?php $__errorArgs = ['status_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                <input type="datetime-local" name="tanggal_pemesanan" id="tanggal_pemesanan"
                    class="form-control <?php $__errorArgs = ['tanggal_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('tanggal_pemesanan', isset($pemesanan->tanggal_pemesanan) ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('Y-m-d\TH:i') : '')); ?>">
                <?php $__errorArgs = ['tanggal_pemesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Pongo\Downloads\Compressed\TiketOnline\TiketOnline - Copy - Copy\resources\views/backend/v_pemesanan/form.blade.php ENDPATH**/ ?>