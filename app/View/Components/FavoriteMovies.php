<?php

namespace App\View\Components;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\View\Component;

class FavoriteMovies extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
       $favoriteMovies = Movie::where('is_public', 1)->orderBy('visits', 'desc')->take(6)->get();
        return view('components.favorite-movies', compact('favoriteMovies'));
    }
}
