<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'embed_html'];

    public function movies()
    {
        return $this->morphedByMany(Movie::class, 'trailerable');
    }
}
