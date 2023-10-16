<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_email',
        'site_description',
        'site_logo',
        'site_favicon',
        'site_separator',
        'site_footertext',
        'comment_approval',
    ];

    public function getSiteLogoAttribute($value)
    {
        return asset('assets/admin/images/logo-favicon/'. $value);
    }

    public function getSiteFaviconAttribute($value)
    {
        return asset('assets/admin/images/logo-favicon/'. $value);
    }
}
