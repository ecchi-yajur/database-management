<?php
$nameErr=$roll_noErr=$collegeErr=$yearErr="";
$name=$roll_no=$college=$year="";
$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['submit'])) {
	include 'dbh.inc.php';
	if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
  	if (empty($_POST["roll_no"])) {
    	$roll_noErr = "Roll no is required";
  	} else {
    $roll_no = test_input($_POST["roll_no"]);
  }
  if (empty($_POST["college"])) {
    $collegeErr = "college is required";
  } else {
    $college = test_input($_POST["college"]);
  }
  if (empty($_POST["year"])) {
    $yearErr = "year is required";
  } else {
    $year = test_input($_POST["year"]);
  }
	$image=$_FILES['image']['name'];
	print_r($_FILES['image']);	
	$target="images/".$_FILES['image']['name'];
	if (empty($name)||empty($roll_no)||empty($college)||empty($year)||empty($image)) {
		header("Location: ../index.php?Do_not_leave_empty_places");
		exit();		
	}else
	{
		$sql="SELECT * FROM example2 WHERE roll_no='$roll_no'";
		$result=mysqli_query($conn,$sql);
		$resultcheck=0;
		$row=mysqli_fetch_array($result,MYSQLI_NUM); 
			$rowcount=count($row);
			$i=0;
			while ($i<$rowcount) {
				if($row[$i]==""){

				}else{
					$resultcheck++;
				}
				$i++;
			}
			if($resultcheck>0){
			header("Location: ../index.php?invalid_roll_no")	;
			exit();
		}else{
			$sql="INSERT INTO example2 (name,roll_no,college,year,image) VAlUES ('$name','$roll_no','$college','$year','$image')";
			mysqli_query($conn, $sql);//it only selects the ones it is adding to the database
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
				$msg="Image uploaded";
			}else{
				$msg="error";
			}		
			echo $msg;
			$result1=mysqli_query($conn, "SELECT * FROM example2");//over here
			$row1=mysqli_fetch_array($result1,MYSQLI_NUM);
			$row1count=count($row1);
			$i=0;
			echo $row1count;
			/*while ($i<$row1count) {
				echo $row1[$i];
				$i++;
			}*/
		}
	}
}else{
	header("Location: ../index.php");
	exit();
}

}?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="../index.php">
		<button type="submit" name="submit4">Home</button>
	</form>
</body>
</html>