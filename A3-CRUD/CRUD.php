<!DOCTYPE HTML>
<html>
	<head>
	</head>

<body>
	<!--Create-->
	<h1>Create</h1><br>
	<form method="post">
		Name: <input type="text" name="name"><br>
		category: <input type="text" name="cat"><br>
		price: <input type="text" name="price"><br>
		quantity: <input type="text" name="quan"><br>
		datecheck:<input type="text" name="dat"><br>
		<input type="submit" value="submit" name="submit">
	</form>

	<?php
		function C(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "CS230";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$nam = $_POST['name'];
			$dat = $_POST['dat'];
			$cat = $_POST['cat'];
			$quan = $_POST['quan'];
			$pr = $_POST['price'];

			$sql = "INSERT INTO stock (name, category, price, quantity, checkdate)
			VALUES ('$nam', '$cat', '$pr', '$quan', '$dat')";

			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			mysqli_close($conn);
		}
		if (isset($_POST['submit'])) {
			C();
			/*	echo "hello";*/
		}
	?>

	<!--Retrieve-->
	<h1>Retrieve</h1><br>
	<?php
		function R(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "CS230";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			//$sql = "SELECT * FROM stock";
			$sql = "SELECT * FROM stock";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table id = 'table'><tr><th>ID</th><th>name</th><th>category</th><th>price</th><th>quantity</th><th>checkdate</th></tr>";
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["category"]."</td><td>".'€'.$row["price"]."</td><td>".$row["quantity"]."</td><td>".$row["checkdate"]."</td></tr>";

				}
				echo "</table>";
			} else {
				echo "0 results";
			}
			$conn->close();
		}
		R();

	?>

	<!--Update-->
	<h1>Update</h1><br>
	<form method="post">
		Name of column: <input type="text" name="name"><br>
		replace value with: <input type="text" name="rep"><br>
		row id: <input type="text" name="id"><br>
		<input type="submit" value="submit" name="submit3">
	</form>

	<?php
		function U(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "CS230";
			$rep = $_POST['rep'];
			$na = $_POST['name'];
			$id = $_POST['id'];
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			/*if($na=='name'){*/
			$sql = "UPDATE stock SET $na='$rep' WHERE id=$id";
			/*}*/
			if ($conn->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}

			$conn->close();
		}
		if (isset($_POST['submit3'])) {
			U();
			echo "<br>your new table:<br>";
			R();
			/*	echo "hello";*/
		}
	?>

	<!--Delete-->
	<h1>Delete</h1><br>
	<form method="post">
		ID: <input type="text" name="id"><br>
		<input type="submit" value="Delete" name="submit2">
	</form>

	<?php
		function D(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "CS230";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$id=$_POST['id'];
			// sql to delete a record
			$sql = "DELETE FROM stock WHERE id=$id";

			if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . $conn->error;
			}

			$conn->close();
		}
		if (isset($_POST['submit2'])) {
			D();
			echo "<br>your new table:<br>";
			R();
			/*	echo "hello";*/
		}

	?>


	<style>

		/*table borders*/
		#table {
			width:auto;
			background: white;
			height:auto;
			border-bottom: 2px solid #2d2d2d;
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 1), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
			border-collapse: collapse;
			border-spacing: 0;
		}
		/*data cell design*/
		#table td {
			text-align:left;
			font-family: sans-serif;
			font-size: 14px;
			padding: 10px 5px;
			overflow: hidden;/*check*/
			word-break: normal;
			border: 3px solid #2d2d2d;
			min-width: 94px;
			min-height: 16px
		}
		/*header design*/
		#table th {
			border: 3px solid #2d2d2d;
			font-family: sans-serif;
			background-color:#6d6d6d;
			font-size: 14px;
			padding: 10px 5px;
			overflow: hidden;
			word-break: normal;
		}
	</style>
</body>
</html>
