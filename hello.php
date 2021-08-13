<?php
include "1/var.php";
echo "hello".$var;
$file = '05._one_direction_-_you_and_i-1.mp3';
$fileHandle = fopen($file, 'rb');

// Read file into memory.

$binary = fread($fileHandle, 5);

// Detect presence of ID3 information.
if (substr($binary, 0, 3) == "ID3") {
    // ID3 tags detected.
    $tags['FileName'] = $file;
    $tags['TAG'] = substr($binary, 0, 3);
    $tags['Version'] = hexdec(bin2hex(substr($binary, 3, 1))) . "." . hexdec(bin2hex(substr($binary, 4, 1)));
}
$tag = id3_get_tag( "05._one_direction_-_you_and_i-1.mp3" );
print_r($tag);