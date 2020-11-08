<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?>
     
      <!DOCTYPE html>
    <head>
        <title>Books</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
          .book_img{
            width:200px;
            height:250px;
            margin:5px;
            margin-left:0px;
          }
        </style>
    </head>
    <body>
         <!-- Example row of columns -->
      <p class="lead text-center text-muted">Latest books</p>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
    </body>
</html>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>