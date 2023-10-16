<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $name, $slug, $tag_id;
    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->tag_id = NULL;
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function storeTag()
    {
        $validatedData = $this->validate([
            'name' => 'unique:App\Models\Tag,tag_name|required|string',
            'slug' => 'string|nullable',
        ]);
        if (strlen($this->slug)>3) {
            $slug=Str::slug($this->slug);
        } else {
            $slug=Str::slug($this->name);
        }
        Tag::create([
            'tag_name' => $this->name,
            'slug' => $slug,
        ]);
        session()->flash('status', 'Etiket eklendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editTag(int $tag_id)
    {
        $this->tag_id = $tag_id;
        $tag = Tag::findOrFail($tag_id);
        $this->name = $tag->tag_name;
        $this->slug = $tag->slug;
    }

    public function updateTag()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'slug' => 'string|nullable',
        ]);
        if (strlen($this->slug)>3) {
            $slug=Str::slug($this->slug);
        } else {
            $slug=Str::slug($this->name);
        }
        $allTags = Tag::get('tag_name');
        $name = $this->name;
        if ($allTags->contains('tag_name', $this->name)) {
            $name = $name.' 2';
            }
        else {
            $name = $this->name;
        }
        Tag::findOrFail($this->tag_id)->update([
            'tag_name' => $name,
            'slug' => $slug,
        ]);
        session()->flash('status', 'Etiket güncellendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteTag($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function destroyTag()
    {
        Tag::findOrFail($this->tag_id)->delete();
        session()->flash('status', 'Etiket silindi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function resetFilters ()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }

    public function render()
    {
        $tags = Tag::search('tag_name', $this->search)->orderBy('tag_name',$this->sort)->paginate($this->perPage);
        return view('livewire.admin.tag.index', ['tags' => $tags])
            ->extends('layouts.admin')
            ->section('content');
    }
}
