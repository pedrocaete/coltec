<?php
// Obtem o codigo fonte ( HTML ) deu uma URL .
$array1 = file('http://www.example.com/');
echo " <br > ---------------------------------- <br > ";
print_r($array1);
echo " <br > ---------------------------------- <br > ";

// Loop through our array , show HTML source as HTML source ; and line numbers too .
foreach ($array1 as $num_linha => $linha) {
    echo " Line #<b>{$num_linha}</b> : " . htmlspecialchars($linha) . " <br />\n ";
}
