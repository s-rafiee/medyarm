<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ env('APP_URL') }}</loc>
        <lastmod>2019-08-19T09:09:58+00:00</lastmod>
        <changefreq>Always</changefreq>
        <priority>0.8</priority>
    </url>
    @foreach ($data['pages'] as $page)
        <url>
            <loc>{{ env('APP_URL') }}/{{ $page->title_en }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>Always</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
