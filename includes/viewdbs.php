<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>
		
	</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
</head>
<body>
	<form method="POST" action="../index.php">
		<button type="submit" name="submit4">Home</button>
	</form>
	<form method="POST" action="edit.php">
	<button type="submit" name="submit2">EditDB</button>
	</form>
<table>
	<tr>
		<th>
			Name
		</th>
		<th>
			Roll_no
		</th>
		<th>
			College
		</th>
		<th>
			Year
		</th>
		<th>
			Image
		</th>
	</tr>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['submit1'])) {
	include 'dbh.inc.php';
	if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

		$sql ="SELECT * FROM example2";
		$result=mysqli_query($conn,$sql);
		if($result==="FALSE"){
			echo "problem";
		}
		else{
		$resultcheck=mysqli_num_rows($result);
		if($resultcheck>0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['name']."</td>";
				echo "<td>".$row['roll_no']."</td>";
				echo "<td>".$row['college']."</td>";
				echo "<td>".$row['year']."</td>";
				echo "<div id='img_div'>";
				echo "<td>"."<img src='images/".$row['image']."' width='200' height='200'>"."</td>";
				echo "</div></tr>";
			}
		}
		}
	}
}
	?>
</table>

</body>
</html>
