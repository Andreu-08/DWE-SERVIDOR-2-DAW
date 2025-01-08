@extends('layout')

@section('content')

<main class="section">
    <div class="container">
        <h2 class="title is-4">Papelera</h2>
        <table class="table is-fullwidth is-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Owner</th>
                    <th>Deleted at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ficheros as $fichero)
                <tr>
                    <td>{{ $fichero->name }}</td>
                    <td>{{ $fichero->size() }}KB</td>
                    <td>{{ $fichero->user->name }}</td>
                    <td>{{ $fichero->deleted_at }}</td>
                    <td>
                        <form method="POST" action="{{ route('file.restore', $fichero->id) }}">
                            @csrf
                            <button class="button is-success" type="submit">Restaurar</button>
                        </form>
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