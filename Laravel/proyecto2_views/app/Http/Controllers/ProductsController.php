<?php

namespace App\Http\Controllers;
class Producto {
    public $name;
    public $id;
    public $price;
    public $image_url;

    public function __construct($name, $id, $price, $image_url) {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->image_url = $image_url;
    }
}

class ProductsController extends Controller
{
    public $ofertas, $seleccion,$topventas;
    
    public function init_variables() {
        // Array de productos en oferta (array asociativo)
        $this->ofertas = [
            ["name" => "Teclado mecánico RGB", "id" => 993, "price" => 79.99, "image_url" => "https://files.oaiusercontent.com/file-KjBG9hRJBJHst3ozDdP96yfI?se=2024-09-28T15%3A21%3A04Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Dd9dce523-6272-4a82-933e-f4d1b5851305.webp&sig=kWPtDpTO0CQimEkrPd%2By754nbcQ8Xn7lo5l8iyAnw/Y%3D"],
            ["name" => "Ratón inalámbrico", "id" => 994, "price" => 49.99, "image_url" => "https://files.oaiusercontent.com/file-zrJIVlQiaKtuBAs0DOCEt1w9?se=2024-09-28T15%3A22%3A23Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D0a4fc02b-3f70-462f-802f-0195b30628cc.webp&sig=WoxT%2BjxFVanyoKI9b%2BHx2rQ2OhDhs4ZbmpVuGWM4CDA%3D"],
            ["name" => "Disco duro SSD 1TB", "id" => 997, "price" => 109.99, "image_url" => "https://files.oaiusercontent.com/file-FuR97TcK3YG0q8XPRSFPtE3W?se=2024-09-28T15%3A24%3A57Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D5107f0db-af35-4f16-b234-f0911b733b54.webp&sig=3CWYm7jMa6qr8aU/su3d4lMNkFyKjHa%2B%2BH3nZQsPs0w%3D"],
            ["name" => "Webcam 1080p", "id" => 1004, "price" => 39.99, "image_url" => "https://files.oaiusercontent.com/file-d3KvLIvxvTIsnkZ0fIIBj0SI?se=2024-09-28T15%3A25%3A57Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Dc823d10a-6af1-4378-8cc0-a17a056a7664.webp&sig=Zy37SsPw65znJg6HeZoqZuUI9vFByBqr%2B20cJydEh2w%3D"],
            ["name" => "Auriculares con micrófono", "id" => 1003, "price" => 49.99, "image_url" => "https://files.oaiusercontent.com/file-ySqBZVt8E5xpFkeKORn1KhB1?se=2024-09-28T15%3A26%3A55Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D1932eb18-88bf-41c5-a81c-18c049eccbab.webp&sig=njX8rmTiCRiONzvWqdr9KxCWMQ6E4gcYt9pkgzfc5hw%3D"],
            ["name" => "Cámara de seguridad IP", "id" => 1012, "price" => 89.99, "image_url" => "https://files.oaiusercontent.com/file-PYZuXua7IeixZFlrkIXbJIcz?se=2024-09-28T15%3A27%3A37Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D80e734ab-27e4-45f3-801f-c94871ffbe2b.webp&sig=a/bMMfXHCYbMqKty4WEWm3jAuhHfyUPW6rE20rqa83o%3D"],
        ];
    
        // Array de productos de selección (guardado como JSON string)
        $this->seleccion = json_decode('[
            { "name" : "Monitor 4K", "id" : 995, "price" : 299.99, "image_url" : "https://files.oaiusercontent.com/file-9V8gv25TznoLfgv0li2vMges?se=2024-09-28T15%3A28%3A31Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D7445adae-5ff4-4ed6-964c-3e62994f39aa.webp&sig=iz5yp%2BkmZruQDUmTBK1WedLo/gSY%2BuIFQ6QMfBmH0q0%3D" },
            { "name" : "Laptop gaming", "id" : 996, "price" : 1299.99, "image_url" : "https://files.oaiusercontent.com/file-3ECMKK7h6iBxPniAqP2fAXlJ?se=2024-09-28T15%3A30%3A13Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D448142f1-2f48-4248-ab89-50ca93e53f77.webp&sig=m2QOm/RkEEnteG64mfDx9ysodvy8g1AhYUBdyuUN5G4%3D" },
            { "name" : "Memoria RAM 16GB", "id" : 999, "price" : 89.99, "image_url" : "https://files.oaiusercontent.com/file-xf3U1hEC2UuGR4FqYiOFXsni?se=2024-09-28T15%3A31%3A02Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D3fd7790b-5a6b-4062-a7ce-e43b6d132aee.webp&sig=IfpI6dPTHMgLIZBFV7UKbaWUCFlu03y/dsPtYRplIjQ%3D" },
            { "name" : "Router Wi-Fi 6", "id" : 1005, "price" : 129.99, "image_url" : "https://files.oaiusercontent.com/file-65iQHjPihRaMAlIujqP5bMRS?se=2024-09-28T15%3A31%3A45Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D7de1778a-9f33-400a-bb81-bba17bf7ec05.webp&sig=kaHXBRnIFA4E6NK5wmbLcdC6YCCTAW0iFvM5ZRZLk/M%3D" },
            { "name" : "Monitor curvo ultrawide", "id" : 1009, "price" : 399.99, "image_url" : "https://files.oaiusercontent.com/file-afsKltSqYnjkfZNsUh80MtCl?se=2024-09-28T15%3A32%3A06Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D4e6c6996-722c-4d8d-be19-b382e82ef26c.webp&sig=CSRNYkeWbMscCqIWAVsXbiNhw2oAyAkP/3G0lwtJFEc%3D" },
            { "name" : "Cámara réflex digital", "id" :1013, "price" : 499.99, "image_url" : "https://files.oaiusercontent.com/file-8vAPuq2Bc0RoFpW6lFSn3OIp?se=2024-09-28T15%3A56%3A10Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D82b5ae99-9f6b-475b-bf60-dbfe359aad6b.webp&sig=dSNE4hA4F4%2Bw0O7givzfjMLscfCHSkzG0PYk6281q8M%3D" }
        ]',true);
    
        // Array de productos top ventas (como objetos de la clase Producto)
        $this->topventas = [
            new Producto("Tarjeta gráfica RTX 3080", 998, 699.99, "https://files.oaiusercontent.com/file-j7Oj6ip7vwUGIBjHMyd4BiFR?se=2024-09-28T15%3A32%3A31Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3De8ddb7ff-6057-46f1-9450-e6218d60ee90.webp&sig=I8cmHiVIP2OhojetpywJmSvd25kKsu3pw/GK1p59yLM%3D"),
            new Producto("Fuente de poder 750W", 1000, 119.99, "https://files.oaiusercontent.com/file-jU8rdLP9B8zcSwqbcufGln6w?se=2024-09-28T15%3A33%3A49Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Dcf7848f0-969f-4075-91a6-ca782a4db03b.webp&sig=7uqWMCsqFBenKvkZQb9Sp3ZuqsjBailxHi3/2bZ%2BIVM%3D"),
            new Producto("Placa base ATX", 1001, 159.99, "https://files.oaiusercontent.com/file-YEVeIj4cFs71WPtX8FOg1hxR?se=2024-09-28T15%3A35%3A13Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D57cd9159-eb87-4035-9f01-e17d09b0b1c0.webp&sig=mn1JyYUifGnoCylxuMB/jjptlLcaLBK0B1djXdfAlJ4%3D"),
            new Producto("Microprocesador Intel i7", 1007, 329.99, "https://files.oaiusercontent.com/file-vCKGCklcw9ADG4I3wd3vIGI1?se=2024-09-28T15%3A35%3A37Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D1fd207b3-8fa5-4bea-afff-369453cc1c88.webp&sig=ls2guxoEx34guApJcrACOENzg9weKKZXGvQtEcUVSYE%3D"),
            new Producto("Impresora láser", 1006, 199.99, "https://files.oaiusercontent.com/file-BZJTGrXgslmgw8qifQqVsiTI?se=2024-09-28T15%3A56%3A47Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D3e715304-da90-49ed-9bf7-4d1d93e1024e.webp&sig=xh7GlS4spR05ncQNSR%2BEGZszguymE%2B8RXI/bhWA8ikU%3D"),
            new Producto("Teclado ergonómico", 1010, 59.99, "https://files.oaiusercontent.com/file-dl0ZfYZpQOJTDfeB824WUhSR?se=2024-09-28T15%3A57%3A31Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D51c37e48-1142-4c75-bcee-cb981a9a8ce6.webp&sig=Yv3IRfsKSWBTrxNgaBrOS5ZxL2EJa22MXPLKm5Ox/po%3D"),
        ];
    }
    public function __construct(){
        $this->init_variables();
      }

    public function index(){

        return view('index',[
            'ofertas' => $this->ofertas,
            'seleccion'=> $this->seleccion,
            'topventas'=>$this->topventas,
            ]
        );
    }
    
    public function mostrarOfertas() {
        return view('ofertas', [
            'ofertas' => $this->ofertas,
        ]);
    }
    
    
    public function mostrarSeleccion() {
        return view('seleccion', [
            'seleccion' => $this->seleccion,
        ]);
    }
    
    public function mostrarTopVentas() {
        return view('topventas', [
            'topventas' => $this->topventas,
        ]);
    }
    
    public function mostrarProducto($id){
        // Inicializar una variable para almacenar el producto encontrado

    // Devolver la vista con los datos del producto
        return view('detalles');
        
    }
    
}

