@extends('layout')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="title is-1">Vista Previa del Archivo</h1>
        <p><strong>Nombre del Archivo:</strong> {{ $file->name }}</p>
        <p><strong>Tamaño:</strong> {{ $fileSize }} KB</p>
        <p><strong>Tipo:</strong> {{ $fileType }}</p>
        <p><strong>Visibilidad:</strong> {{ $file->visibility }}</p>
        <p><strong>Propietario:</strong> {{ $file->user->name }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $file->created_at }}</p>
        <p><strong>Última Actualización:</strong> {{ $file->updated_at }}</p>
        <hr>
        <a href="{{ url('/') }}" class="button is-primary is-inverted">Volver a la lista de archivos</a>
        <a href="{{ url("/download/{$file->id}") }}" class="button is-primary">Descargar Archivo</a>
        <hr>

        <!-- Mostrar vista previa según el tipo de archivo -->
        <section class="section">
            <div class="container">
                @if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']))
                    <!-- Vista previa de imagen -->
                    <figure class="image is-4by3">
                        <img src="{{ route('file.content', ['file' => $file->id]) }}" alt="Vista previa de {{ $file->name }}">
                    </figure>
                @elseif (in_array($fileType, ['pdf']))
                    <!-- Vista previa de PDF -->
                    <iframe src="{{ route('file.content', ['file' => $file->id]) }}" width="100%" height="600px"></iframe>
                @elseif (in_array($fileType, ['txt', 'csv', 'log', 'html','md', 'php', 'js', 'json', 'xml', 'yml', 'yaml', 'env']))
                    <!-- Vista previa de texto -->
                    <div class="box">
                        <pre>{{ file_get_contents(storage_path('app/private/' . $file->path)) }}</pre>
                    </div>
                @else
                    <!-- Archivo no compatible -->
                    <p>Este tipo de archivo no tiene vista previa disponible.</p>
                @endif
            </div>
        </section>
        
    </div>
</section>
<hr>
@can('comment', $file)
<section class="section">
    {{-- Formulario de comentarios --}}
    <form method="POST" action="/comment/{{ $file->id }}">
        @csrf
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
@endcan

<!-- Mensajes de error o confirmación -->
@if (session('success'))
    <div class="notification is-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="notification is-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Lista de comentarios -->
<div class="section">
    <h2 class="title is-4">Comentarios</h2>

    @if ($comments->count())
        <ul>
            @foreach ($comments as $comment)
                <li>
                    @include('partials.comment', ['comment' => $comment]) {{-- Recursividad --}}

                    <!-- Botón para mostrar el formulario de respuesta -->
                    {{-- @can('reply', $comment)
                        <button 
                            class="button is-primary is-small is-rounded is-outlined reply-button" 
                            data-comment-id="{{ $comment->id }}" 
                            data-comment-author="{{ $comment->user->name }}">
                            Responder
                        </button>
                    @endcan --}}

                    <!-- Contenedor para el formulario de respuesta -->
                    <div class="reply-form-container" id="reply-form-{{ $comment->id }}"></div>
                </li>
                <hr>
            @endforeach
        </ul>

        <!-- Paginación -->
        @for ($i = 1; $i <= $comments->lastPage(); $i++)
            <a href="?page={{ $i }}">{{ $i }}</a>
        @endfor
    @else
        <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
    @endif
</div>

<!-- Script de JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar todos los botones de respuesta
        const replyButtons = document.querySelectorAll('.reply-button');

        replyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const commentId = button.getAttribute('data-comment-id');
                const commentAuthor = button.getAttribute('data-comment-author');
                const formContainer = document.querySelector(`#reply-form-${commentId}`);

                // Verificar si el formulario ya está visible
                if (formContainer.innerHTML.trim() !== '') {
                    formContainer.innerHTML = ''; // Ocultar el formulario si ya existe
                    return;
                }

                // Crear el formulario dinámico
                const formHtml = `
                    <form method="POST" action="/comment/${commentId}/reply" class="box">
                        @csrf
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
                formContainer.innerHTML = formHtml;
            });
        });
    });
</script>
@endsection
