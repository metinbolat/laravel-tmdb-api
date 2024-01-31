<?php

namespace App\Http\Livewire\Admin\Movie;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\{Cast, Genre, Movie, Trailer};
use App\Services\StringProcessService;


class Index extends Component
{
    use WithPagination;

    public array $checked = [];
    public bool $selectAll = false;
    public bool $selectAllDB = false;
    public string $bulkUpdate = 'display:none';
    public array $searchResults = [];
    public string $search = '';
    //public $sort = 'asc';
    public string $sortColumn = 'title';
    public string $sortDirection = 'asc';
    public int $perPage = 10;
    public $movieTMDB, $movie, $resultId;

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
            $this->checked = $this->movies->pluck('id')->map(fn($item) => (string)$item)->toArray();
        } else {
            $this->checked = [];
        }
        $this->bulkUpdate = 'display:none';
    }

    public function updatedChecked()
    {
        $this->selectAll = false;
    }

    public function selectAllDB()
    {
        $this->selectAllDB = true;
        $this->checked = $this->moviesQuery->pluck('id')->map(fn($item) => (string)$item)->toArray();
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->poster = NULL;
        $this->movie_id = NULL;
        $this->movieTMDB = NULL;
        $this->trailerName = NULL;
        $this->trailerId = NULL;
        $this->embedHtml = NULL;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function searchResults()
    {
        $validateData = $this->validate([
            'movieTMDB' => 'required|min:3'
        ]);

        $searchResults = Http::get(config('services.tmdb.endpoint') . 'search/movie' . '?api_key=' .
            config('services.tmdb.api') . '&query=' . $validateData['movieTMDB'] . '&language=' . config('services.tmdb.lang'))
            ->json()['results'];

        $this->searchResults = $searchResults;

        return $this->searchResults;
    }

    public function generateMovie($resultId, StringProcessService $stringProcess)
    {
        $movie = Movie::where('tmdb_id', $resultId)->exists();
        if ($movie) {
            session()->flash('bot-error', 'Film, zaten sitenizde mevcut.');
            return;
        }

        $apiMovie = Http::get(config('services.tmdb.endpoint') . 'movie/' . $resultId . '?api_key=' .
            config('services.tmdb.api') . '&language=' . config('services.tmdb.lang'));
        $apiCredits = Http::get(config('services.tmdb.endpoint') . 'movie/' . $resultId . '/credits' . '?api_key=' .
            config('services.tmdb.api') . '&language=' . config('services.tmdb.lang'));

        if (!$apiMovie->successful()) {
            session()->flash('bot-error', 'Film, TMDB veritabanında bulunamadı.');
            $this->reset('result');
        }

        $newMovie = $apiMovie->json();

        //PROCESS DATA FROM API
        $locale = $stringProcess->changeCountry($newMovie['production_countries'][0]['iso_3166_1']);
        $lang = $stringProcess->changeLanguage($newMovie['original_language']);
        $getYear = getDate(strtotime($newMovie['release_date']))['year'];

        $created_movie = Movie::create([
            'tmdb_id' => $newMovie['id'],
            'title' => $newMovie['title'] . ' izle',
            'slug' => Str::slug($newMovie['title'] . ' izle'),
            'release_date' => $getYear,
            'runtime' => $newMovie['runtime'],
            'rating' => $newMovie['vote_average'],
            'lang' => $lang,
            'video_format' => 'HD',
            'is_public' => false,
            'overview' => $newMovie['overview'],
            'country' => $locale,
            'poster_path' => $newMovie['poster_path'],
            'backdrop_path' => $newMovie['backdrop_path'],
            'meta' => $newMovie['title'] . ' izle ' . 'filmini HD izleyebilir ve ayrıca ücretsiz ve online ' . $newMovie['title'] . ' izle ' . 'filmine erişebilir ve keyfini sürebilirsiniz.'
        ]);

        //GET FIRST 5 CAST FROM API
        $newCast = $apiCredits->json();
        $cast = array();
        for ($i = 0; $i < 5; $i++) {
            $cast[$i] = $newCast['cast'][$i];
            $checkCast = Cast::get('tmdb_id');

            if (!$checkCast->contains('tmdb_id', $cast[$i]['id'])) {
                $addCast = $created_movie->casts()->create([
                    'tmdb_id' => $cast[$i]['id'],
                    'name' => $cast[$i]['name'],
                    'slug' => Str::slug($cast[$i]['name']),
                    'poster_path' => $cast[$i]['profile_path'],
                ]);
            }
        }

        //GET MOVIE GENRES FROM API
        $genreCount = count($newMovie['genres']);
        for ($i = 0; $i < $genreCount; $i++) {
            $genre[$i] = $newMovie['genres'][$i];
            $checkGenre = Genre::get('tmdb_id');

            if (!$checkGenre->contains('tmdb_id', $genre[$i]['id'])) {
                $addGenre = $created_movie->genres()->create([
                    'tmdb_id' => $genre[$i]['id'],
                    'name' => $genre[$i]['name'],
                    'slug' => Str::slug($genre[$i]['name']),
                ]);
            }
        }
        //ATTACH GENRES AND CAST TO MOVIE
        $genres = Genre::whereIn('tmdb_id', collect($newMovie['genres'])->pluck('id'))->get();
        $created_movie->genres()->sync($genres);
        $casts = Cast::whereIn('tmdb_id', collect($newCast['cast'])->pluck('id'))->get();
        $created_movie->casts()->sync($casts);
        $this->reset('resultId');
        session()->flash('bot-status', 'Film eklendi.');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function showTrailer(int $movie_id)
    {
        $this->movie = Movie::findOrFail($movie_id);
    }

    public function addTrailer()
    {
        $validateData = $this->validate([
            'trailerName' => 'required|string',
            'embedHtml' => 'required|string',
        ]);
        $this->movie->trailers()->create([
            'name' => $this->trailerName,
            'embed_html' => $this->embedHtml
        ]);
        session()->flash('status', 'Fragman eklendi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteTrailer($trailerId)
    {
        $trailer = Trailer::findOrFail($trailerId);
        $trailer->delete();
        session()->flash('status', 'Fragman kaynağı silindi.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteMovie($movie_id)
    {
        $this->movie_id = $movie_id;
    }

    public function destroyMovies()
    {
        Movie::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function updateMovies()
    {
        //dd($this->status);
        $validatedData = $this->validate([
            'status' => 'required'
        ]);
        Movie::whereKey($this->checked)->update(
            ['is_public' => $this->status]
        );
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function destroyMovie($movie_id)
    {
        Movie::findOrFail($movie_id)->delete();
        //$this->resetInput();
        $this->checked = array_diff($this->checked, [$movie_id]);
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

    public function resetFilters()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }

    public function getMoviesProperty()
    {
        return $this->moviesQuery->paginate($this->perPage);
    }

    public function getMoviesQueryProperty()
    {
        return Movie::search('title', $this->search)->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function render()
    {
        // $moviesAll = Movie::search('title', $this->search)->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.admin.movie.index', ['movies' => $this->movies])
            ->extends('layouts.admin')
            ->section('content');
    }

    public function isChecked($movie_id)
    {
        return in_array($movie_id, $this->checked);
    }
}
