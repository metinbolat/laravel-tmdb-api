<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MovieSyncService
{
    public function syncTags($movie, $tags)
    {
        $tagIds = [];
        if ($tags) {
            foreach ($tags as $tag) {
                $findTag = Tag::find($tag);
                if ($findTag) {
                    $tagIds[] = $findTag->id;
                } else {
                    $newTag = Tag::create([
                        'tag_name' => $tag,
                        'slug' => Str::slug($tag),
                    ]);
                    $tagIds[] = $newTag->id;
                }
            }
        }
        $movie->tags()->sync($tagIds);
    }

    public function syncGenres($movie, $genres)
    {
        $genreIds = [];
        if ($genres) {
            foreach ($genres as $genre) {
                $findGenre = Genre::find($genre);
                if ($findGenre) {
                    $genreIds[] = $findGenre->id;
                } else {
                    $newGenre = Genre::create([
                        'name' => $genre,
                        'slug' => Str::slug($genre),
                    ]);
                    $genreIds[] = $newGenre->id;
                }
            }
        }
        $movie->genres()->sync($genreIds);
    }
}
