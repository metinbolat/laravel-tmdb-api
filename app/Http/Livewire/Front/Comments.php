<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Movie;
use Carbon\Carbon;

class Comments extends Component
{
    public $movie, $comment, $name, $comment_body, $movie_id, $findMovie, $comments, $reply, $comment_id;



    public function commentStore ()
    {
        $date = Carbon::now();
        $movie = $this->movie;
        $findMovie = Movie::findorFail($movie->id);
        $this->validate([
            'comment_body' => 'required',
        ]);
        $userId = auth()->id();

        if (\Auth::user()) {
            $userName = auth()->user()->name;
            $status = 1;

        } else {
            $userName = $this->name;
            $status = siteInfo()->comment_approval;
        }
        $comment = Comment::create([
            'comment' => $this->comment_body,
            'movie_id' => $findMovie->id,
            'user_id' => $userId,
            'user_name' => $userName,
            'is_public' => $status,
            'created_at' => $date,
        ]);
        $this->comments->prepend($comment);
        $this->reset('name', 'comment_body');
        if ($comment){
            session()->flash('comment_success', 'Yorum eklendi.');
        } else {
            session()->flash('comment_error','Yorumunuz kaydedilirken bir hata oluştu!');
        }
    }

    public function replyStore (int $comment_id)
    {
        $movie = $this->movie;
        $this->comment_id = $comment_id;
        dd($comment_id);
        $findComment = Comment::findOrFail($comment->id);
        $movie = $comment->movie->id;
        //dd($comment);
        $date = Carbon::now();
        $this->validate([
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
            'comment' => $this->reply,
            'parent_id' => $findComment->id,
            'movie_id' => $movie,
            'user_id' => $userId,
            'user_name' => $userName,
            'is_public' => $status,
            'created_at' => $date,
        ]);
        if ($comment){
            session()->flash('comment_success', 'Yorum eklendi.');
        } else {
            session()->flash('comment_error','Yorumunuz kaydedilirken bir hata oluştu!');
        }
    }

    public function mount ($movie)
    {
        $comments = Comment::where('is_public', 1)->latest()->get();
        //$comments = $movie->comments->where('is_public', 1)->orderBy('created_at', 'desc')->paginate(6);
        $replies = $movie->comments;
        $this->comments = $comments;
    }

    public function render()
    {
        $movie = $this->movie;


        return view('livewire.front.comments');
    }
}
