<?php

namespace App\Http\Livewire\Front;

use App\Models\Movie;
use Livewire\Component;

class Search extends Component
{
    public $searchInput;
    public $results = [];

    public function search()
    {

    }

    public function render()
    {
        return view('livewire.front.search');
    }
}
