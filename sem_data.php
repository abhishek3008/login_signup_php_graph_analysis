<?php
		include 'db.php';
		$id = $_POST["id"];
		$table_name = $_POST["table_name"];
		$query = "SELECT * from $table_name where user_id=$id";
		$result = mysqli_query($conn, $query); 
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$check = 1;
			echo $row["subject1"].",".$row["subject2"].",".$row["subject3"].",".$row["subject4"];
		}
		else{
			echo "0";
		}
?>