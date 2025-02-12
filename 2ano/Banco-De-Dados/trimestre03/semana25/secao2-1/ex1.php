<?php

function fatorial($numero){
    if ($numero != 0){
        return $numero * fatorial($numero - 1);
    }
    else {
        return 1;
    }
}
echo fatorial(10);
?>
