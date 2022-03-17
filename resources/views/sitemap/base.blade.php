<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ env('APP_URL') }}/sitemap/Pages.xml</loc>
    </sitemap>
    <sitemap>
        <loc>{{ env('APP_URL') }}/sitemap/Skills.xml</loc>
    </sitemap>
    <sitemap>
        <loc>{{ env('APP_URL') }}/sitemap/Courses.xml</loc>
    </sitemap>
    <sitemap>
        <loc>{{ env('APP_URL') }}/sitemap/Lessons.xml</loc>
    </sitemap>
    <sitemap>
        <loc>{{ env('APP_URL') }}/sitemap/Blogs.xml</loc>
    </sitemap>
</sitemapindex>