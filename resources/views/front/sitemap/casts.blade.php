<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($casts as $cast)
        <url>
            <loc>https://filmdiziplus.club/oyuncu/{{ $cast->slug }}</loc>
            <lastmod>{{ $cast->updated_at }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
