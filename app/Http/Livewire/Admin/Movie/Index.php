<?php

namespace App\Http\Livewire\Admin\Movie;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Trailer;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\returnArgument;

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
    public $sortColumn = 'title';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $title, $runtime, $lang, $videoFormat, $rating, $posterPath,
        $backdropPath, $overview, $status, $movieTMDB, $movie_id,
        $trailerId, $trailerName, $embedHtml, $movie, $resultId, $meta;
    public $seriesTMDB, $seriesId, $searchSeries;

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
            $this->checked = $this->movies->pluck('id')->map(fn($item) => (string) $item)->toArray();
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
        $this->checked = $this->moviesQuery->pluck('id')->map(fn($item) => (string) $item)->toArray();
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

            $searchResults = Http::get(config('services.tmdb.endpoint').'search/movie'. '?api_key='.
                config('services.tmdb.api').'&query='.$this->movieTMDB.'&language='.config('services.tmdb.lang'))
                ->json()['results'];
            $this->searchResults = $searchResults;

        return $this->searchResults;
    }

    public function searchResultsSeries()
    {
        $validateData = $this->validate([
            'seriesTMDB' => 'required|min:3'
        ]);

        $searchSeries = Http::get(config('services.tmdb.endpoint').'tv/'.$this->seriesTMDB. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang'))
            ->json();
        $searchResults = $searchSeries['seasons'];
        $this->searchResults = $searchResults;
dd(count($searchSeries['seasons']));
        return $this->searchResults;
    }

    public function changeLocale($string)
    {
        $search = array('en', 'tr','AR','AU','AT','BE','BR','zh','CO','DK','fr','de','IN','it','ja','MX','NL','ru','es','TH','uk','ko','SE','NZ','bg','
        ar','BY','CH','CZ','FI','HK','HU','IE','IR','KH','LB','LT','LU','MA','MM','MW','NO','NZ','PE','PH','pl','pt','RO','SU','TW','ZA');
        $replace = array('İngilizce', 'Türkçe','Arjantin','Avustralya','Avusturya','Belçika','Brezilya','Çince','Kolombiya','Danimarka','Fransızca',
            'Almanca','Hindistan','İtalyanca','Japonca','Meksika','Hollanda','Rusça','İspanyolca','Tayland','Ukraynaca','Korece','İsveç','Yeni Zelanda','Bulgarca',
            'Arapça','Beyaz Rusya','İsviçre','Çek Cumhuriyeti','Finlandiya','Hong Kong','Macaristan','İrlanda','İran','Kamboçya',
            'Lübnan','Litvanya','Lüksemburg','Fas','Burma','Malavi','Norveç','Yeni Zelanda','Peru','Filipinler','Lehçe','Portekizce','Romanya','Sovyetler Birliği',
            'Tayvan','Zambiya');

        return Str::replace($search, $replace, $string);
    }

    public function changeCountry($string)
    {
        $search = array('US', 'GB', 'TR', 'CA','AR','AU','AT','BE','BR','CN','CO','DK','FR','DE','IN','IT','JP','MX','NL','RU','ES','TH','UA','KR','SE','NZ','BG','AE',
        'BG','BY','CH','CZ','FI','HK','HU','IE','IR','KH','LB','LT','LU','MA','MM','MW','NO','NZ','PE','PH','PL','PT','RO','SU','TW','ZA');
        $replace = array('ABD', 'İngiltere', 'Türkiye', 'Kanada','Arjantin','Avustralya','Avusturya','Belçika','Brezilya','Çin','Kolombiya','Danimarka','Fransa',
        'Almanya','Hindistan','İtalya','Japonya','Meksika','Hollanda','Rusya','İspanya','Tayland','Ukrayna','Güney Kore','İsveç','Yeni Zelanda','Bulgaristan',
        'Birleşik Arap Emirlikleri','Bulgaristan','Beyaz Rusya','İsviçre','Çek Cumhuriyeti','Finlandiya','Hong Kong','Macaristan','İrlanda','İran','Kamboçya',
        'Lübnan','Litvanya','Lüksemburg','Fas','Burma','Malavi','Norveç','Yeni Zelanda','Peru','Filipinler','Polonya','Portekiz','Romanya','Sovyetler Birliği',
        'Tayvan','Zambiya');

        return Str::replace($search, $replace, $string);
    }

    public function getSeries($seriesId)
    {
        $series = config('services.tmdb.endpoint').'tv/'.$seriesId. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
        $apiSeries = Http::get($series);
        $newSeries = $apiSeries->json();
        dd($newSeries['seasons']);
    }

    public function generateMovie($resultId)
    {
        $movie = Movie::where('tmdb_id', $resultId)->exists();
        if ($movie){
            return session()->flash('error', 'Film, zaten sitenizde mevcut.');
        }

        $url = config('services.tmdb.endpoint').'movie/'.$resultId. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
        $credits = config('services.tmdb.endpoint').'movie/'.$resultId.'/credits'. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//        $cast = config('services.tmdb.endpoint').'movie/'.$this->movieTMDBId.'/credits'. '?api_key='.
//            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//        $apiCast = Http::get($cast);
//        $newCast = $apiCast->json();
        $apiMovie = Http::get($url);
        $apiCredits = Http::get($credits);

        if ($apiMovie->successful()) {
            $newMovie = $apiMovie->json();
            $locale = $this->changeCountry($newMovie['production_countries'][0]['iso_3166_1']);
            $lang = $this->changeLocale($newMovie['original_language']);
            $date = strtotime($newMovie['release_date']);
            $getDate = getDate($date);
            $year = $getDate['year'];
            //dd($getDate['year']);

            $created_movie = Movie::create([
                'tmdb_id' => $newMovie['id'],
                'title' => $newMovie['title'].' izle',
                'slug' => Str::slug($newMovie['title']. ' izle'),
                'release_date' => $year,
                'runtime' => $newMovie['runtime'],
                'rating' => $newMovie['vote_average'],
                'lang' => $lang,
                'video_format' => 'HD',
                'is_public' => false,
                'overview' => $newMovie['overview'],
                'country' => $locale,
                'poster_path' => $newMovie['poster_path'],
                'backdrop_path' => $newMovie['backdrop_path'],
                'meta' => $newMovie['title'].' izle '. 'filmini HD izleyebilir ve ayrıca ücretsiz ve online ' .$newMovie['title'].' izle '. 'filmine erişebilir ve keyfini sürebilirsiniz.'
            ]);

            $newCast = $apiCredits->json();
            //$arrayCast = $newCast['cast'];
            $cast = array();
            for($i=0;$i<5 ; $i++)
            {
                $cast[$i] = $newCast['cast'][$i];
                $checkCast = Cast::get('tmdb_id');

                if (!$checkCast->contains('tmdb_id', $cast[$i]['id'])){
                    $addCast = $created_movie->casts()->create([
                        'tmdb_id' => $cast[$i]['id'],
                        'name' => $cast[$i]['name'],
                        'slug' => Str::slug($cast[$i]['name']),
                        'poster_path' => $cast[$i]['profile_path'],
                    ]);
                }
            }

            $genreCount = count($newMovie['genres']);
            for($i=0;$i<$genreCount ; $i++)
            {
                $genre[$i] = $newMovie['genres'][$i];
                $checkGenre = Genre::get('tmdb_id');

                if (!$checkGenre->contains('tmdb_id', $genre[$i]['id'])){
                    $addGenre = $created_movie->genres()->create([
                        'tmdb_id' => $genre[$i]['id'],
                        'name' => $genre[$i]['name'],
                        'slug' => Str::slug($genre[$i]['name']),
                    ]);
                }
            }

//            $movie_genres = $newMovie['genres'];
//            //dd($newMovie['genres']);
//            $tmdb_genre_ids = collect($movie_genres)->pluck('id');
//            $genres = Genre::whereIn('tmdb_id', $tmdb_genre_ids)->get();
//            $created_movie->genres()->attach($genres);
//            $movie_casts = $newCast['cast'];
//            $tmdb_cast_ids = collect($movie_casts)->pluck('id');
//            $casts = Cast::whereIn('tmdb_id', $tmdb_cast_ids)->get();
//            $created_movie->casts()->attach($casts);
            $this->reset('resultId');
            session()->flash('bot-status', 'Film eklendi.');
        } else {
            session()->flash('bot-error', 'Film, TMDB veritabanında bulunamadı.');
            $this->reset('result');
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

    public function editMovie(int $movie_id)
    {

        $this->movie_id = $movie_id;
        $movie = Movie::findOrFail($movie_id);
        $this->movie = Movie::findOrFail($movie_id);
        $this->title = $movie->title;
        $this->slug = $movie->slug;
        $this->runtime = $movie->runtime;
        $this->language = $movie->lang;
        $this->format = $movie->video_format;
        $this->rating = $movie->rating;
        $this->poster = $movie->poster_path;
        $this->backdrop = $movie->backdrop_path;
        $this->overview = $movie->overview;
        $this->status = $movie->is_public;
        $this->meta = $movie->meta;
    }

    public function updateMovie()
    {
        $this->validate();

//        if (strlen($this->slug)>3) {
//            $slug=Str::slug($this->slug);
//        } else {
//            $slug=Str::slug($this->name);
//        }

        Movie::findOrFail($this->movie_id)->update([
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

    public function resetFilters ()
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
