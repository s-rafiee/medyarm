<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data['lessons'] as $lesson)
        <url>
            <loc>{{ env('APP_URL') }}/{{ $lesson->title_en }}</loc>
            <lastmod>{{ $lesson->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>Always</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
