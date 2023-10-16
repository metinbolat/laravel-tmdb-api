<?php

namespace App\Http\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;

class TvshowTag extends Component
{

    public $queryTag = '';
    public $tvshow;
    public $tags = [];

    public function mount($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function updatedQueryTag()
    {
        $this->tags = Tag::search('tag_name', $this->queryTag)->get();
    }

    public function addTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $this->tvshow->tags()->attach($tag);
        $this->reset();
        session()->flash('status', 'Filme etiket eklendi.');
    }

    public function render()
    {
        return view('livewire.admin.tag.tvshow-tag');
    }
}
