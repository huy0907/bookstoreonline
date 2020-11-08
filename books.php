<?php
  session_start();
  $count = 0;
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books";
  require_once 'Paginator.class.php';
  $limit      = 12;
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
  $Paginator  = new Paginator( $conn, $query );
  $results    = $Paginator->getData(  $limit,$page );
 

  $title = "Full Catalogs of Books";
  require_once "./template/header.php";
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
          a{
            text-decoration:none;
          }
          .col-md-3{
          }
        </style>
    </head>
    <body>
        <div class = 'row' padding = "20px">
        <?php for( $i = 0; $i < count( $results->data )/3; $i++ ) { ?>
          <div class = "col-md-3" >
            <?php for( $j = 0; $j < 3; $j++ ) { ?>
              <a href="book.php?bookisbn=<?php echo $results->data[$i*3 + $j]['book_isbn']; ?>">
              <img class="book_img" src="<?php echo $results->data[$i*3 + $j]['book_image']; ?>" >
              <p><?php  echo $results->data[$i*3 + $j]['book_title'] ?></p>
              <p><?php  echo $results->data[$i*3 + $j]['book_price']?> VNĐ</p>
            </a>
            <?php } ?>
          </div>
        <?php } ?>
        </div>
        </body>
</html>


<?php $temp = 'pagination pagination-sm' ?>
<?php echo $Paginator->createLinks( $links, $temp ); ?> 

<?php
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>