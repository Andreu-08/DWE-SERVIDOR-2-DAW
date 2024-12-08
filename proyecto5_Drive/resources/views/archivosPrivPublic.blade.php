<section class="box">
    <h2 class="title is-4">Archivos</h2>
    <table class="table is-fullwidth is-striped">
        <thead>
            <tr>
                <th>Name</th>
                {{-- <th>Size</th> --}}
                <th>Owner</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th class="has-text-centered">Action</th>
                <th>Visibility</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ficheros as $fichero)
            <tr>
                <td>
                    <a href="{{ route('file.preview', ['file' => $fichero->id]) }}">
                        {{ $fichero->name }}
                    </a>
                </td>
                {{-- <td>{{ Storage::disk('private')->size($fichero->path) }} KB</td> --}}
                <td>{{ $fichero->user ? $fichero->user->name : 'Desconocido' }}</td>
                <td>{{ $fichero->created_at }}</td>
                <td>{{ $fichero->updated_at }}</td>
                <td class="has-text-centered">
                    @can('delete', $fichero)
                    <form method="POST" action="/delete/{{ $fichero->id }}" class="is-inline" onsubmit="return confirmarBorrado()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button is-small is-danger is-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 50 50">
                                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                    <path stroke="#e63946" d="M25 22.917v12.5m8.333-20.834v-6.25A2.083 2.083 0 0 0 31.25 6.25h-12.5a2.083 2.083 0 0 0-2.083 2.083v6.25z"/>
                                    <path stroke="#e63946" d="M8.333 14.583h33.334zm27.23 27.23l1.937-27.23h-25l1.938 27.23a2.083 2.083 0 0 0 2.083 1.937h16.958a2.084 2.084 0 0 0 2.084-1.938"/>
                                </g>
                            </svg>
                        </button>
                    </form>
                    @endcan
                    <a href="/download/{{ $fichero->id }}" class="button is-small is-primary is-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 50 50">
                            <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                <path stroke="#457b9d" d="M31.25 29.167L25 35.417l-6.25-6.25m6.25 6.25V6.25"/>
                                <path stroke="#457b9d" d="M8.333 35.417v6.25a2.083 2.083 0 0 0 2.084 2.083h29.166a2.083 2.083 0 0 0 2.084-2.083v-6.25"/>
                            </g>
                        </svg>
                    </a>
                    @can('share', $fichero)
                    <button class="button is-small is-success is-light" onclick="compartirFichero('{{ $fichero->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 50 50">
                            <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                <path stroke="#2a9d8f" d="m33.333 6.25l10.417 8.333l-10.417 8.334V18.75s-10.416 0-14.583 6.25c0 0 2.083-12.5 14.583-14.583z"/>
                                <path stroke="#2a9d8f" d="M43.75 27.083v12.5a2.083 2.083 0 0 1-2.083 2.084H8.333a2.083 2.083 0 0 1-2.083-2.084V12.5a2.083 2.083 0 0 1 2.083-2.083h8.334"/>
                            </g>
                        </svg>
                    </button>
                    @endcan
                </td>
                <td>{{ $fichero->visibility }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ficheros->links() }}
</section>
