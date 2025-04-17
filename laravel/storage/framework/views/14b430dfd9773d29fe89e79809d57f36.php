

<?php $__env->startSection('content'); ?>
    <h1>Editar Producto</h1>

    <?php if($errors->any()): ?>
        <div>
            <strong>¡Oops!</strong> Hay algunos errores:<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('productos.update', $producto)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo e($producto->nombre); ?>" required><br><br>

        <label>Descripción:</label>
        <textarea name="descripcion"><?php echo e($producto->descripcion); ?></textarea><br><br>

        <label>Precio:</label>
        <input type="text" name="precio" value="<?php echo e($producto->precio); ?>" required><br><br>

        <label>Stock:</label>
        <input type="number" name="stock" value="<?php echo e($producto->stock); ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?php echo e(route('productos.index')); ?>">Volver a la lista</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyectoweb\proyectoweb\laravel\resources\views/productos/edit.blade.php ENDPATH**/ ?>