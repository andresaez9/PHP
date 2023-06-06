<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function getIndex() {
        return view('catalog.index', ['movies' => Movie::all()]);
    }

    public function getShow($id) {
        return view('catalog.show', ['movie' => Movie::findOrFail($id)]);
    }

    public function getCreate() {
        return view('catalog.create');
    }

    public function postCreate(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'year' => 'required|numeric',
            'director' => 'required',
            'poster' => 'required',
            'synopsis' => 'required|min:10',
        ]);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->rented = false;
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return redirect(route('home'))->with('success', 'La película se ha creado correctamente');
    }

    public function getEdit($id) {
        return view('catalog.edit', ['movie' => Movie::findOrFail($id)]);
    }

    public function putEdit(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required',
            'year' => 'required|numeric',
            'director' => 'required',
            'poster' => 'required',
            'synopsis' => 'required|min:10',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->update();
        return redirect(route('catalog.show', $id))->with('success', 'La película se ha modificado correctamente');
    }

    public function deleteMovie($id) {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect(route('home'))->with('success', 'La película se ha eliminado correctamente');
    }

    public function putRent($id) {
        $movie = Movie::findOrFail($id);
        $movie->rented = true;
        $movie->update();
        return redirect(url('/catalog/show/' . $id))->with('success', 'La película ha sido alquilada');
    }

    public function putReturn($id) {
        $movie = Movie::findOrFail($id);
        $movie->rented = false;
        $movie->update();
        return redirect(url('/catalog/show/' . $id))->with('success', 'La película ha sido devuelta');
    }
}
