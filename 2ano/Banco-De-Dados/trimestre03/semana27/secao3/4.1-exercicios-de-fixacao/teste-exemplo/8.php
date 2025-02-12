 <!DOCTYPE html>

 <body>
     <?php
        // L ê 20 caracteres a partir do zero
        $text = file_get_contents("ex1.txt", false, null, 0, 36);
        echo $text;
        ?>
 </body>

 </html>
