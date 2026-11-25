

<?php $__env->startSection('content'); ?>
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e($judul ?? 'Detail Pemesanan'); ?></h4>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Kode Pemesanan:</strong> <?php echo e($pemesanan->kode_pemesanan); ?></p>
                                <p><strong>Tanggal Pemesanan:</strong>
                                    <?php echo e(\Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i')); ?></p>
                                <p><strong>User Pemesan:</strong> <?php echo e($pemesanan->user->nama ?? 'N/A'); ?>

                                    (<?php echo e($pemesanan->user->email ?? 'N/A'); ?>)</p>
                                <p><strong>Konser:</strong> <?php echo e($pemesanan->konser->nama_konser ?? 'N/A'); ?></p>
                                <p><strong>Artis:</strong> <?php echo e($pemesanan->konser->artis ?? 'N/A'); ?></p>
                                <p><strong>Lokasi Konser:</strong> <?php echo e($pemesanan->konser->lokasi ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Jumlah Tiket:</strong> <?php echo e($pemesanan->jumlah_tiket); ?></p>
                                <p><strong>Harga Per Tiket:</strong> Rp
                                    <?php echo e(number_format($pemesanan->konser->harga ?? 0, 2, ',', '.')); ?></p>
                                <p><strong>Total Harga:</strong> Rp
                                    <?php echo e(number_format($pemesanan->total_harga, 2, ',', '.')); ?></p>
                                <p><strong>Status Pembayaran:</strong>
                                    <span
                                        class="badge <?php echo e($pemesanan->status_pembayaran == 'paid'
                                            ? 'bg-success'
                                            : ($pemesanan->status_pembayaran == 'pending'
                                                ? 'bg-warning'
                                                : ($pemesanan->status_pembayaran == 'failed'
                                                    ? 'bg-danger'
                                                    : 'bg-secondary'))); ?>">
                                        <?php echo e(ucfirst($pemesanan->status_pembayaran)); ?>

                                    </span>
                                </p>
                                <p><strong>Status Pemesanan:</strong>
                                    <span
                                        class="badge <?php echo e($pemesanan->status_pemesanan == 'confirmed'
                                            ? 'bg-info'
                                            : ($pemesanan->status_pemesanan == 'pending'
                                                ? 'bg-secondary'
                                                : ($pemesanan->status_pemesanan == 'cancelled'
                                                    ? 'bg-danger'
                                                    : 'bg-primary'))); ?>">
                                        <?php echo e(ucfirst($pemesanan->status_pemesanan)); ?>

                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo e(route('pemesanan.index')); ?>" class="btn btn-secondary">Kembali ke Daftar
                                Pemesanan</a>
                            <a href="<?php echo e(route('pemesanan.print', $pemesanan->id)); ?>" target="_blank"
                                class="btn btn-info">Cetak Tiket / Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_pemesanan/show.blade.php ENDPATH**/ ?>