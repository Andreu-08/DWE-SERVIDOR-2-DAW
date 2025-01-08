<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar {{ $pelicula ->title }}</title>
    <!-- Añadir el CDN de Picnic CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
</head>

<h1> Editar pelicula {{ $pelicula->title }}</h1>
<h4>Modifica el titulo y el año de la pelicula:</h4>
<form action="{{ url('/peliculas/' . $pelicula->id)}}" method="POST">
    @csrf
    {{-- indicamos que sea un metodo PUT en vez de POST --}}
    @method('PATCH')      
    <label for="">
        <input 
            type="text" 
            name="title" 
            value="{{ $pelicula->title }}" 
            placeholder="{{ $pelicula->title }}">
    </label>

    <label for="">
        <input 
            type="text" 
            name="year" 
            value="{{ $pelicula->year}}" 
            placeholder="{{ $pelicula->year}}">
    </label>

    <button class="stack" type="submit">Actualizar pelicula</button>
</form>