@include('partials.navbar')

<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Ofertas</h2>
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($ofertas as $producto)
            <li class="bg-white rounded-lg shadow-lg p-4">
                <a href="{{ url('/producto/' . $producto['id']) }}">
                    <img src="{{ $producto['image_url'] }}" alt="{{ $producto['name'] }}" class="w-full h-auto mb-2">
                </a>
                <h3 class="text-xl font-bold">{{ $producto['name'] }}</h3>
                <p>Precio: ${{ $producto['price'] }}</p>
            </li>
        @endforeach
    </ul>
</div>
@include('partials.footer')
