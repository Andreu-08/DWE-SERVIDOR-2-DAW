<?php $__env->startSection('content'); ?>

<main class="section">
    <div class="container">
        <h2 class="title is-4">Papelera</h2>
        <table class="table is-fullwidth is-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Owner</th>
                    <th>Deleted at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $ficheros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fichero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($fichero->name); ?></td>
                    <td><?php echo e($fichero->size()); ?>KB</td>
                    <td><?php echo e($fichero->user->name); ?></td>
                    <td><?php echo e($fichero->deleted_at); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('file.restore', $fichero->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="button is-success" type="submit">Restaurar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        
        <?php echo e($ficheros->links()); ?>

    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/partials/archivosEliminados.blade.php ENDPATH**/ ?>