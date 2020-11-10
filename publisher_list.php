

<?php

	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM publisher ORDER BY publisherid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty publisher ! Something wrong! check again";
		exit;
	}

	$title = "List Of Publishers";
	require "./template/header.php";
?>
	<p class="lead">List of Publisher</p>
	<ul style="
	list-style: none;
	
	text-align: left;
	background-color: #ced8db;
	text-decoration: none;
	display: block;
	


	" >
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0;
			$x = 0;
			$query = "SELECT publisherid FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				$x++;
				if($pubInBook['publisherid'] == $row['publisher_name']){
					$count++;
				}
			}
	?>
		<li>
			
		    <a 
		     "  href="bookPerPub.php?pubid=<?php echo $row['publisher_name']; ?>"><?php echo $row['publisher_name']; ?></a>
		    <span>có</span>
		    <span class="badge"><?php echo $count; ?></span>
		    <span>Cuốn</span>
		</li>
	<?php } ?>
		<li>
			
			<a href="books.php">List full of books</a>
			<span>có</span>
			<span><?php  echo $x;      ?></span>
			<span>Cuốn</span>

		</li>
	</ul>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>