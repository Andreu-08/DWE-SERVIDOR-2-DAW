@extends('layout')

@section('content')
<header class="navbar is-spaced">
    <div class="container is-flex is-align-items-center">
        @auth
            <span class="navbar-item">{{ Auth::user()->name }}</span> | 
            <a href="/logout" class="navbar-item">Log out</a>
        @else 
            <a href="/login" class="navbar-item">Log in</a> |
            <a href="/register" class="navbar-item">Register</a>
        @endauth
    </div>
</header>

<main class="section">
    <div class="container">
        <!-- Tabla de Archivos -->
        <section class="box">
            <h2 class="title is-4">Archivos</h2>
            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Owner</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ficheros as $fichero)
                    <tr>
                        <td><a href="/download/{{ $fichero->id }}">{{ $fichero->name }}</a></td>
                        <td>{{ $fichero->size() }}KB</td>
                        <td>{{ $fichero->user->name }}</td>
                        <td>{{ $fichero->created_at }}</td>
                        <td>{{ $fichero->updated_at }}</td>
                        <td>
                            @can('delete', $fichero)
                            <a href="/delete/{{ $fichero->id }}" class="button is-small is-danger is-light">
                                Delete
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Formulario de carga -->
        <section>
            @can('upload', App\Models\Fichero::class)
            <h2>Subir Archivo</h2>
            <form method="POST" action="/upload" enctype="multipart/form-data">
                @csrf
                <div>
                    <div>
                        <label>
                            <input type="file" name="uploaded_file">
                        </label>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit">Upload</button>
                    </div>
                </div>
            </form>
            @endcan
        </section>

        <!-- Notificaciones de Éxito/Error -->
        <section class="mt-5">
            @if (session('success'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ session('error') }}
                </div>
            @endif
        </section>
    </div>
</main>
@endsection
