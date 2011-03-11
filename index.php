<?php

define('MIN_WIDTH', 1800);
define('MIN_HEIGHT', 1200);

$xml = simplexml_load_file('https://picasaweb.google.com/data/feed/base/featured');
$filename = 0;
foreach($xml->entry as $entry) {
    $url = $entry->content['src'] . '';
    $size = getimagesize($url);

    if (($size[0] >= MIN_WIDTH || $size[1] >= MIN_HEIGHT) && ($size[0] > $size[1])) {
        echo "$url\n";
        file_put_contents("images/$filename.jpg", file_get_contents($url));
        $filename++;
    }
}
