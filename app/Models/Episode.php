<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'episodes';

    protected $fillable = [
        'tmdb_id',
        'season_id',
        'name',
        'slug',
        'episode_number',
        'air_date',
        'status',
        'is_public',
        'still_path',
        'overview',
        'meta'
    ];

    public function season ()
    {
        return $this->belongsTo(Season::class);
    }

}
