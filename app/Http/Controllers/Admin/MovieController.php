<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMovieRequest;
use App\Services\MovieSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\{Tag, Genre, Comment, Movie};
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function edit(Movie $movie): View
    {
        $genres = Genre::all();
        $tags = Tag::all();
        return view('admin.edit-movie', compact('movie', 'tags', 'genres'));
    }

    public function update(UpdateMovieRequest $request, Movie $movie): RedirectResponse
    {
        try {
            $movie->update([
                'title' => $request->title,
                'release_date' => $request->year,
                'runtime' => $request->runtime,
                'lang' => $request->language,
                'is_public' => $request->is_public,
                'slug' => Str::slug($request->title),
                'rating' => $request->rating,
                'poster_path' => $request->poster_path,
                'backdrop_path' => $request->backdrop_path,
                'overview' => $request->overview,
                'country' => $request->country,
                'source' => $request->source,
                'meta' => $request->meta,
            ]);
            $syncTags = new MovieSyncService();
            $syncTags->syncTags($movie, $request->tags);
            $syncTags->syncGenres($movie, $request->genres);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Film Güncellenemedi');
        }
        return redirect()->back()->with('status', 'Film Güncellendi');

    }

    public function commentsIndex(): View
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.comments', compact('comments'));
    }
}
