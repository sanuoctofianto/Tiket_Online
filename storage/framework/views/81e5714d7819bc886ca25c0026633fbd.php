

<?php $__env->startSection('content'); ?>
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="<?php echo e(route('user.store')); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?> 
                        <div class="card-body">
                            <h4 class="card-title"><?php echo e($judul ?? 'Tambah User Baru'); ?></h4>

                            <?php echo $__env->make('backend.v_user.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?php echo e(route('user.index')); ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_user/create.blade.php ENDPATH**/ ?>