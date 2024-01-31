<?php

namespace App\Http\Livewire\Front\Movie;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Setting;
use Livewire\Component;

class FilterMovies extends Component
{
    public $selectedCategory = null;
    public $minImdbRating = null;
    public $maxImdbRating = null;
    public $minReleaseYear = null;
    public $maxReleaseYear = null;
    public $start;
    public $end;

    protected $listeners = ['sliderUpdated' => 'updateSliderValues'];

    public function updateSliderValues($values)
    {
        $this->start = $values['start'];
        $this->end = $values['end'];
    }


    public function mount()
    {
        $this->genres = Genre::all();
        $this->settings = Setting::find(1);
    }
    public function updatedMinYear()
    {
        dd($this->minYear);
    }

    public function render()
    {

        $movies = Movie::whereBetween('rating', [$this->start, $this->end])->get();;
        return view('livewire.front.movie.filter-movies', ['genres' => $this->genres, 'movies' => $movies]);
    }
}
