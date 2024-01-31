<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Comment;
use Carbon\Carbon;

class Comments extends Component
{
    public $movie, $comment, $name, $comment_body, $comments, $reply = '';


    public function commentStore ()
    {
        $date = Carbon::now();
        $movie = $this->movie;
        $this->validate([
            'comment_body' => 'required',
        ]);
        $userId = auth()->id();

        if (auth()->user()) {
            $userName = auth()->user->name;
            $status = 1;

        } else {
            $userName = $this->name;
            $status = siteInfo()->comment_approval;
        }
        $comment = Comment::create([
            'comment' => $this->comment_body,
            'movie_id' => $movie->id,
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

    public function replyStore ($comment_id)
    {
        $findComment = Comment::findOrFail($comment_id);
        $movie = $this->movie;
        //dd($comment);
        $date = Carbon::now();
        $validatedReply = $this->validate([
            'reply' => 'required',
        ]);
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $userName = auth()->user()->name;
            $status = 1;

        } else {
            $userName = $this->name;
            $status = siteInfo()->comment_approval;
        }
        $comment = Comment::create([
            'comment' => $validatedReply['reply'],
            'parent_id' => $findComment->id,
            'movie_id' => $movie->id,
            'user_id' => $userId,
            'user_name' => $userName,
            'is_public' => $status,
        ]);
        $this->comments = $movie->comments()->with('replies')->where('is_public', 1)->latest()->get();
        if ($comment){
            session()->flash('comment_success', 'Yorum eklendi.');
        } else {
            session()->flash('comment_error','Yorumunuz kaydedilirken bir hata oluştu!');
        }
        $this->reset('reply');
    }

    public function mount ($movie)
    {
        $this->comments = $movie->comments()->with('replies')->where('is_public', 1)->latest()->get();
    }

    public function render()
    {
        return view('livewire.front.comments');
    }
}
