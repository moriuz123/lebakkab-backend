<?php
$json = file_get_contents('http://localhost/api/berita/kategori/artikel');
$data = json_decode($json, true)['data'];
echo 'Count: ' . count($data) . PHP_EOL;
foreach($data as $d) {
    echo ($d['kategori']['nama'] ?? 'None') . ' | ' . ($d['opd_id'] ?? 'null') . ' | ' . $d['judul'] . PHP_EOL;
}
