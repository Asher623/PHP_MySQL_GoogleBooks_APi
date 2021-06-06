<?php

if (isset($_POST['ajax']) && isset($_POST['book'])){

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbase = "books";
    
    $aBook = $_POST['book'];
    $conn =mysqli_connect($servername, $username, $password, $dbase);
    
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    
    $sql = "INSERT INTO added_books (title, author, cover, price,currency) VALUES ('".$aBook['title']."', '".$aBook['author']."', '".$aBook['cover']."', '".$aBook['price']['price']."', '".$aBook['price']['currency']."')";

    if (mysqli_query($conn, $sql)) {
        
        } else {
        echo "ERROR: Could not able to execute " . mysqli_error($conn);
    }
   
    mysqli_close($conn);

    echo $aBook['title'];
}
else{
    echo "Empty";
}


?>