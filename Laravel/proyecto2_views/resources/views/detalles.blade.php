    @include('partials.navbar')
    <div class="producto-detalles flex flex-col items-center p-8">
        <h2 class="text-3xl font-bold mb-4">{{ $producto['name'] }}</h2>
        <img src="{{ $producto['image_url'] }}" alt="{{ $producto['name'] }}" width="500" height="500" class="rounded-lg shadow-md mb-4">
        <p class="text-xl font-semibold mb-6">Precio: ${{ $producto['price'] }}</p>
        <div class="descripcion max-w-2xl text-justify">
            <h3 class="text-2xl font-semibold mb-2">Descripción del producto:</h3>
            <p class="text-lg text-gray-700">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet quam vitae leo ultricies pulvinar. 
                Praesent tincidunt sapien non ipsum sagittis, a varius nulla vulputate. Donec vestibulum purus at erat ornare, 
                nec iaculis ligula fringilla.
            </p>
        </div>
    </div>
    @include('partials.footer')

 