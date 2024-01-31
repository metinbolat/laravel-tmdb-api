<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $table = 'casts';

    protected $fillable = ['tmdb_id', 'name', 'slug', 'castable_id', 'castable_type', 'poster_path'];

    public function movies()
    {
        return $this->morphedByMany(Movie::class, 'castable');
    }

    public function tvshows()
    {
        return $this->belongsToMany(Movie::class, 'cast_tv_show');
    }
}
