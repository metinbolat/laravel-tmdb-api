<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Trailer;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function movies ()
    {
        $genres = Genre::all();
        $settings = Setting::find(1);
        $title = "Tüm Filmler";
        $movies = Movie::where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', compact('movies', 'title', 'settings', 'genres'));
    }

    public function show (Movie $movie, $slug, Trailer $trailer)
    {
        $settings = Setting::find(1);
        $movie = Movie::whereSlug($slug)->first();
        $comments = $movie->comments()->where('is_public',1)->orderBy('created_at','desc')->paginate(6);

        $relatedMovies = Movie::whereHas('genres', function ($q) use ($movie) {
            return $q->whereIn('name', $movie->genres->pluck('name'));
        })
            ->where('id', '!=', $movie->id)->where('is_public', 1)
            ->get();
        $movie->increment('visits');

            if ($movie && $movie->is_public == 1){
                return view('front.show', compact('movie', 'settings', 'relatedMovies'));
            } else {
                abort(404);
            }
    }

    public function favoriteMovies_index ()
    {
        $genres = Genre::all();
        $title = 'En Çok İzlenen Filmler';
        $movies = Movie::where('is_public', 1)->orderBy('visits', 'desc')->paginate(6);
        return view('front.movies', compact('movies', 'title', 'genres'));
    }

    public function comment_store ($id, Request $request)
    {
        $date = Carbon::now();
        $movie = Movie::findorFail($id);
        $this->validate($request, [
            'comment' => 'required',
        ]);
        $userId = auth()->id();

        if (\Auth::user()) {
            $userName = auth()->user()->name;
            $status = 1;

        } else {
            $userName = $request->name;
            $status = siteInfo()->comment_approval;
        }
        $comment = Comment::insert([
            'comment' => $request->comment,
            'movie_id' => $movie->id,
            'user_id' => $userId,
            'user_name' => $userName,
            'is_public' => $status,
            'created_at' => $date,
        ]);
        if ($comment){
            return redirect()->back()->with('comment_success','Yorumunuz kaydedildi!');
        } else {
            return redirect()->back()->with('comment_error','Yorumunuz kaydedilirken bir hata oluştu!');
        }
    }

    public function reply_store ($id, Request $request)
    {
        $comment = Comment::findOrFail($id);
        $movie = $comment->movie->id;
        //dd($comment);
        $date = Carbon::now();
        $this->validate($request, [
            'reply' => 'required',
        ]);
        $userId = auth()->id();

        if (\Auth::user()) {
            $userName = auth()->user()->name;
            $status = 1;

        } else {
            $userName = $request->name;
            $status = siteInfo()->comment_approval;
        }
        $comment = Comment::insert([
            'comment' => $request->reply,
            'parent_id' => $comment->id,
            'movie_id' => $movie,
            'user_id' => $userId,
            'user_name' => $userName,
            'is_public' => $status,
            'created_at' => $date,
        ]);
        if ($comment){
            return redirect()->back()->with('comment_success','Yorumunuz kaydedildi!');
        } else {
            return redirect()->back()->with('comment_error','Yorumunuz kaydedilirken bir hata oluştu!');
        }
    }
}
