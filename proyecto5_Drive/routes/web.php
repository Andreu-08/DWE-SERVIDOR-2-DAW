<?php

use App\Http\Controllers\FicheroController;
use App\Http\Requests\RegisterRequest;
use App\Models\Fichero;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome')
        ->with('ficheros',Fichero::all());
});


//rutas para los Ficheros
Route::middleware("auth")->group(function() {
    Route::post('/upload', [FicheroController::class, 'upload'])
        ->can('upload', App\Models\Fichero::class);

    Route::get('/download/{file}', [FicheroController::class, 'download']);

    Route::get('/delete/{file}', [FicheroController::class, 'delete'])
        ->can('delete', 'file');
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

