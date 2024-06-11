<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Favorite;
use App\Http\Requests\MediaRequest;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\GenresController;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MediasController extends Controller
{
    public function getAllMedias()
    {
        $series = $this->getMedias(true);
        $movies = $this->getMedias(false);
        return view('welcome', ['series' => $series, 'movies' => $movies]);
    }

    public function deleteMedia($id)
    {
        $isSerie = false;
        try {

            $media = Media::find($id);
            $isSerie = $media->isSerie;

            $media->delete();
            if ($isSerie) {
                return redirect()->route('admin.serieList')->with('success', '¡Serie is deleted successfully!');
            } else {
                return redirect()->route('admin.movieList')->with('success', '¡Movie is deleted successfully!');
            }
        } catch (\Exception $e) {
            if ($isSerie) {
                return redirect()->route('admin.serieList')->with('error', $e->getMessage());
            } else {
                return redirect()->route('admin.movieList')->with('error', $e->getMessage());
            }
        }
    }


    public function getNewForm(Request $request)
    {
        $isSerie = $request->query('isSerie', false);

        return view('adminPage/new', $this->getAllInformation($isSerie));
    }


    public function getEditForm($id)
    {
        $media = Media::with(['actors', 'genres', 'director', 'country', 'episodes'])
            ->where('id_media', $id)
            ->first();
        $isSerie = $media->isSerie == 1 ? true : false;
        // dd($media->episodes);

        return view('adminPage/edit', $this->getAllInformation($isSerie, $media));
    }
    public function getAllInformation($isSerie, $media = null)
    {

        $genresController = app()->make(GenresController::class);
        $peopleController = app()->make(PeoplesController::class);
        $countryController = app()->make(CountriesController::class);

        $genres = $genresController->getAllGenres();
        $people = $peopleController->getAllPeopleName();
        $countries = $countryController->getAllCountryNames();
        if ($media) {
            return compact('genres', 'people', 'countries', 'isSerie', 'media');
        }

        return compact('genres', 'people', 'countries', 'isSerie');
    }
    public function getMovieList()
    {

        $movies = $this->getMedias(false);

        return view('adminPage/movieList', ['movies' => $movies]);
    }

    public function getSerieList()
    {

        $series = $this->getMedias(true);
        return view('adminPage/serieList', ['series' => $series]);
    }

    public function seeDetail($id)
    {
        $media = Media::with(['actors', 'genres', 'director', 'country', 'episodes' => function ($query) {
            $query->orderBy('season', 'asc');
        }])
            ->where('id_media', $id)
            ->first();

        $actorName = [];
        foreach ($media->actors as $actor) {
            $actorName[] = $actor->name;
        }

        $genreName = [];
        foreach ($media->genres as $genre) {
            $genreName[] = $genre->name;
        }

        $user = auth()->user();
        $userId = $user->id_user;
        $user = User::find($userId);

        $isFavorited = $user->favoriteMedias()->where('favorite_medias.id_media', $id)->exists();
       // dd($media->toArray());
        return view('detail', [
            'media' => $media->toArray(),
            'actors' => $actorName,
            'genres' => $genreName,
            'isFavorited' => $isFavorited
        ]);
    }




    public function getMedias($isSerie, $genreId = null)
    {
        if (!$genreId) {

            $series = Media::with(['actors', 'genres', 'director', 'country', 'episodes'])
                ->where('isSerie', $isSerie)
                ->get()
                ->toArray();
        } else {
            $series = Media::with(['actors', 'genres', 'director', 'country', 'episodes'])
                ->where('isSerie', $isSerie)
                ->whereHas('genres', function ($query) use ($genreId) {
                    $query->Where('genres.id_genre', $genreId);
                })
                ->get()
                ->toArray();
        }

        return $series;
    }

    public function newMedia(MediaRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->input('id')) {
                $accion = 'update';

                $media = Media::find(intval($request->input('id')));
                $id_episode = $media->episodes[0]->id_episode;
            } else {
                $accion = 'create';
                $id_episode = null;
                $media = new Media();
            }

            $media->title = $request->input('title');
            $media->release_year = $request->input('release_year');
            $media->description = $request->input('description');
            $media->isSerie = $request->input('isSerie') == 0 ? false : true;
            //add country id
            $countryId = app(CountriesController::class)->getCountry($request->input('country'));

            $media->country = $countryId;



            //add image
            $image = $request->file('img_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $media->img_url = $imageName;



            //add director
            $directorName = $request->input('director');
            $directorId = app(PeoplesController::class)->findDirectorWithName($directorName);

            $media->director = $directorId;



            // Save the media
            $saved = $media->save();

            //add actors

            $actors = $request->input('actors');
            $media->actors()->sync($actors);
            //add genres

            $genres = $request->input('genres');
            $media->genres()->sync($genres);

            //add url
            if ($saved && !$media->isSerie) {

                $episode = app(EpisodesController::class)->addEpisode(
                    $media->title,
                    $request->input('url'),
                    $request->input('duration'),
                    $media->description,
                    $media->id_media,
                    null,
                    $id_episode
                );
                $media->episodes()->save($episode);
                DB::commit();
                return redirect()->route('admin.movieList')->with('success', '¡Movie is ' . $accion . ' successfully!');
            } else {
                DB::commit();
                return redirect()->route('admin.serieList')->with('success', '¡Serie is ' . $accion . ' successfully!');
            }
        } catch (\Exception $e) {
            // Si hay algún error, revierte la transacción
            DB::rollBack();

            // throw $e;
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function seed()
    {

        Media::factory()->count(10)->create();

        return redirect()->route('login');
    }


    public function getMediaListWithGenre(Request $request, $id = null)
    {
        $currentPath = $request->path();

        $isSerie = false;
        if (str_contains($currentPath, 'series')) {

            $isSerie = true;
        }
        $genresController = app()->make(GenresController::class);
        $genres = $genresController->getAllGenres();



        $medias = $this->getMedias($isSerie, $id);

        return view('movies', ['genres' => $genres, 'medias' => $medias]);
    }
    //Search movies
    public function search(Request $request)
    {
        // Obtén el término de búsqueda del formulario
        $searchTerm = $request->input('query');

        // Convierte el término de búsqueda a minúsculas para que la búsqueda no sea sensible a mayúsculas y minúsculas
        $searchTermLower = strtolower($searchTerm);

        // Realiza la consulta para buscar medias que coincidan con el término de búsqueda
        $medias = Media::with(['actors', 'genres', 'director', 'country', 'episodes'])
            ->where(function ($query) use ($searchTermLower) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('actors', function ($query) use ($searchTermLower) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTermLower . '%']);
                    })
                    ->orWhereHas('genres', function ($query) use ($searchTermLower) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTermLower . '%']);
                    })
                    ->orWhereHas('director', function ($query) use ($searchTermLower) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
            })
            ->get();

        // Devuelve los resultados de la búsqueda a la vista
        return view('search_results', ['medias' => $medias, 'query' => $searchTerm]);
    }

    public function addToFavorites(Media $media)
    {
        // Asegúrate de que el usuario esté autenticado
        if (auth()->check()) {
            // Obtén el usuario autenticado
            $user = auth()->user();

            // Verifica si el medio ya está en favoritos del usuario
            if (!$media->favorites()->where('id_user', $user->id_user)->exists()) {
                // Crea una nueva instancia de Favorite y guarda la relación
                $favorite = new Favorite();
                $favorite->id_user = $user->id_user;
                $media->favorites()->save($favorite);
            }
        }

        // Redirige de vuelta a la página de detalles
        return redirect()->back()->with('success', 'Media added to favorites!');
    }
    public function favorites()
    {
        // Obtén todas las películas favoritas del usuario actual
        // $favorites = Auth::user()->favorites()->with('actors', 'genres', 'director', 'country', 'episodes')->get();
        $favorites = Auth::user();
        dd($favorites->favorites);

        // Devuelve la vista con las películas favoritas
        return view('favorites', ['favorites' => $favorites]);
    }
    public function showEpisode($id_serie, $seasonNumber, $id_episode)
    {
        $episode = Episode::findOrFail($id_episode);
        dd($episode);
        return view('episodes.show', compact('episode'));
    }
}
