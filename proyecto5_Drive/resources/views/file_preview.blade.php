<!-- resources/views/file_preview.blade.php -->
@extends('layout')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="title">Vista Previa del Archivo</h1>
        <p><strong>Nombre del Archivo:</strong> {{ $file->name }}</p>
        <p><strong>Tamaño:</strong> {{ $fileSize }} KB</p>
        <p><strong>Tipo:</strong> {{ $fileType }}</p>
        <p><strong>Visibilidad:</strong> {{ $file->visibility }}</p>
        <p><strong>Propietario:</strong> {{ $file->user->name }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $file->created_at }}</p>
        <p><strong>Última Actualización:</strong> {{ $file->updated_at }}</p>

        <hr>

        <!-- Mostrar vista previa según el tipo de archivo -->
        @if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']))
            <figure class="image is-4by3">
                <img src="{{ Storage::url($file->path) }}" alt="{{ $file->name }}">
            </figure>
        @elseif (in_array($fileType, ['txt', 'csv', 'log']))
            <div class="box">
                <pre>{{ Storage::get($file->path) }}</pre>
            </div>
        @else
            <p>Este tipo de archivo no tiene vista previa disponible.</p>
        @endif

        <hr>

        <!-- Botón para descargar el archivo -->
        <a href="{{ url("/download/{$file->id}") }}" class="button is-primary">Descargar Archivo</a>
    </div>
</section>
@endsection
