
<h1>Lista de Comentarios</h1>
@if($superarray == NULL)
    <p>No hay comentarios</p>
@else
    <ul>
    @foreach ($superarray as $comment) 
        <li><a href='/comments/{{$loop->index}}'> {{$comment}}</a>
        <a href='/comments/{{$loop->index}}/edit'>Editar</a>
        <a href='/comments/{{$loop->index}}'>Eliminar</a>
    @endforeach
    </ul>
@endif
<a href='/comments/create'>Añadir nuevo comentario</a>