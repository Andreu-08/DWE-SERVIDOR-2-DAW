<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="container">
        <h1 class="title is-1">Vista Previa del Archivo</h1>
        <p><strong>Nombre del Archivo:</strong> <?php echo e($file->name); ?></p>
        <p><strong>Tamaño:</strong> <?php echo e($fileSize); ?> KB</p>
        <p><strong>Tipo:</strong> <?php echo e($fileType); ?></p>
        <p><strong>Visibilidad:</strong> <?php echo e($file->visibility); ?></p>
        <p><strong>Propietario:</strong> <?php echo e($file->user->name); ?></p>
        <p><strong>Fecha de Creación:</strong> <?php echo e($file->created_at); ?></p>
        <p><strong>Última Actualización:</strong> <?php echo e($file->updated_at); ?></p>
        <hr>
        <a href="<?php echo e(url('/')); ?>" class="button is-primary is-inverted">Volver a la lista de archivos</a>
        <a href="<?php echo e(url("/download/{$file->id}")); ?>" class="button is-primary">Descargar Archivo</a>
        <hr>

        <!-- Mostrar vista previa según el tipo de archivo -->
        <section class="section">
            <div class="container">
                <?php if(in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                    <!-- Vista previa de imagen -->
                    <figure class="image is-4by3">
                        <img src="<?php echo e(route('file.content', ['file' => $file->id])); ?>" alt="Vista previa de <?php echo e($file->name); ?>">
                    </figure>
                <?php elseif(in_array($fileType, ['pdf'])): ?>
                    <!-- Vista previa de PDF -->
                    <iframe src="<?php echo e(route('file.content', ['file' => $file->id])); ?>" width="100%" height="600px"></iframe>
                <?php elseif(in_array($fileType, ['txt', 'csv', 'log', 'html','md', 'php', 'js', 'json', 'xml', 'yml', 'yaml', 'env'])): ?>
                    <!-- Vista previa de texto -->
                    <div class="box">
                        <pre><?php echo e(file_get_contents(storage_path('app/private/' . $file->path))); ?></pre>
                    </div>
                <?php else: ?>
                    <!-- Archivo no compatible -->
                    <p>Este tipo de archivo no tiene vista previa disponible.</p>
                <?php endif; ?>
            </div>
        </section>
        
    </div>
</section>
<hr>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comment', $file)): ?>
<section class="section">
    
    <form method="POST" action="/comment/<?php echo e($file->id); ?>">
        <?php echo csrf_field(); ?>
        <div class="field">
            <label class="label">Escribe tu comentario</label>
            <div class="control">
                <textarea name="content" class="textarea" required></textarea>
            </div>
        </div>
        <div class="control">
            <button type="submit" class="button is-primary">Agregar comentario</button>
        </div>
    </form>
</section>
<?php endif; ?>

<!-- Mensajes de error o confirmación -->
<?php if(session('success')): ?>
    <div class="notification is-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="notification is-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<!-- Lista de comentarios -->
<div class="section">
    <h2 class="title is-4">Comentarios</h2>

    <?php if($comments->count()): ?>
        <ul>
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php echo $__env->make('partials.comment', ['comment' => $comment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                    <!-- Contenedor para el formulario de respuesta -->
                    <div class="reply-form-container" id="reply-form"></div>
                </li>
                <hr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <!-- Paginación -->
        <?php for($i = 1; $i <= $comments->lastPage(); $i++): ?>
            <a href="?page=<?php echo e($i); ?>"><?php echo e($i); ?></a>
        <?php endfor; ?>
    <?php else: ?>
        <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
    <?php endif; ?>
</div>

<!-- Script de JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar todos los botones de respuesta
        const replyButtons = document.querySelectorAll('.reply-button');

        replyButtons.forEach(button => {
            button.addEventListener('click', function () {
                
                const commentId = button.getAttribute('data-comment-id');
                console.log("fdsdfssd", commentId);
                const commentAuthor = button.getAttribute('data-comment-author');
                const formContainer = document.querySelector(`#reply-form`);

                // Crear el formulario dinámico
                const formHtml = `
                    <form method="POST" action="/comment/${commentId}/reply" class="box">
                        <?php echo csrf_field(); ?>
                        <p><strong>Respondiendo a ${commentAuthor}</strong></p>
                        <div class="field">
                            <label class="label">Tu respuesta</label>
                            <div class="control">
                                <textarea name="content" class="textarea" required></textarea>
                            </div>
                        </div>
                        <div class="control">
                            <button type="submit" class="button is-success">Enviar respuesta</button>
                        </div>
                    </form>
                `;

                // Insertar el formulario en el contenedor correspondiente
                console.log(formContainer);
                formContainer.innerHTML = formHtml;
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/file_preview.blade.php ENDPATH**/ ?>