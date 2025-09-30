<?php
    
    $conn = new mysqli('localhost', 'root', '', 'peso_3c');
    // $conn = new mysqli('localhost', 'u584845886_root', 'PESO4c2025', 'u584845886_peso_4c');
    if($conn){
        // echo "Connection Successful"
    }
    else{
        echo "Connection Error!";
    }

?>