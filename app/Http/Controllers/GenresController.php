<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Controllers\MediasController;

class GenresController extends Controller
{


    public function deleteGenre($id)
    {
        try {

            $genre = Genre::find($id);

            $genre->delete();
            return redirect()->route('admin.genreList')->with('success', 'Genre is deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.genreList')->with('error', $e->getMessage());
        }
    }

    public function newGenre(GenreRequest $request)
    {
        try {
            $newName = $request->input('name');
            $oldName = $request->input('oldName');
           

            if ($oldName) {
                $genre = Genre::where('name', $oldName)->first();
                $message = 'Genre is update successfully!';
            } else {
                $genre = new Genre();
                $message = 'New Genre is create successfully!';
            }

            $genre->name = $newName;
            $genre->save();


            return redirect()->route('admin.genreList')->with('success', $message);
        } catch (\Exception $e) {
            // throw $e;
         
            return redirect()->route('admin.genreList')->with('error', $e->getMessage());
        }
    }

    public function getAllGenres()
    {
        $genres = Genre::all();
        return $genres;
    }

    public function getGenreList()
    {
        $genres = $this->getAllGenres();
        return view('adminPage/genreList', ['genres' => $genres]);
    }
}
