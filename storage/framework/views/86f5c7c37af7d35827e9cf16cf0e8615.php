

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($judul); ?></h3>
            <div class="card-tools">
                <a href="<?php echo e(route('konser.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poster</th>
                        <th>Nama Konser</th>
                        <th>Artis</th>
                        <th>Kategori</th>
                        <th>Waktu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $konser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <img src="<?php echo e(asset('storage/poster-konser/' . $row->poster)); ?>" alt="Poster"
                                    width="100">
                            </td>
                            <td><?php echo e($row->nama_konser); ?></td>
                            <td><?php echo e($row->artis); ?></td>
                            <td><?php echo e($row->kategori->nama_kategori); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($row->waktu)->format('d M Y, H:i')); ?></td>
                            <td>Rp <?php echo e(number_format($row->harga, 0, ',', '.')); ?></td>
                            <td><?php echo e($row->stok_tiket); ?></td>
                            <td>
                                <a href="<?php echo e(route('konser.edit', $row->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('konser.destroy', $row->id)); ?>" method="POST"
                                    class="d-inline delete-form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_konser/index.blade.php ENDPATH**/ ?>