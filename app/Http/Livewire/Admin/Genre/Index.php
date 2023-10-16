<?php

namespace App\Http\Livewire\Admin\Genre;


use App\Models\Genre;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $name, $slug, $status, $genre_id, $tmdb_id, $genreTMDBId, $getGenres;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    public function resetInput()
    {
    $this->name = NULL;
    $this->slug = NULL;
    $this->status = NULL;
    $this->genre_id = NULL;
    $this->tmdb_id;
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

//    public function getGenres ()
//    {
//        $url = config('services.tmdb.endpoint').'genre/list'. '?api_key='.
//           config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//        $apiGenres = Http::get($url);
//        $getGenres = $apiGenres->json();
//        return $getGenres;
//    }

    public function storeGenre()
    {
//        $url = config('services.tmdb.endpoint').'genre/list'. '?api_key='.
//            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//        $urlJson = Http::get($url)->json();
//        $array = array($urlJson['genres']);
//        $collapse = Arr::collapse($array);
//        dd($collapse);
//
//        for($i=0;$i<count($urlJson['genres']) ; $i++)
//        {
////            $urlJson['genres'][$i]['name'] = str_replace('-',' ',$json['genres'][$i]['name']);
//            dump($urlJson['genres'][$i]['id']);
//        }
//        dd($urlJson['genres']);
        $validatedData = $this->validate([
            'name' => 'unique:App\Models\Genre,name|required|string',
            'slug' => 'string|nullable',
            'status' => 'nullable'
        ]);
        if (strlen($this->slug)>3) {
            $slug=Str::slug($this->slug);
        } else {
            $slug=Str::slug($this->name);
        }
    Genre::create([
        'name' => $this->name,
        'slug' => $slug,
        'status' => $this->status == true ? '1' : '0'
    ]);
    session()->flash('status', 'Kategori eklendi.');
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

    public function editGenre(int $genre_id)
    {
        $this->genre_id = $genre_id;
        $genre = Genre::findOrFail($genre_id);
        $this->name = $genre->name;
        $this->slug = $genre->slug;
        $this->status = $genre->status;
    }

    public function updateGenre()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'slug' => 'string|nullable',
            'status' => 'nullable'
        ]);
        if (strlen($this->slug)>3) {
            $slug=Str::slug($this->slug);
        } else {
            $slug=Str::slug($this->name);
        }
        Genre::findOrFail($this->genre_id)->update([
            'name' => $this->name,
            'slug' => $slug,
            'status' => $this->status == true ? '1' : '0'
        ]);
        session()->flash('status', 'Kategori güncellendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteGenre($genre_id)
    {
        $this->genre_id = $genre_id;
    }

    public function destroyGenre()
    {
        Genre::findOrFail($this->genre_id)->delete();
        session()->flash('status', 'Kategori silindi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function resetFilters ()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }

    public function render()
    {
        $genres = Genre::search('name', $this->search)->orderBy('name',$this->sort)->paginate($this->perPage);
        return view('livewire.admin.genre.index', ['genres' => $genres])
            ->extends('layouts.admin')
            ->section('content');
    }
}
