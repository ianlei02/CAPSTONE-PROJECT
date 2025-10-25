<?php
    
    $conn = new mysqli('localhost', 'root', '', 'peso_3c');
        // $conn = new mysqli('localhost', 'u686565759_peso_admin', 'PESO4c2025', 'u686565759_peso_smb');
    if($conn){
        // echo "Connection Successful"
    }
    else{
        echo "Connection Error!";
    }

?>