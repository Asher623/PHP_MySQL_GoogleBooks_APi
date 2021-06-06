<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>

<a href="googleBooks.php"><-Back</a><br>

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbase = "books";
    
    $conn =mysqli_connect($servername, $username, $password, $dbase);
    
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "SELECT title, author, cover, price, currency FROM added_books";
    $booksArray = mysqli_query($conn, $sql);

    if ($booksArray->num_rows > 0){
        while($row = $booksArray->fetch_assoc()){
            echo "<img src='".$row['cover']."'/><br>";
            echo "Title: ".  $row['title'] ."<br>". "Author: " . $row['author'] . "<br>";
            echo "Price: ". $row['price'] . " " . $row['currency']. "<br><br>";
        }
        
    }else{
        echo "0 results";
    }
    $conn->close();

?>

</body>
</html>
