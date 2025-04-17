

<?php $__env->startSection('content'); ?>
    <h1>Crear Producto</h1>

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

    <form action="<?php echo e(route('productos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label>
        <textarea name="descripcion"></textarea><br><br>

        <label>Precio:</label>
        <input type="text" name="precio" required><br><br>

        <label>Stock:</label>
        <input type="number" name="stock" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?php echo e(route('productos.index')); ?>">Volver a la lista</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyectoweb\proyectoweb\laravel\resources\views/productos/create.blade.php ENDPATH**/ ?>