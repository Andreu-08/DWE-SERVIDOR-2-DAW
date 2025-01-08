<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostar {{ $pelicula ->title }}</title>
    <!-- Añadir el CDN de Picnic CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">      
</head>

<h1>{{ $pelicula ->title}}</h1>

<form action="/peliculas">
    <input type="submit" value="Listado de Peliculas" />
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Año</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ $pelicula->id }}</td>
                <td>{{ $pelicula->title }}</td>
                <td>{{ $pelicula->year }}</td>
            </tr>
    </tbody>
</table>
