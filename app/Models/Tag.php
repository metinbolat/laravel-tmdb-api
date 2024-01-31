<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'tag_name',
        'slug',
    ];

    public function movies()
    {
        return $this->morphedByMany(Movie::class, 'taggable');
    }

    public function tvshows()
    {
        return $this->morphedByMany(TvShow::class, 'taggable');
    }

//    public function taggable()
//    {
//        $this->morphTo();
//    }
}
