<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  

  $query = "SELECT * FROM books b WHERE book_isbn = '$book_isbn' ";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }
  
  $title = $row['book_title'];
  require "./template/header.php";
?>
      <!-- Example row of columns -->
      <p class="lead" style="margin: 25px 0"><a href="books.php">Books</a> > <?php echo $row['book_title']; ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="<?php echo $row['book_image']; ?>">
        </div>
        <div class="col-md-6">
          <h4>Book Description</h4>
          <p><?php echo $row['book_descr']; ?></p>
          <h4>Book Details</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title" || $key == "category"){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "Barcode";
                  break;
                case "book_title":
                  $key = "Tiêu đề";
                  break;
                case "book_author":
                  $key = "Tác giả";
                  break;
                case "book_price":
                  $key = "Giá (VNĐ)";
                  break;
                case "category":
                  $key = "Thể loại";
                break;
                case "cover_type":
                  $key = "Loại bìa";  
                break;
                case "page":
                  $key = "Số trang";  
                break;
                case "size":
                  $key = "Kích cỡ";  
                break;
                case "year_publish":
                  $key = "Năm xuất bản";  
                break;
              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>
          <form method="post" action="cart.php">
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
          </form>
       	</div>
      </div>
<?php
  require "./template/footer.php";
?>