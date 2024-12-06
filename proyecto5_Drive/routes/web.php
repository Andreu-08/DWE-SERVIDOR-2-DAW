<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\FicheroController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/', [FicheroController::class, 'index']);

// Rutas para los Ficheros controladas por el middleware de autenticación
Route::middleware('auth')->group(function() {
    Route::post('/upload', [FicheroController::class, 'upload'])
        ->name('file.upload')
        ->can('upload', App\Models\Fichero::class);

    Route::get('/download/{file}', [FicheroController::class, 'download']);

    Route::delete('/delete/{file}', [FicheroController::class, 'delete'])
        ->can('delete', 'file');

    // Ruta para previsualizar el archivo 
    Route::get('/preview/{file}', [FicheroController::class, 'preview'])
        ->name('file.preview')
        ->can('view', 'file');
        
    Route::get('/file-content/{file}', [FicheroController::class, 'serveContent'])
        ->name('file.content');

    // Ruta para mostrar la papelera
    Route::get('/trash', [FicheroController::class, 'trash'])
        ->name('file.trash');

    // Ruta para restaurar archivos de la papelera
    Route::post('/restore/{id}', [FicheroController::class, 'restore'])
        ->name('file.restore');

    // Ruta para compartir archivos
    Route::post('/share/{file}', [FicheroController::class, 'share'])
        ->name('file.share');
      

    // Ruta para ver archivos compartidos conmigo
    Route::get('/shared-with-me', [FicheroController::class, 'sharedWithMe'])
        ->name('file.sharedWithMe');

    // Rutas para admin
    // Muestra el dashboard de administrador
    Route::get('/admin', [AdminController::class, 'index'])
        ->can('accessAdminPanel', User::class)
        ->name('admin.index');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

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
})->name('login');

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