@extends('layout')

@section('content')

<main class="section">
    <div class="container">
        <h2 class="title is-4">Archivos Compartidos Conmigo</h2>
        <table class="table is-fullwidth is-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Owner</th>
                    <th>Shared at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ficheros as $fichero)
                <tr>
                    <td>{{ $fichero->name }}</td>
                    <td>{{ $fichero->size() }}KB</td>
                    <td>{{ $fichero->user->name }}</td>
                    <td>{{ $fichero->pivot->created_at }}</td>
                    <td>
                        <a href="{{ route('file.preview', $fichero->id) }}" class="button is-link">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Paginación para la tabla de ficheros --}}
        {{ $ficheros->links() }}
    </div>
</main>

@endsection