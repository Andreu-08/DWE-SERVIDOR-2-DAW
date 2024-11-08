<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Peliculas</title>
    <!-- Añadir el CDN de Picnic CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
</head>

<h1><span>Lista de peliculas</span></h1>

<form action="/peliculas/create">
    <input type="submit" value="Crear pelicula"/>
</form>

<table class="stack" cellspacing="0" cellspadding="10">
    <thead>
        <tr>
            <th>Título</th>
            <th>Año</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($peliculas as $pelicula)
            <tr>
                <td>{{ $pelicula->title }}</td>
                <td>{{ $pelicula->year }}</td>
                <td>
                    <a href="{{ url('/peliculas/'. $pelicula->id) }}" class="button success">Mostrar</a>
                    <a href="{{ url('/peliculas/' . $pelicula->id . '/edit')}}" class="button warning">Editar</a>
                    <form action="{{ url('/peliculas/' .$pelicula->id)}}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class ="button error">Eliminar</button>
                    </form>

                    </td>
            </tr>
        @endforeach
    </tbody>
</table>
</html>