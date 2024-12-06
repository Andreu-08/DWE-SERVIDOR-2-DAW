<script>
    //confirmacion antes de borrar un archivo
    function confirmarBorrado(){
        return confirm('¿Estás seguro de que quieres borrar este archivo?');
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Función para cerrar notificaciones
        const deleteButtons = document.querySelectorAll('.notification .delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.parentNode.remove(); // Cierra la notificación al hacer clic en el botón de cierre
            });
        });
    });
    

    //funcion apra mostrar el nombre del archivo seleccionado
    function mostrarNombreArchivo() {
        const fileInput = document.getElementById('uploadedFileInput');
        const fileNameLabel = document.getElementById('fileNameLabel');

        if (fileInput.files.length > 0) {
            fileNameLabel.textContent = fileInput.files[0].name;
        }
    }
</script><?php /**PATH /var/www/html/resources/views/partials/scripts.blade.php ENDPATH**/ ?>