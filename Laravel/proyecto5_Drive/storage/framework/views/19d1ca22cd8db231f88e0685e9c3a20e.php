<?php $__env->startSection('content'); ?>

<main class="section">
    <div class="container">
        <!-- Botones para alternar entre archivos privados, públicos y todos -->
        <div class="buttons">
            <button class="button is-primary" id="showPrivateFiles">Archivos Privados</button>
            <button class="button is-link" id="showPublicFiles">Archivos Públicos</button>
            <button class="button is-info" id="showAllFiles">Todos los archivos</button>
            <button class="button is-success" id="showSharedFiles">Compartidos</button>
            <a class="button is-warning" href="<?php echo e(route('file.trash')); ?>">Papelera</a>
        </div>

        <!-- Contenedor para archivos privados, públicos, todos y compartidos -->
        <div id="privateFiles" style="display: none;">
            <?php echo $__env->make('archivosPrivPublic', ['ficheros' => $ficherosPrivados], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div id="publicFiles" style="display: none;">
            <?php echo $__env->make('archivosPrivPublic', ['ficheros' => $ficherosPublicos], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div id="allFiles">
            <?php echo $__env->make('archivosPrivPublic', ['ficheros' => $ficherosTodos], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div id="sharedFiles" style="display: none;">
            <?php echo $__env->make('archivosPrivPublic', ['ficheros' => $ficherosCompartidos], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <!-- Formulario para subir archivos -->
    <div class="box">
        <form action="<?php echo e(route('file.upload')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="field">
                <label class="label">Subir Archivo</label>
                <div class="control">
                    <input class="input" type="file" name="uploaded_file" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Visibilidad</label>
                <div class="control">
                    <div class="select">
                        <select name="visibility" required>
                            <option value="public">Público</option>
                            <option value="private">Privado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Subir</button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const showPrivateFilesButton = document.getElementById('showPrivateFiles');
        const showPublicFilesButton = document.getElementById('showPublicFiles');
        const showAllFilesButton = document.getElementById('showAllFiles');
        const showSharedFilesButton = document.getElementById('showSharedFiles');
        const privateFilesContainer = document.getElementById('privateFiles');
        const publicFilesContainer = document.getElementById('publicFiles');
        const allFilesContainer = document.getElementById('allFiles');
        const sharedFilesContainer = document.getElementById('sharedFiles');

        showPrivateFilesButton.addEventListener('click', () => {
            privateFilesContainer.style.display = 'block';
            publicFilesContainer.style.display = 'none';
            allFilesContainer.style.display = 'none';
            sharedFilesContainer.style.display = 'none';
        });

        showPublicFilesButton.addEventListener('click', () => {
            privateFilesContainer.style.display = 'none';
            publicFilesContainer.style.display = 'block';
            allFilesContainer.style.display = 'none';
            sharedFilesContainer.style.display = 'none';
        });

        showAllFilesButton.addEventListener('click', () => {
            privateFilesContainer.style.display = 'none';
            publicFilesContainer.style.display = 'none';
            allFilesContainer.style.display = 'block';
            sharedFilesContainer.style.display = 'none';
        });

        showSharedFilesButton.addEventListener('click', () => {
            privateFilesContainer.style.display = 'none';
            publicFilesContainer.style.display = 'none';
            allFilesContainer.style.display = 'none';
            sharedFilesContainer.style.display = 'block';
        });
    });

    function confirmarBorrado() {
        return confirm('¿Estás seguro de que deseas borrar este archivo?');
    }

    function compartirFichero(fileId) {
        const email = prompt('Introduce el email del usuario con el que deseas compartir el fichero:');
        if (email) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/share/${fileId}`;
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '<?php echo e(csrf_token()); ?>';
            form.appendChild(csrfInput);

            const emailInput = document.createElement('input');
            emailInput.type = 'hidden';
            emailInput.name = 'email';
            emailInput.value = email;
            form.appendChild(emailInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>