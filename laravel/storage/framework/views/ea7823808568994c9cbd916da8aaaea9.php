

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Lista de Productos</h1>

    <a href="<?php echo e(route('productos.create')); ?>" class="btn btn-primary mb-3">Crear producto</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <ul class="list-group">
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong><?php echo e($producto->nombre); ?></strong> - $<?php echo e($producto->precio); ?>

                </div>
                <div>
                    <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-sm btn-warning">Editar</a>

                    <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyectoweb\proyectoweb\laravel\resources\views/productos/index.blade.php ENDPATH**/ ?>