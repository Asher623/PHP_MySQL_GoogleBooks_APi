<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<a href="googleBooks.php"><-Back</a><br><br>

<form action="" id="seachForm" method="POST">
    
    <input type="submit" value="Add Book to Database">

</form><br>

<?php

    session_start();    
    $bookInfo = $_SESSION['bookInfo'];

?>

<script>

$(function(){

    $("form").submit(function(e){
        
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "addBook.php",
            data: {ajax: 1, book: <?php echo json_encode( $bookInfo )?>},
            success: function(response){
                $('#response').text("New book with title: " + response + " was successfully added to database.");
            }
        })
    });
});

</script>

<div id='response'></div>
<img src="<?php echo $bookInfo['cover'] ?>" alt="">
<h3><?php echo $bookInfo['title'] ?></h3>
<h4><?php echo $bookInfo['author'] ?></h4>
<p><?php echo $bookInfo['price']['price'] . " " . $bookInfo['price']['currency']; ?></p>
    
</body>
</html>
