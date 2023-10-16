<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $movies = Movie::all();
        $casts = Cast::all();

        return view('admin.dashboard', compact('users','movies','casts'));
    }
}
