<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data['courses'] as $cours)
        <url>
            <loc>{{ env('APP_URL') }}/{{ $cours->name_en }}</loc>
            <lastmod>{{ $cours->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>Always</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
