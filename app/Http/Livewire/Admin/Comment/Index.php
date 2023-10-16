<?php

namespace App\Http\Livewire\Admin\Comment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;

class Index extends Component
{
    use WithPagination;
    public $checked = [];
    public $selectAll = false;
    public $selectAllDB = false;
    public $bulkUpdate = 'display:none';
    public $searchResults = [];
    public $search = '';
    //public $sort = 'asc';
    public $sortColumn = 'comment';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $status;


    protected $paginationTheme = "bootstrap";

    protected $rules = [
        'title' => 'required',
        'runtime' => 'required',
        'slug' => 'required',
        'language' => 'required',
        'format' => 'required',
        'rating' => 'required',
        'poster' => 'required',
        'backdrop' => 'required',
        'overview' => 'required',
        'meta' => 'required',
    ];

    public function bulkUpdate()
    {
        $this->bulkUpdate = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->comments->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
        $this->bulkUpdate = 'display:none';
    }

    public function updatedChecked()
    {
        $this->selectAll = false;
    }

    public function selectAllDB ()
    {
        $this->selectAllDB = true;
        $this->checked = $this->commentsQuery->pluck('id')->map(fn($item) => (string) $item)->toArray();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function editComment(int $comment_id)
    {

        $this->comment_id = $comment_id;
        $comment = Comment::findOrFail($comment_id);
        $this->comment = Comment::findOrFail($comment_id);
        $this->title = $comment->title;
        $this->slug = $comment->slug;
        $this->runtime = $comment->runtime;
        $this->language = $comment->lang;
        $this->format = $comment->video_format;
        $this->rating = $comment->rating;
        $this->poster = $comment->poster_path;
        $this->backdrop = $comment->backdrop_path;
        $this->overview = $comment->overview;
        $this->status = $comment->is_public;
        $this->meta = $comment->meta;
    }

    public function updateComment()
    {
        $this->validate();

//        if (strlen($this->slug)>3) {
//            $slug=Str::slug($this->slug);
//        } else {
//            $slug=Str::slug($this->name);
//        }

        Comment::findOrFail($this->comment_id)->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'runtime' => $this->runtime,
            'rating' => $this->rating,
            'lang' => $this->language,
            'video_format' => $this->format,
            'is_public' => $this->status,
            'overview' => $this->overview,
            'poster_path' => $this->poster,
            'backdrop_path' => $this->backdrop,
            'meta' => $this->meta,
        ]);
        session()->flash('status', 'Film güncellendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteComment($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    public function destroyComments()
    {
        Comment::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function updateComments()
    {
        //dd($this->status);
        $validatedData = $this->validate([
            'status' => 'required'
        ]);
        Comment::whereKey($this->checked)->update(
            ['is_public' => $this->status]
        );
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function destroyComment($comment_id)
    {
        Comment::findOrFail($comment_id)->delete();
        //$this->resetInput();
        $this->checked = array_diff($this->checked, [$comment_id]);
        session()->flash('status', 'Film silindi.');
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn = $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }

    public function resetFilters ()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }

    public function getCommentsProperty()
    {
        return $this->commentsQuery->paginate($this->perPage);
    }

    public function getCommentsQueryProperty()
    {
        return Comment::search('comment', $this->search)->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function render()
    {
        // $commentsAll = Comment::search('title', $this->search)->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.admin.comment.index', ['comments' => $this->comments])
            ->extends('layouts.admin')
            ->section('content');
    }

    public function isChecked($comment_id)
    {
        return in_array($comment_id, $this->checked);
    }
}
