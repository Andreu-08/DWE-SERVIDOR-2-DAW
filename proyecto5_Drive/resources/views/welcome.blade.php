<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive</title>
    <link rel="stylesheet" href="/css/welcome.css">
</head>

<header>
@auth
    {{ Auth::user()->name }} | 
    <a href="/logout">Log out</a>
@else 
    <a href="/login">Log in</a> |
    <a href="/register">Register</a>
@endauth
</header>
<main>
    <section>
        <table>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Owner</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Acción</th>
            </tr>
            @foreach ($ficheros as $fichero)
            <tr>
                <td><a href="/download/{{ $fichero->id }}">{{ $fichero->name }}</a></td>
                <td>{{ $fichero->size() }}KB</td>
                <td>{{ $fichero->user->name }}</td>
                <td>{{ $fichero->created_at }}</td>
                <td>{{ $fichero->updated_at }}</td>
                <td>
                    @can('delete', $fichero)
                    <a href="/delete/{{ $fichero->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><g fill="none" stroke-width="4"><path stroke="#000" stroke-linejoin="round" d="M15 12L16.2 5H31.8L33 12"/><path stroke="#000" stroke-linecap="round" d="M6 12H42"/><path fill="#2f88ff" fill-rule="evenodd" stroke="#000" stroke-linecap="round" stroke-linejoin="round" d="M37 12L35 43H13L11 12H37Z" clip-rule="evenodd"/><path stroke="#fff" stroke-linecap="round" d="M19 35H29"/></g></svg></a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </section>
    
    <section>
        @can('upload',App\Models\Fichero::class)
        <form method="POST" action="/upload" enctype="multipart/form-data">
            @csrf
            <input type="file" name="uploaded_file"/>
            <input type="submit" value="Upload"/>
        </form>
        @endcan
    </section>
</main>