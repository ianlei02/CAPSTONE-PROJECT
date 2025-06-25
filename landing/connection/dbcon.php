<?php
    
    $conn = new mysqli('localhost', 'root', '', 'peso_3c');
    
    if($conn){
        // echo "Connection Successful"
    }
    else{
        echo "Connection Error!";
    }

?>