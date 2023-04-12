<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $amount = $request->input('cantidad');

    if($amount){
        $genres = Genre::orderBy('id', 'ASC')->take($amount)->get();
    }
    else{
        $genres = Genre::orderBy('id', 'ASC')->get();
    }

    if($request->path() == 'api/generos') {
        return response()->json($genres);
    }
    else{
        return view('genres.index', ['genres' => $genres]);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
    return view('genres.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $request->validate([
      'name' => 'required',
    ]);
    $genre = Genre::create($request->all());
    if (Genre::where('name', $genre->name)->count() > 1) {
      return response()->json(['message' => "El género ya existe"], 409);
    }
    $genre->save();
    return redirect()->route('generos.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
    $genre = Genre::findOrFail($id);
    return view('genres.show', ['genre' => $genre]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
    $genre = Genre::findOrFail($id);
    return view('genres.edit', ['genre' => $genre]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
    $request->validate([
      'name' => 'required',
    ]);
    $genre = Genre::findOrFail($id);
    $genre->name = $request->input('name');
    $genre->save();
    return redirect()->route('generos.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
    $genre = Genre::findOrFail($id);
    $genre->delete();
    return redirect()->route('generos.index')
      ->with('success', 'Género eliminado correctamente');
  }

  public function getMovies(Request $request){
    $genre = Genre::findOrFail($request->id);

    $amount = $request->input('amount');
    if($amount){
        $movies = $genre->movies->take($amount)->get();
    }

    if($request->path() == 'api/generos/peliculas') {
        return response()->json($movies);
    }
    else{
        return response()->json(['error' => 'No hay películas']);
    }
  }
}
