

<?php $__env->startSection('content'); ?>
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e($judul ?? 'Detail User'); ?></h4>

                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                
                                <?php if($user->foto): ?>
                                    <img src="<?php echo e(asset('storage/img-user/' . $user->foto)); ?>" alt="Foto Profil"
                                        class="img-thumbnail mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                <?php else: ?>
                                    <img src="https://placehold.co/150x150/cccccc/ffffff?text=No+Photo" alt="No Photo"
                                        class="img-thumbnail mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                <?php endif; ?>
                                <h5><?php echo e($user->nama); ?></h5>
                                <p class="text-muted"><?php echo e($user->email); ?></p>
                            </div>
                            <div class="col-md-8">
                                <dl class="row">
                                    <dt class="col-sm-4">Nama Lengkap:</dt>
                                    <dd class="col-sm-8"><?php echo e($user->nama); ?></dd>

                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8"><?php echo e($user->email); ?></dd>

                                    <dt class="col-sm-4">Nomor HP:</dt>
                                    <dd class="col-sm-8"><?php echo e($user->hp ?? '-'); ?></dd>

                                    <dt class="col-sm-4">Hak Akses:</dt>
                                    <dd class="col-sm-8"><?php echo e($user->role == '1' ? 'Admin' : 'User Biasa'); ?></dd>

                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge <?php echo e($user->status == '1' ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e($user->status == '1' ? 'Aktif' : 'Tidak Aktif'); ?>

                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Terdaftar Sejak:</dt>
                                    <dd class="col-sm-8">
                                        <?php echo e(\Carbon\Carbon::parse($user->created_at)->format('d M Y H:i')); ?></dd>
                                </dl>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="<?php echo e(route('user.index')); ?>" class="btn btn-secondary">Kembali ke Daftar User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_user/show.blade.php ENDPATH**/ ?>