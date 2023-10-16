<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Season;
use App\Models\TvShow;
use App\Models\Setting;
use App\Models\Trailer;
use Illuminate\Http\Request;

class TvController extends Controller
{
    public function tvshows ()
    {
        $genres = Genre::all();
        $settings = Setting::find(1);
        $title = "Tüm Diziler";
        $tvshows = TvShow::where('is_public', 1)->orderBy('name', 'asc')->paginate(6);
        return view('front.tv-shows', compact('tvshows', 'title', 'settings', 'genres'));
    }

    public function show (TvShow $tvShow, $slug, Trailer $trailer)
    {
        $settings = Setting::find(1);
        $tv_show = TvShow::whereSlug($slug)->first();
        $genres = Genre::all();
//        $comments = $movie->comments()->where('is_public',1)->orderBy('created_at','desc')->paginate(6);

//        $relatedMovies = Movie::whereHas('genres', function ($q) use ($movie) {
//            return $q->whereIn('name', $movie->genres->pluck('name'));
//        })
//            ->where('id', '!=', $movie->id)->where('is_public', 1)
//            ->get();
//        $movie->increment('visits');

        $trailer = $tv_show->trailers()->first();

        if ($tv_show && $tv_show->is_public == 1){
            return view('front.show-tv', compact('tv_show', 'settings', 'genres', 'trailer'));
        } else {
            abort(404);
        }
    }

    public function episode ($slug, Trailer $trailer)
    {
        $settings = Setting::find(1);
        $episode = Episode::whereSlug($slug)->first();
        $season = $episode->season;
        $tv_show = $season->tvshow;
        $genres = Genre::all();
//        $comments = $movie->comments()->where('is_public',1)->orderBy('created_at','desc')->paginate(6);

//        $relatedMovies = Movie::whereHas('genres', function ($q) use ($movie) {
//            return $q->whereIn('name', $movie->genres->pluck('name'));
//        })
//            ->where('id', '!=', $movie->id)->where('is_public', 1)
//            ->get();
//        $movie->increment('visits');

        if ($episode && $episode->is_public == 1){
            return view('front.deneme-tv', compact('tv_show', 'settings', 'episode', 'genres'));
        } else {
            abort(404);
        }
    }
}
