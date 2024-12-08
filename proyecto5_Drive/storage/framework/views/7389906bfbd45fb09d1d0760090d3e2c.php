
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH /var/www/html/resources/views/layout.blade.php ENDPATH**/ ?>