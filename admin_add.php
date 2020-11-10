<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "Add new book";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
		
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);

		$image = trim($_POST['image']);
		$image = mysqli_real_escape_string($conn, $image);

		$cover = trim($_POST['cover']);
		$cover = mysqli_real_escape_string($conn, $cover);

		$year = trim($_POST['year']);
		$year = mysqli_real_escape_string($conn, $year);
		
		$size = trim($_POST['size']);
		$size = mysqli_real_escape_string($conn, $size);

		$page = trim($_POST['page']);
		$page = mysqli_real_escape_string($conn, $page);

		$cat = trim($_POST['cat']);
		$cat = mysqli_real_escape_string($conn, $cat);

		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		if(!$findResult){
			
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			$publisherid = mysql_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$publisherid = $row['publisherid'];
		}


		$query = "INSERT INTO books VALUES ('" . $author . "','" . $isbn . "', '" . $cover . "' , '" . $descr . "', '" . $image . "', '" . $title . "', '" . $page  . "', '" . $price . "','" . $size . "', '" . $year . "','" . $publisherid . "','" . $cat . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			header("Location: admin_book.php");
		}
	}
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Barcode</th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>Tên</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Tác giả</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Ảnh</th>
				<td><input type="text" name="image"></td>
			</tr>
			<tr>
				<th>Mô tả</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Giá</th>
				<td><input type="text" name="price" required></td>
			</tr>
			<tr>
				<th>Nhà xuất bản</th>
				<td><input type="text" name="publisher" required></td>
			</tr>

			<tr>
				<th>Bìa</th>
				<td><input type="text" name="cover" required></td>
			</tr>
			<tr>
				<th>Năm</th>
				<td><input type="text" name="year" required></td>
			</tr>

			<tr>
				<th>Kích cỡ</th>
				<td><input type="text" name="size" required></td>
			</tr>
			<tr>
				<th>Số trang</th>
				<td><input type="text" name="page" required></td>
			</tr>

			<tr>
				<th>Thể loại</th>
				<td><input type="text" name="cat" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new book" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>