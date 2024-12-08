<?php $__env->startSection('content'); ?>
    
    <section class="section">
        <div class="container">
            <h1 class="title">Panel de Administración</h1>
            <p>Bienvenido, administrador. Aquí puedes gestionar los recursos del sistema.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Archivo</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($action->user->name); ?></td>
                            <td><?php echo e($action->action); ?></td>
                            <td><?php echo e($action->file ? $action->file->name : 'NA'); ?></td>
                            <td><?php echo e($action->created_at); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>