<?php
$file = fopen("ex1.txt", "r");

while (!feof($file)) {
    echo fgets($file) . "<br>";
}

fclose($file);
