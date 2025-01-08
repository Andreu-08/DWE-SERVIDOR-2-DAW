<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pelicula</title>
    <!-- Añadir el CDN de Picnic CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
</head>

<h1>Crear una pelicula</h1>
<h4>Indica el titulo y el año de la pelicula:</h4>
<form action="/peliculas" method="POST">
   
    @csrf
        <label for="">
            <input
                class="stack" 
                name="title" 
                type="text" 
                placeholder="Titulo"
            />
        </label>
    
        <label for="">
            <input 
                class="stack"
                name="year" 
                type="text" 
                placeholder="Año"
            />
    
        <button class="stack" type="submit">Agregar pelicula</button>
    
</form>