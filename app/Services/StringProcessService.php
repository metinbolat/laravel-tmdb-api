<?php

namespace App\Services;

use Illuminate\Support\Str;


class StringProcessService
{
    private mixed $keyValuePairs;

    public function __construct()
    {
        $filePath = base_path('database/json/dictionary.json');
        $keyValuePairs = json_decode(file_get_contents($filePath), true);
        $this->keyValuePairs = $keyValuePairs;
    }

    public function changeLanguage(string $string): string
    {
        // Get the 'languages' array from the json dictionary
        $languages = $this->keyValuePairs['languages'];

        // Separate the keys and values into two arrays
        $search = array_keys($languages);
        $replace = array_values($languages);
        $replacedLanguage = Str::replace($search, $replace, $string);

        if (!$replacedLanguage) {
            return $string;
        }
        return $replacedLanguage;
    }

    public function changeCountry(string $string): string
    {
        // Get the 'countries' array from the data
        $countries = $this->keyValuePairs['countries'];

        // Separate the keys and values into two arrays
        $search = array_keys($countries);
        $replace = array_values($countries);
        $replacedCountry = Str::replace($search, $replace, $string);

        if (!$replacedCountry) {
            return $string;
        }
        return $replacedCountry;
    }
}
