<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeliculaRequest;
use App\Http\Requests\UpdatePeliculaRequest;
use App\Models\Pelicula;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index')->with('peliculas', Pelicula::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeliculaRequest $request)
    {
        $pelicula = new pelicula;
        $pelicula -> title = $request -> title;
        $pelicula -> year = $request -> year;
        $pelicula -> save();
        return redirect('/peliculas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        return view('show')->with('pelicula', $pelicula);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('edit')->with('pelicula', $pelicula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeliculaRequest $request, Pelicula $pelicula)
    {
        //Asignar los nuevos valores a la pelicula
        $pelicula -> title = $request -> title;
        $pelicula -> year = $request -> year;
        //guardar los cambios en la BD
        $pelicula -> save();

        return redirect('/peliculas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula -> delete();
        return redirect('/peliculas');
    }
}
