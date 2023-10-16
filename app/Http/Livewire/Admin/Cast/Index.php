<?php

namespace App\Http\Livewire\Admin\Cast;

use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $castTMDBId;
    public $name;
    public $tmdb_id;
    public $slug;
    public $cast_id;
    public $poster;
    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->poster = NULL;
        $this->cast_id = NULL;
        $this->tmdb_id = NULL;
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function generateCast()
    {
        $validatedData = $this->validate([
            'tmdb_id'=> 'required|integer'
        ]);
        $newCast = Http::asJson()
            ->get(config('services.tmdb.endpoint').'person/'.$this->castTMDBId. '?api_key='.
                config('services.tmdb.api').'&language='.config('services.tmdb.lang'));
        $cast = Cast::where('tmdb_id', $newCast['id'])->first();
        if (!$cast) {
            Cast::create([
                'tmdb_id' => $newCast['id'],
                'name' => $newCast['name'],
                'slug' => Str::slug($newCast['name']),
                'poster_path' => $newCast['profile_path'],
            ]);
            session()->flash('status', 'Oyuncu eklendi.');
        } else {
            session()->flash('error', 'Oyuncu zaten mevcut.');
        }

    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editCast(int $cast_id)
    {
        $this->cast_id = $cast_id;
        $cast = Cast::findOrFail($cast_id);
        $this->name = $cast->name;
        $this->slug = $cast->slug;
        $this->poster = $cast->poster_path;
    }

    public function updateCast()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'slug' => 'string|nullable',
            'poster' => 'string|required',
        ]);
        if (strlen($this->slug)>3) {
            $slug=Str::slug($this->slug);
        } else {
            $slug=Str::slug($this->name);
        }
        Cast::findOrFail($this->cast_id)->update([
            'name' => $this->name,
            'slug' => $slug,
            'poster_path' => $this->poster,
        ]);
        session()->flash('status', 'Oyuncu güncellendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteCast($cast_id)
    {
        $this->cast_id = $cast_id;
    }

    public function destroyCast()
    {
        Cast::findOrFail($this->cast_id)->delete();
        session()->flash('status', 'Oyuncu silindi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function resetFilters ()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }

    public function render()
    {
        $casts = Cast::search('name', $this->search)->orderBy('name',$this->sort)->paginate($this->perPage);
        return view('livewire.admin.cast.index', ['casts' => $casts])
            ->extends('layouts.admin')
            ->section('content');
    }
}
