<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\FicheroController;
use App\Http\Requests\RegisterRequest;
use App\Models\Comment;
use App\Models\Fichero;
use App\Models\User;
use Faker\Guesser\Name;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome')
        ->with('ficheros', Fichero::paginate(5));
});


//rutas para los Ficheroscontroladas por el middelware deautenticancion
Route::middleware("auth")

->group(function() {
    Route::post('/upload', [FicheroController::class, 'upload'])
        ->can('upload', App\Models\Fichero::class);

    Route::get('/download/{file}', [FicheroController::class, 'download']);

    Route::delete('/delete/{file}', [FicheroController::class, 'delete'])
        ->can('delete', 'file');

    //ruta para previsualizar el archivo 
    Route::get('/preview/{file}', [FicheroController::class, 'preview'])
        ->name('file.preview')
        ->can('view', 'file');
        
    Route::get('/file-content/{file}', [FicheroController::class, 'serveContent'])
    ->name('file.content');

    //rutas para admin

    //muestar el dashboard de administrador
    Route::get('/admin', [AdminController::class, 'index'])
        ->can('accessAdminPanel', User::class)
        ->name('admin.index');

    //rutas para los comentrios 

    //permite poner un comentario en un fichero
    Route::post('/comment/{file}', [ComentController::class, 'store']);
    //muestra la vista del comentario para poder responder
    Route::get('/comment/{comment}', [ComentController::class, 'show'])
        ->name('comment.show');
    //permite responder a un comentario de forma recursiva
    Route::post('/comment/{comment}/reply', [ComentController::class, 'reply'])
        ->name('comment.reply');
    //permite borrar comentarios solo si eres el autor
    Route::delete('/comment/{comment}', [ComentController::class, 'destroy'])
        ->can('delete', 'comment')
        ->name('comment.delete');
    
});


//login
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function(Request $request){
    
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        return redirect()->intended('/');
    }
    
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });
    
    Route::get('/logout', function(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/');
    });
    
    //registro
    Route::get('/register', function () {
        return view('register');
    });
    
    Route::post('/register', function(RegisterRequest $request) {
        
        $data = $request->validated();
        
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        
        return redirect('/')->with('status', 'Registro exitoso. Ahora puedes iniciar sesión.');
    });
    
    