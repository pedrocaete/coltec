<?php
$lines = file(
    "ex1.txt",
    FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES
);
if ($lines) {
    foreach ($lines as $linha) {
        echo $linha . " <br > ";
    }
}
?>
