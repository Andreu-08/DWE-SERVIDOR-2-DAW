@extends('layout')
@section('content')
<body>
    <section class="section">
        <div class="container">
            <h2 class="title has-text-centered">Registrarse</h2>
    
            @if($errors->any())
                <section class="notification is-danger">
                    {{ $errors->first() }}
                </section>
            @endif
    
            <form method="POST" action="/register" class="box">
                @csrf
    
                <section class="field">
                    <label class="label" for="name">Nombre</label>
                    <div class="control">
                        <input class="input" type="text" id="name" name="name" required>
                    </div>
                </section>
    
                <section class="field">
                    <label class="label" for="email">Correo Electrónico</label>
                    <div class="control">
                        <input class="input" type="email" id="email" name="email" required>
                    </div>
                </section>
    
                <section class="field">
                    <label class="label" for="password">Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" id="password" name="password" required>
                    </div>
                </section>
    
                <section class="field">
                    <label class="label" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </section>
    
                <section class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth">Registrarse</button>
                    </div>
                </section>
            </form>
    
            <p class="has-text-centered">
                ¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>
            </p>
        </div>
    </section>
    </body>
@endsection