<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Comment;
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
        $totalComments = Comment::count();
        $totalVisits = Movie::sum('visits');

        return view('admin.dashboard', compact('users','movies','casts', 'totalComments', 'totalVisits'));
    }
}
