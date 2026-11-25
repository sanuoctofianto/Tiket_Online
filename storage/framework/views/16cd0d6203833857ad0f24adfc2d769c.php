

<?php $__env->startSection('content'); ?>
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e($judul ?? 'Data Pemesanan'); ?></h4>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        
                        <div class="d-flex justify-content-end mb-3">
                            <a href="<?php echo e(route('pemesanan.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pemesanan
                            </a>
                        </div>

                        <?php if($pemesanan->isEmpty()): ?>
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada data pemesanan.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Pemesanan</th>
                                            <th>User</th>
                                            <th>Konser</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Total Harga</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Pemesanan</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $pemesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($pesan->kode_pemesanan); ?></td>
                                                <td><?php echo e($pesan->user->nama ?? 'User Tidak Ditemukan'); ?></td>
                                                
                                                <td><?php echo e($pesan->konser->nama_konser ?? 'Konser Tidak Ditemukan'); ?></td>
                                                
                                                <td><?php echo e($pesan->jumlah_tiket); ?></td>
                                                <td>Rp <?php echo e(number_format($pesan->total_harga, 2, ',', '.')); ?></td>
                                                <td>
                                                    <span
                                                        class="badge <?php echo e($pesan->status_pembayaran == 'paid'
                                                            ? 'bg-success'
                                                            : ($pesan->status_pembayaran == 'pending'
                                                                ? 'bg-warning'
                                                                : ($pesan->status_pembayaran == 'failed'
                                                                    ? 'bg-danger'
                                                                    : 'bg-secondary'))); ?>">
                                                        <?php echo e(ucfirst($pesan->status_pembayaran)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge <?php echo e($pesan->status_pemesanan == 'confirmed'
                                                            ? 'bg-info'
                                                            : ($pesan->status_pemesanan == 'pending'
                                                                ? 'bg-secondary'
                                                                : ($pesan->status_pemesanan == 'cancelled'
                                                                    ? 'bg-danger'
                                                                    : 'bg-primary'))); ?>">
                                                        <?php echo e(ucfirst($pesan->status_pemesanan)); ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e(\Carbon\Carbon::parse($pesan->tanggal_pemesanan)->format('d M Y H:i')); ?>

                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="<?php echo e(route('pemesanan.show', $pesan->id)); ?>"
                                                        class="btn btn-info btn-sm me-1">
                                                        Detail
                                                    </a>
                                                    <a href="<?php echo e(route('pemesanan.print', $pesan->id)); ?>" target="_blank"
                                                        class="btn btn-secondary btn-sm me-1">
                                                        Cetak
                                                    </a>
                                                    
                                                    <a href="<?php echo e(route('pemesanan.edit', $pesan->id)); ?>"
                                                        class="btn btn-warning btn-sm me-1">Edit</a>
                                                    <form action="<?php echo e(route('pemesanan.destroy', $pesan->id)); ?>"
                                                        method="POST" style="display:inline-block;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Pongo\Downloads\Compressed\TiketOnline\TiketOnline - Copy - Copy\resources\views/backend/v_pemesanan/index.blade.php ENDPATH**/ ?>