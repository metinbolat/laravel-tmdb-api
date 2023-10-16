<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TvShow;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';

    protected $fillable = [
        'tmdb_id',
        'tv_show_id',
        'name',
        'season_number',
        'episodes_count',
        'air_date',
        'status',
        'is_public',
        'overview',
        'poster_path',
        'meta',
    ];

    public function tvshow ()
    {
        return $this->belongsTo(TvShow::class, 'tv_show_id');
    }

    public function episodes ()
    {
        return $this->hasMany(Episode::class);
    }
}
