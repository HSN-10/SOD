<?php

$newIP = $_GET['new'];

if (($newIP)) {
    $fileName = 'ip.txt';
    $open = fopen($fileName, 'w')
    or die('Cannot open file: ' . $fileName);
    fwrite($open, $newIP)
    or die('cannot edit file: ' . $fileName);
    echo "Done!";
} else {
    echo "Go To Hell";
}


