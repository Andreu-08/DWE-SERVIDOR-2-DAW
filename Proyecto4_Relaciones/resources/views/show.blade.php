<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
       
    @auth
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/enviar') }}">Enviar noticia</a>
    @else
        <a href="{{ route('login') }}">Log in </a>

        @if (Route::has('register'))

            <a href="{{ route('register') }}">Register</a>

        @endif
    @endauth
    <main>
        <ul>
            <li>
                <a href="{{ $noticia->enlace }}">{{ $noticia->titulo }}</a>
                <p>{{ $noticia->user->name }} | <a href="/noticia/{{ $noticia->id }}">0 Comentarios</a></p>
                <p>{{ $noticia->cuerpo }}</p>

                <form action="/noticia/{{ $noticia->id }}/comentario" method="POST">
                    @csrf
                    <label for="comentario">Comentario:</label> <br>
                    <textarea name="text" type="textarea" id="comentario" placeholder="Escribe tu comentario ..." cols="60" rows="8"></textarea><br>
                    <input type="submit" value="Comentar">
                    <input name="noticia_id" type="hidden"  value="{{ $noticia->id }}" >
                </form>
                <h3>Comentarios</h3>
                  @foreach ( $noticia->comentarios as $comentario )
                    <p>{{ $comentario->user->name}} | {{ $comentario->created_at }}</p>
                    <p>{{ $comentario->text }}</p>
                    <input type="submit" value="Responder">
                @endforeach  
            </li>   
        </ul>
    </main>
    </body>
</html>
