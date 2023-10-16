<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TvShow extends Model
{
    use HasFactory;

    protected $table = 'tv_shows';

    protected $fillable = [
        'tmdb_id',
        'name',
        'slug',
        'first_aired',
        'last_aired',
        'status',
        'lang',
        'video_format',
        'is_public',
        'overview',
        'poster_path',
        'backdrop_path',
        'meta',
        'country'
    ];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'tv_show_id');
    }

    public function casts()
    {
        return $this->morphMany(Cast::class, 'castable');
    }

    public function genres()
    {
        return $this->morphMany(Genre::class, 'genreable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class, 'tv_show_id');
    }

    public function trailers()
    {
        return $this->morphMany(Trailer::class, 'trailerable');
    }

}
