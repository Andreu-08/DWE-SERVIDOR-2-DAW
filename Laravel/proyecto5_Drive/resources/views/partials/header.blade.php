<header class="navbar is-spaced">
    <div class="container is-flex is-align-items-center">
        @auth
        <a href="/" class="navbar-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="m12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81zM12 3L2 12h3v8h6v-6h2v6h6v-8h3z"/></svg>
        </a>
            <span href="/" class="navbar-item">{{ Auth::user()->name }}</span> | 
            
            {{-- Botón visible solo para administradores --}}
            @if (Auth::user()->isAdmin())
                <a href="/admin/dashboard" class="navbar-item button is-primary">Administración</a> | 
            @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger"> Logout</button>
                </form>
        @else 
            <a href="/login" class="navbar-item">Log in</a> |
            <a href="/register" class="navbar-item">Register</a>
        @endauth
    </div>
</header>