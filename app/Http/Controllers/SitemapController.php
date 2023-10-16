<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $movies = Movie::where('is_public', 1)->first();
        $genres = Genre::where('status', '1')->first();
        $tags = Tag::all()->first();
        $casts = Cast::all()->first();

        return response()->view('front.sitemap.index', [
            'movies' => $movies,
            'genres' => $genres,
            'casts' => $casts,
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function movies()
    {
        $movies = Movie::where('is_public', 1)->latest()->get();
        return response()->view('front.sitemap.movies', [
            'movies' => $movies,
        ])->header('Content-Type', 'text/xml');
    }

    public function genres()
    {
        $genres = Genre::all();
        return response()->view('front.sitemap.genres', [
            'genres' => $genres,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->view('front.sitemap.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function casts()
    {
        $casts = Cast::all();
        return response()->view('front.sitemap.casts', [
            'casts' => $casts,
        ])->header('Content-Type', 'text/xml');
    }
}
