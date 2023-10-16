<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($movies as $movie)
        <url>
            <loc>https://filmdiziplus.club/filmler/{{ $movie->slug }}</loc>
            <lastmod>{{ $movie->updated_at }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
