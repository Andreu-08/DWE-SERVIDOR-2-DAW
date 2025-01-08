{{-- layout principal del que eredaran todas las vistas --}}
<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.header')
    <div class="container">
        {{-- contenido principal de las vistas --}}
        @yield('content')
    </div>
</body>
</html>