<?php

define('MIN_WIDTH', 1800);
define('MIN_HEIGHT', 1200);
define('MAX_FILE_NAME_SIZE', 25);

$xml = simplexml_load_file('https://picasaweb.google.com/data/feed/base/featured');
foreach($xml->entry as $entry) {
    $url = $entry->content['src'] . '';
    $size = getimagesize($url);

    $remove_chars = array('"', ":", "@", "#", ';', '!', '%', '$', '^', '&', '*', '=', '|', '?', '`', '\'', '~');
    $replace_chars = array(' ', '.', '/', '\\', ',');

    if (($size[0] >= MIN_WIDTH || $size[1] >= MIN_HEIGHT) && ($size[0] > $size[1])) {
        $title = $entry->title;
        $user= $entry->author->email;
        
        $title = substr($title, 0, MAX_FILE_NAME_SIZE);
        $title = str_replace($remove_chars, '', $title);
        $title = str_replace($replace_chars, '-', $title);
        $title = str_replace('--', '-', $title);

        $title = "$title.jpg";

        file_put_contents("images/$title", file_get_contents($url));
    }
}
