<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Tag;
use App\Models\Genre;
use App\Models\Comment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function MongoDB\BSON\toJSON;

class MovieController extends Controller
{
    public function edit ($id)
    {
        $genres = Genre::all();
        $tags = Tag::all();
        $movie = Movie::find($id);
        return view('admin.edit-movie', compact('movie', 'tags', 'genres'));
    }

    public function update (Request $request, $id)
    {
        $movie = Movie::findorFail($id);
        $movie->title = $request->title;
        $movie->release_date = $request->year;
        $movie->runtime = $request->runtime;
        $movie->lang = $request->language;
        $movie->is_public = $request->status;
        $movie->slug = Str::slug($request->title);
        $movie->rating = $request->rating;
        $movie->poster_path = $request->poster;
        $movie->backdrop_path = $request->backdrop;
        $movie->overview = $request->overview;
        $movie->country = $request->country;
        $movie->source = $request->source;
        $movie->meta = $request->meta;
        $movie->save();
        $movie->tags()->sync($request->tags);

//        $movie->genres()->sync($request->genres);

        if ($movie) {
            return redirect()->back()->with('status', 'Film Güncellendi');
        } else {
            return redirect()->back()->with('error', 'Film Güncellenemedi');
        }

    }

    public function commentsIndex ()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.comments', compact('comments'));
    }
}
