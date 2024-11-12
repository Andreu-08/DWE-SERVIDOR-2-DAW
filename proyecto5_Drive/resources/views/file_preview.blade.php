<!-- resources/views/file_preview.blade.php -->
@extends('layout')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">{{ $file->name }}</h1>

            <p><strong>Propietario:</strong> {{ $file->user->name }}</p>
            <p><strong>Tamaño:</strong> {{ $file->size() }} KB</p>
            <p><strong>Fecha de creación:</strong> {{ $file->created_at }}</p>
            <p><strong>Última actualización:</strong> {{ $file->updated_at }}</p>

            <!-- Vista previa del archivo según el tipo -->
            @if(Str::endsWith($file->name, ['.jpg', '.jpeg', '.png', '.gif']))
                <!-- Vista previa de imagen -->
                <figure class="image is-4by3">
                    <img src="{{ Storage::url($file->path) }}" alt="{{ $file->name }}">
                </figure>
            @elseif(Str::endsWith($file->name, ['.txt', '.md', '.csv', '.log']))
                <!-- Vista previa de texto -->
                <div class="box">
                    <pre>{{ Storage::get($file->path) }}</pre>
                </div>
            @else
                <p>Este tipo de archivo no es compatible para vista previa.</p>
            @endif

            <a href="/download/{$file->id}" class="button is-primary mt-3">Descargar</a>
        </div>
    </section>
@endsection
