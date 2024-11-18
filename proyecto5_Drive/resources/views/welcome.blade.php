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
                        <th>Visibility</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ficheros as $fichero)
                    <tr>
                        <td><a href="/preview/{{ $fichero->id }}">{{ $fichero->name }}</a></td>
                        <td>{{ $fichero->size() }}KB</td>
                        <td>{{ $fichero->user->name }}</td>
                        <td>{{ $fichero->created_at }}</td>
                        <td>{{ $fichero->updated_at }}</td>
                        <td>
                            @can('delete', $fichero)
                            <form method="POST" action="/delete/{{ $fichero->id }}" onsubmit="return confirmarBorrado()">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50">
                                        <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path stroke="#344054" d="M33.333 14.583v-6.25A2.083 2.083 0 0 0 31.25 6.25h-12.5a2.083 2.083 0 0 0-2.083 2.083v6.25"/>
                                            <path stroke="#306cfe" d="M8.333 14.583h33.334M37.5 41.667V14.583h-25v27.084a2.083 2.083 0 0 0 2.083 2.083h20.834a2.083 2.083 0 0 0 2.083-2.083"/>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                            @endcan
                            <a href="/download/{{ $fichero->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#2a00fa" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><path stroke-dasharray="20" stroke-dashoffset="20" d="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5"><animate attributeName="d" begin="0.5s" dur="1.5s" repeatCount="indefinite" values="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5;M12 4h2v3h2.5l-4.5 4.5M12 4h-2v3h-2.5l4.5 4.5;M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5"/><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0"/></path><path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.2s" values="14;0"/></path></g></svg>
                            </a>
                        </td>
                        <td>{{ $fichero->visibility }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

      <!-- Formulario de subida en welcome.blade.php -->
        @can('upload', App\Models\Fichero::class)
        <section>
            <h2 class="title is-4">Subir Archivo</h2>
            
            <!-- Formulario de carga de archivos -->
            <form method="POST" action="/upload" enctype="multipart/form-data">
                @csrf
                
                <!-- Selector de archivo -->
                <div class="file has-name is-primary mb-3">
                    <label class="file-label">
                        <input class="file-input" type="file" name="uploaded_file" id="uploadedFileInput" onchange="mostrarNombreArchivo()">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">Elegir archivo...</span>
                        </span>
                        <span class="file-name" id="fileNameLabel">Ningún archivo seleccionado</span>
                    </label>
                </div>
        
                <!-- Selector de visibilidad -->
                <div class="field mb-3">
                    <label class="label">Visibilidad</label>
                    <div class="control">
                        <div class="select is-primary is-rounded">
                            <select name="visibility">
                                <option value="private" selected>Privado</option>
                                <option value="public">Público</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <!-- Botón de enviar -->
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">Subir</button>
                    </div>
                </div>
                
            </form>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <a href="/auditoria" class="button is-primary">Auditoria</a>
            @endif

        </section>
        @endcan 
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
@include('partials.scripts')

@endsection
