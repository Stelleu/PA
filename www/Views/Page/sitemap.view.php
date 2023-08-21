<?php
header("Content-Type: application/xml");
$xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;
foreach ($slug as $url) {
    $xml .= '<url>'. PHP_EOL;
    $xml .= '<loc>' . $url['slug'] . '</loc>'. PHP_EOL;
    $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>'. PHP_EOL;
    $xml .= '<changefreq>weekly</changefreq>'. PHP_EOL;
    $xml .= '<priority>0.8</priority>'. PHP_EOL;
    $xml .= '</url>';
}
$xml .= '</urlset>'. PHP_EOL;
// Afficher le contenu XML
echo $xml;