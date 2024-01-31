<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    public function genres():MorphToMany
    {
        return $this->morphToMany(Genre::class, 'genreable');
    }

    public function trailers():MorphToMany
    {
        return $this->morphToMany(Trailer::class, 'trailerable');
    }

    public function tags():MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function casts():MorphToMany
    {
        return $this->morphToMany(Cast::class, 'castable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
