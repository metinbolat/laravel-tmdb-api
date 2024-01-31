<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'runtime' => 'required|string|max:4',
            'language' => 'required|string|max:50',
            'is_public' => 'required|boolean',
            'poster_path' => 'required|string|max:255',
            'backdrop_path' => 'required|string|max:255',
            'overview' => 'required|string|max:1000',
            'country' => 'required|string|max:255',
            'source' => 'max:255',
            'meta' => 'required|string|max:255',
        ];
    }
}
