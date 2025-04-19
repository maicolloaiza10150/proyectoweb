<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Mi Tienda Laravel'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-wide">

    <!-- Barra de Navegación -->
    <nav class="bg-blue-600 shadow-md px-6 py-4 mb-6 flex justify-between items-center">
        <div>
            <a href="<?php echo e(url('/')); ?>" class="text-2xl font-bold text-white hover:text-gray-200">
                Tienda Laravel
            </a>
        </div>
        <div class="space-x-4">
            <a href="<?php echo e(route('products.index')); ?>" class="text-white hover:text-gray-200">Productos</a>
            <a href="<?php echo e(route('cart.index')); ?>" class="text-white hover:text-gray-200">Carrito</a>
            <a href="<?php echo e(route('cart.checkout')); ?>" class="text-white hover:text-gray-200">Checkout</a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto px-4 py-6 bg-white rounded-lg shadow-md">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Pie de página (opcional) -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; 2025 Tienda Laravel. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\proyectoweb\proyectoweb\laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>