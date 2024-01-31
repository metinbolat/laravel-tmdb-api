<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Trailer;
use App\Models\Setting;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function movies (): View
    {
        $genres = Genre::all();
        $title = "Tüm Filmler";
        $movies = Movie::where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', [
            'movies' => $movies,
            'title' => $title,
            'genres' => $genres,
        ]);
    }

    public function show (Movie $movie, $slug, Trailer $trailer): View
    {

        $movie = Movie::whereSlug($slug)->first();

        $relatedMovies = Movie::whereHas('genres', function ($q) use ($movie) {
            return $q->whereIn('name', $movie->genres->pluck('name'));
        })
            ->where('id', '!=', $movie->id)->where('is_public', 1)
            ->get();
        $movie->increment('visits');

            if (!$movie || !$movie->is_public == 1){
                abort(404);
            }
        return view('front.show', [
            'movie' => $movie,
            'relatedMovies' => $relatedMovies,
            ]);
    }

    public function favoriteMovies_index ()
    {
        $genres = Genre::all();
        $title = 'En Çok İzlenen Filmler';
        $movies = Movie::where('is_public', 1)->orderBy('visits', 'desc')->paginate(6);
        return view('front.movies', [
            'movies' => $movies,
            'title' =>$title,
            'genres' => $genres]);
    }

}
