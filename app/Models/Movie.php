<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'tmdb_id',
        'title',
        'slug',
        'release_date',
        'runtime',
        'rating',
        'lang',
        'video_format',
        'is_public',
        'overview',
        'poster_path',
        'backdrop_path',
        'meta',
        'country'
    ];

    public function genres()
    {
        return $this->morphMany(Genre::class, 'genreable');
    }

    public function trailers()
    {
        return $this->morphMany(Trailer::class, 'trailerable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function casts()
    {
        return $this->morphMany(Cast::class, 'castable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function incrementVisitCount() {
    $this->visits++;
    return $this->save();
}
}
