 <?php
    $filename = "exemplo3.txt";
    // usa funcao file_exists () para ver se arquivo existe
 if (file_exists($filename)) {
     // Open the file for reading
     $file = fopen($filename, "r") or die(" Nao consegui abrir o arquivo ");

     // Le arquivo linha por linha
     while (! feof($file)) {
         echo fgets($file) . " <br > ";
     }

     // Fecha o arquivo
     fclose($file);
 } else {
     echo " Arquivo nao encontrado ! ";
 }
    ?>
