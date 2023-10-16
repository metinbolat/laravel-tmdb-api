<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index ()
    {
        return view('admin.genres.index');
    }

    public function create ()
    {
        return view('admin.genres.create');
    }

    public function store (Request $request)
    {
        return view('admin.genres.create');
    }
}
