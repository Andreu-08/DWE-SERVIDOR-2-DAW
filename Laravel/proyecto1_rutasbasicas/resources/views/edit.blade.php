
<h1>Editar Comentario</h1>
<form method='POST' action='/comments/{{ $id }}'>
    <input type='hidden' name='_method' value='PATCH'>
    <input name=comment value='{{ $texto }}'>
    <button type='submit'>Actualizar comentario</button>
</form>
<br>
<a href='/comments'>Volver a la lista de comentarios</a>
   