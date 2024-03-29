<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;

class MovieTag extends Component
{
    public $queryTag = '';
    public $movie;
    public $tags = [];

    public function mount($movie)
    {
        $this->movie = $movie;
    }

    public function updatedQueryTag()
    {
        $this->tags = Tag::search('tag_name', $this->queryTag)->get();
    }

    public function addTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $this->movie->tags()->attach($tag);
        $this->reset();
        session()->flash('status', 'Filme etiket eklendi.');
    }

    public function render()
    {
        return view('livewire.admin.tag.movie-tag');
    }
}
