<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="bootstrap/css/style_dich_vu.css">
  <title>Sách</title>
</head>

  <header class="container-fluid">
    <div class="row">
        <a href="index.php" target="_blank" >
        <img src="bootstrap/img/hello.jpg" alt="Logo" width="1349px" ></a>
      <br>
      
    
    </div>
  </header>
  <nav class="navbar navbar-expand-lg navbar-light " style="margin:auto;" >
  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto " style="margin-left:35rem;">
       <li class="nav-item">
        <a class="nav-link" href="index.php">  HOME                  
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="publisher_list.php">NHÀ XUẤT BẢN
        </a>
        
      <li class="nav-item">
        <a class="nav-link" href="products.php">SÁCH</a>

       <li class="nav-item">
        <a class="nav-link" href="contact.php">LIÊN HỆ</a>
       <li class="nav-item">
        <a class="nav-link" href="cart.php">GIỎ HÀNG</a>  
        <li class="nav-item">
        <a class="nav-link" href="admin.php">ĐĂNG NHẬP</a>
        </div>
        
    </ul> 
  </div>
</nav>
  
    <?php
      if(isset($title) && $title == "Index") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
   
    <?php } ?>

    <div class="container" id="main">