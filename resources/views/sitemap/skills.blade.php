<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach ($data['skills'] as $skill)
		<url>
			<loc>{{ env('APP_URL') }}/skill/{{ $skill->skillen }}</loc>
			<lastmod>{{ $skill->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>Always</changefreq>
			<priority>1</priority>
		</url>
	@endforeach
</urlset>
