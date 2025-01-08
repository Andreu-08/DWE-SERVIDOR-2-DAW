@extends('layout')
@section('content')

<section class="section">
    <form method="POST" action="/login" class="box">
        @csrf
        <h1 class="title has-text-centered">Login</h1>
    
        <section class="section">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" placeholder="Email">
        </section>

        <section class="section">
            <label class="label">Password</label>
            <input class="input" type="password" name="password" placeholder="Password">
        </section>

        <section class="section">
            <input class="button is-primary is-fullwidth" type="submit" value="Login">
        </section>

        <section class="section has-text-centered">
            <p>¿No tienes cuenta? <a href="/register">Regístrate aquí</a></p>
        </section>
    </form>
</section>

@endsection