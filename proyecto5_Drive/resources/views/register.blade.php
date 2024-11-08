<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/register.css">
</head>
<body>
<div>
    <h2>Registrarse</h2>

    @if($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div >
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div >
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>

    <p>
        ¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>
    </p>
</div>

</body>
</html>