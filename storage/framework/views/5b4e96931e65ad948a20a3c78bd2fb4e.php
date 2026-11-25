

<?php $__env->startSection('content'); ?>
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e($judul ?? 'Data User'); ?></h4>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-end mb-3">
                            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
                        </div>

                        <?php if($index->isEmpty()): ?>
                            
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada data user. Silakan tambah user baru!
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle" id="myTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>HP</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td>
                                                    <?php if($user->foto): ?>
                                                        
                                                        <img src="<?php echo e(asset('storage/img-user/' . $user->foto)); ?>"
                                                            alt="Foto Profil" class="img-thumbnail"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                    <?php else: ?>
                                                        <img src="https://placehold.co/50x50/cccccc/ffffff?text=No+Photo"
                                                            alt="No Photo" class="img-thumbnail"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($user->nama); ?></td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td><?php echo e($user->hp ?? '-'); ?></td>
                                                <td><?php echo e($user->role == '1' ? 'Admin' : 'User Biasa'); ?></td>
                                                <td>
                                                    <span
                                                        class="badge <?php echo e($user->status == '1' ? 'bg-success' : 'bg-danger'); ?>">
                                                        <?php echo e($user->status == '1' ? 'Aktif' : 'Tidak Aktif'); ?>

                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="<?php echo e(route('user.show', $user->id)); ?>"
                                                        class="btn btn-info btn-sm me-1">
                                                        Detail
                                                    </a>
                                                    <a href="<?php echo e(route('user.edit', $user->id)); ?>"
                                                        class="btn btn-warning btn-sm me-1">
                                                        Edit
                                                    </a>
                                                    <form action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST"
                                                        style="display:inline-block;" class="delete-form">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Hapus
                                                        </button>
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Pongo\Downloads\Compressed\TiketOnline\TiketOnline - Copy - Copy\resources\views/backend/v_user/index.blade.php ENDPATH**/ ?>