<?php

namespace App\Http\Livewire\Admin\TvShow;

use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use Livewire\Component;
use App\Models\Cast;
use App\Models\Genre;
use App\Models\Trailer;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\WithPagination;

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
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $name, $runtime, $lang, $videoFormat, $rating, $posterPath,
        $backdropPath, $overview, $status, $tvTMDB, $tvshow_id,
        $trailerId, $trailerName, $embedHtml, $tvshow, $resultId, $meta, $is_public;

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
            $this->checked = $this->tvshows->pluck('id')->map(fn($item) => (string) $item)->toArray();
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
        $this->checked = $this->tvshowsQuery->pluck('id')->map(fn($item) => (string) $item)->toArray();
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->poster = NULL;
        $this->tvshow_id = NULL;
        $this->tvshowTMDB = NULL;
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
            'tvTMDB' => 'required|min:3'
        ]);

        $searchResults = Http::get(config('services.tmdb.endpoint').'search/tv'. '?api_key='.
            config('services.tmdb.api').'&query='.$this->tvTMDB.'&language='.config('services.tmdb.lang'))
            ->json()['results'];
        $this->searchResults = $searchResults;

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

    public function changeStatus($string)
    {
        $search = array('Ended', 'Returning Series');
        $replace = array('Bitti', 'Devam ediyor');

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

    public function generateTvShow($resultId)
    {
        $tvshow = TvShow::where('tmdb_id', $resultId)->exists();
        if ($tvshow){
            return session()->flash('error', 'Dizi, zaten sitenizde mevcut.');
        }

        $url = config('services.tmdb.endpoint').'tv/'.$resultId. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
        $credits = config('services.tmdb.endpoint').'tv/'.$resultId.'/credits'. '?api_key='.
            config('services.tmdb.api').'&language='.config('services.tmdb.lang');

//        $cast = config('services.tmdb.endpoint').'tvshow/'.$resultId.'/credits'. '?api_key='.
//            config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//        $apiCast = Http::get($cast);
//        $newCast = $apiCast->json();
        $apiTvShow = Http::get($url);
        $apiCredits = Http::get($credits);

        $newTvShow = $apiTvShow->json();

//        dd($newTvShow);

        if ($apiTvShow->successful()) {
            $locale = $this->changeCountry($newTvShow['production_countries'][0]['iso_3166_1']);
            $lang = $this->changeLocale($newTvShow['original_language']);
            $date = strtotime($newTvShow['first_air_date']);
            $getDate = getDate($date);
            $year = $getDate['year'];
            $last_air_date = strtotime($newTvShow['last_air_date']);
            $getLADate = getDate($last_air_date);
            if ($newTvShow['status'] == 'Ended') {
                $LAyear = $getLADate['year'];
            } else {
                $LAyear = NULL;
            }

            $status = $this->changeStatus($newTvShow['status']);

            $created_tvshow = TvShow::create([
                'tmdb_id' => $newTvShow['id'],
                'name' => $newTvShow['original_name'].' izle',
                'slug' => Str::slug($newTvShow['original_name']. ' izle'),
                'first_aired' => $year,
                'last_aired' => $LAyear,
                'status' => $status,
                'lang' => $lang,
                'is_public' => false,
                'overview' => $newTvShow['overview'],
                'country' => $locale,
                'poster_path' => $newTvShow['poster_path'],
                'backdrop_path' => $newTvShow['backdrop_path'],
                'meta' => $newTvShow['name'].' izle '. 'dizisini HD izleyebilir ve ayrıca ücretsiz ve online ' .$newTvShow['name'].' izle '. 'dizisine erişebilir ve keyfini sürebilirsiniz.'
            ]);

            $newCast = $apiCredits->json();
            //$arrayCast = $newCast['cast'];
            $cast = array();
            for($i=0;$i<3 ; $i++)
            {
                $cast[$i] = $newCast['cast'][$i];
                $checkCast = Cast::get('tmdb_id');

                if (!$checkCast->contains('tmdb_id', $cast[$i]['id'])){
                    $addCast = $created_tvshow->casts()->create([
                        'tmdb_id' => $cast[$i]['id'],
                        'name' => $cast[$i]['name'],
                        'slug' => Str::slug($cast[$i]['name']),
                        'poster_path' => $cast[$i]['profile_path'],
                ]);
            }
            }

            $genreCount = count($newTvShow['genres']);
            for($i=0;$i<$genreCount ; $i++)
            {
                $genre[$i] = $newTvShow['genres'][$i];
                $checkGenre = Genre::get('tmdb_id');

                if (!$checkGenre->contains('tmdb_id', $genre[$i]['id'])){
                    $addGenre = $created_tvshow->genres()->create([
                        'tmdb_id' => $genre[$i]['id'],
                        'name' => $genre[$i]['name'],
                        'slug' => Str::slug($genre[$i]['name']),
                    ]);
                }
            }

//dd($created_tvshow->id);

            $seasons = array();
            $episodes = array();
            $countSeasons = $newTvShow['number_of_seasons'];

//            for($i=1;$i<=$countSeasons ; $i++)
//            {
////                $seasons[$i] = $newTvShow['seasons'][$i];
//                $season = config('services.tmdb.endpoint').'tv/'.$resultId.'/season/'.$i .'?api_key='.
//                    config('services.tmdb.api').'&language='.config('services.tmdb.lang');
//                $apiSeason = Http::get($season);
//                $newSeason = $apiSeason->json();
////                dd($newSeason);
//                $countEpisodes = count($newSeason['episodes']);
////            dd($countEpisodes);
//                $checkSeason = Season::get('tmdb_id');
//                if (!$checkSeason->contains('tmdb_id', $newSeason['id'])) {
//                    $addSeason = Season::create([
//                        'tmdb_id' => $newSeason['id'],
//                        'tv_show_id' => $created_tvshow->id,
//                        'name' => $newSeason['name'],
////                    'slug' => Str::slug($cast[$i]['name']),
//                        'season_number' => 'Sezon '.$newSeason['season_number'],
//                        'episodes_count' => $countEpisodes,
//                        'air_date' => $newSeason['air_date'],
//                        'status' => 'Durum',
//                        'is_public' => '0',
//                        'poster_path' => $newSeason['poster_path'],
//                        'overview' => $newSeason['overview'],
//                        'meta' => 'meta'
//                    ]);
//                }
//
//            }


            for($i=1;$i<=$countSeasons ; $i++)
            {
//                $seasons[$i] = $newTvShow['seasons'][$i];
                $season = config('services.tmdb.endpoint').'tv/'.$resultId.'/season/'.$i .'?api_key='.
                    config('services.tmdb.api').'&language='.config('services.tmdb.lang');
                $apiSeason = Http::get($season);
                $newSeason = $apiSeason->json();
//                dd($newSeason);
                $countEpisodes = count($newSeason['episodes']);
//            dd($countEpisodes);
                $checkSeason = Season::get('tmdb_id');
                if (!$checkSeason->contains('tmdb_id', $newSeason['id'])) {
                    $addSeason = Season::create([
                        'tmdb_id' => $newSeason['id'],
                        'tv_show_id' => $created_tvshow->id,
                        'name' => $newSeason['name'],
//                    'slug' => Str::slug($cast[$i]['name']),
                        'season_number' => $newSeason['season_number'],
                        'episodes_count' => $countEpisodes,
                        'air_date' => $newSeason['air_date'],
                        'status' => 'Durum',
                        'is_public' => '0',
                        'poster_path' => $newSeason['poster_path'],
                        'overview' => $newSeason['overview'],
                        'meta' => 'meta'
                    ]);
                }
                $episodesNumber = count($newSeason['episodes']);
                for($e=1;$e<=$episodesNumber ; $e++)
                {
                    $episode = config('services.tmdb.endpoint').'tv/'.$resultId.'/season/'.$i.'/episode/'.$e .'?api_key='.
                        config('services.tmdb.api').'&language='.config('services.tmdb.lang');
                    $apiEpisode = Http::get($episode);
                    $newEpisode = $apiEpisode->json();
                    $checkEpisode = Episode::get('tmdb_id');
                    $slug = Str::slug($newTvShow['name'] .' '. $newSeason['season_number']. '. sezon '. $newEpisode['episode_number']. '. bölüm izle');
                    if (!$checkEpisode->contains('tmdb_id', $newEpisode['id'])) {

                        $addEpisode = Episode::create([
                            'tmdb_id' => $newEpisode['id'],
                            'season_id' => $addSeason->id,
                            'name' => $newEpisode['name'],
                            'slug' => $slug,
                            'episode_number' => $newEpisode['episode_number'],
                            'air_date' => $newEpisode['air_date'],
                            'status' => 'Durum',
                            'is_public' => '0',
                            'still_path' => $newEpisode['still_path'],
                            'overview' => $newEpisode['overview'],
                            'meta' => 'meta'
                        ]);
                    }
                }
            }
            $this->reset('resultId');
            session()->flash('bot-status', 'Dizi eklendi.');
        } else {
            session()->flash('bot-error', 'Dizi, TMDB veritabanında bulunamadı.');
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

    public function showTrailer(int $tvshow_id)
    {
        $this->tvshow = TvShow::findOrFail($tvshow_id);
    }

    public function addTrailer()
    {
        $validateData = $this->validate([
            'trailerName' => 'required|string',
            'embedHtml' => 'required|string',
        ]);
        $this->tvshow->trailers()->create([
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

    public function editTvShow(int $tvshow_id)
    {

        $this->tvshow_id = $tvshow_id;
        $tvshow = TvShow::findOrFail($tvshow_id);
        $this->tvshow = TvShow::findOrFail($tvshow_id);
        $this->title = $tvshow->title;
        $this->slug = $tvshow->slug;
        $this->runtime = $tvshow->runtime;
        $this->language = $tvshow->lang;
        $this->format = $tvshow->video_format;
        $this->rating = $tvshow->rating;
        $this->poster = $tvshow->poster_path;
        $this->backdrop = $tvshow->backdrop_path;
        $this->overview = $tvshow->overview;
        $this->status = $tvshow->is_public;
        $this->meta = $tvshow->meta;
    }

    public function updateTvShow()
    {
        $this->validate();

//        if (strlen($this->slug)>3) {
//            $slug=Str::slug($this->slug);
//        } else {
//            $slug=Str::slug($this->name);
//        }

        TvShow::findOrFail($this->tvshow_id)->update([
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

    public function deleteTvShow($tvshow_id)
    {
        $this->tvshow_id = $tvshow_id;
    }

    public function destroyTvShows()
    {
        TvShow::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function updateTvShows()
    {
        //dd($this->status);
        $validatedData = $this->validate([
            'status' => 'required'
        ]);
        TvShow::whereKey($this->checked)->update(
            ['is_public' => $this->status]
        );
        $this->checked = [];
        $this->selectAll = false;
        $this->selectAllDB = false;
    }

    public function destroyTvShow($tvshow_id)
    {
        TvShow::findOrFail($tvshow_id)->delete();
        //$this->resetInput();
        $this->checked = array_diff($this->checked, [$tvshow_id]);
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

    public function getTvShowsProperty()
    {
        return $this->tvshowsQuery->paginate($this->perPage);
    }

    public function getTvShowsQueryProperty()
    {
        return TvShow::search('name', $this->search)->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.admin.tv-show.index', ['tvshows' => $this->tvshows])
            ->extends('layouts.admin')
            ->section('content');
    }

    public function isChecked($tvshow_id)
    {
        return in_array($tvshow_id, $this->checked);
    }
}
