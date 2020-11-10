<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM books WHERE 1
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		AND book_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND category IN('".$category_filter."')
		";
	}
	if(isset($_POST["cover_type"]))
	{
		$covertype_filter = implode("','", $_POST["cover_type"]);
		$query .= "
		 AND cover_type IN('".$covertype_filter."')
		";
	}
	if(isset($_POST["cover_type"]))
	{
		$covertype_filter = implode("','", $_POST["cover_type"]);
		$query .= "
		 AND cover_type IN('".$covertype_filter."')
		";
	}

	if(isset($_POST["publisher"]))
	{
		$publisher_filter = implode("','", $_POST["publisher"]);
		$query .= "
		 AND publisherid IN('".$publisher_filter."')
		";
	}

	if(isset($_POST["year_publish"]))
	{
		$year_filter = implode("','", $_POST["year_publish"]);
		$query .= "
		 AND year_publish IN('".$year_filter."')
		";
	}

	if (isset($_POST["name"]) && !empty($_POST["name"])) {
		$query .= "
		 AND MATCH(book_title) AGAINST ('".$_POST["name"]."')
		";
	}
	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		$output .= '<p class="col-12"> Có '. $total_row .' kết quả phù hợp </p>';
		foreach($result as $row)
		{
			$output .= '
			
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
					<p align="center"><strong><a href="book.php?bookisbn='. $row['book_isbn'] .'"> '. $row['book_title'] .'</a></strong></p>
					<img src = "'. $row['book_image'] .'" width = "100%" height = "50%">
					<br>
					<br>
					<p> Giá: '. $row['book_price'] .' VNĐ</p>
					<p> Loại bìa: '. $row['cover_type'] .'</p>
					<p> Thể loại: '. $row['category'] .'</p>
					</div> 
			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>