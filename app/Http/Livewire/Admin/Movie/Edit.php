<?php

namespace App\Http\Livewire\Admin\Movie;

use Livewire\Component;
use App\Models\Movie;
use Illuminate\Support\Str;


class Edit extends Component
{

    public $title, $runtime, $lang, $videoFormat, $rating, $posterPath,
        $backdropPath, $overview, $isPublic, $movieTMDB, $movie_id,
        $trailerId, $trailerName, $embedHtml, $movie, $resultId, $meta;
    
        public $film;

        public function mount ($id)
        {
            $this->film = Movie::find($id);
            //$this->title = $film->title;
        }
    public function render()
    {
        // //$this->movie_id = $movie_id;
        // //$movie = Movie::findOrFail($movie_id);
        // //$this->movie = Movie::findOrFail($movie_id);
        // $this->title = $film->title;
        // $this->slug = $movie->slug;
        // $this->runtime = $movie->runtime;
        // $this->language = $movie->lang;
        // $this->format = $movie->video_format;
        // $this->rating = $movie->rating;
        // $this->poster = $movie->poster_path;
        // $this->backdrop = $movie->backdrop_path;
        // $this->overview = $movie->overview;
        // $this->status = $movie->is_public;
        // $this->meta = $movie->meta;
        return view('livewire.admin.movie.edit')
        ->extends('layouts.admin')
        ->section('content');
    }
}
