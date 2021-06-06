<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
<a href="added_books.php">Added Books</a><br><br>

<form action="googleBooks.php" method="POST">
Enter Title: <input type="text" name="titleName">
<input type="submit">
</form>
<br>




<?php
session_start();
if (isset($_POST["titleName"])){
    $titleName = str_replace(' ', '%', $_POST["titleName"]);

    $page = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=intitle:$titleName");
    
    $sqlData = json_decode($page, true);

    $data;
    for($i = 0; $i < count($sqlData); $i++){
        
        if (isset($sqlData['items'][$i]['saleInfo']['listPrice']['amount'])){
            $data = $sqlData['items'][$i];
            break;
        }
    }
    if(isset($data)){
        $title = $data['volumeInfo']['title'];
        $author = $data['volumeInfo']['authors'][0];
        $cover = $data['volumeInfo']['imageLinks']['thumbnail'];
        $price = array("price"=>$data['saleInfo']['listPrice']['amount'], "currency"=>$data['saleInfo']['listPrice']['currencyCode']);



        $bookInfo = array("title"=>$title, "author"=>$author,"cover"=>$cover,  "price"=>$price);


        $bookCover = $data['volumeInfo']['imageLinks']['thumbnail'];


        $_SESSION['bookInfo'] = $bookInfo;
        echo "<img src='".$bookCover."'/><br>";
        echo "<h3><a href=".'bookPage.php'."> $title</a> </h3>";
        echo "<h4>$author</h4>";
        echo "<h4>".$price['price']. " " . $price['currency']." </h4>";
    }
    else{
        echo "There are no books for sale.";
    }


    


}
?>

    
</body>
</html>