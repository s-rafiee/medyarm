<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data['blogs'] as $blog)
        <url>
            <loc>{{ env('APP_URL') }}/{{ $blog->title_en }}</loc>
            <lastmod>{{ $blog->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>Always</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
