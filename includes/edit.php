<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title></title>
</head>
<body>
	<?php
	session_start();
	$cookie_name = "croll_no"; 
	$variable1=0;
	function test_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
 	 $data = htmlspecialchars($data);
 	 return $data;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		if ((!isset($_POST["submit2"]))&&(isset($_POST["submit3"]))&&(!isset($_POST["nsubmit"]))) 
		{
		include "dbh.inc.php";
			if(empty($_POST["croll_no"]))
			{
			echo "Error Empty";
			header("Location: edit.php");
			exit();
			}
			else
			{
			$cookie_value = test_input($_POST["croll_no"]);
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			$sql="SELECT * FROM example2 WHERE roll_no=".$_COOKIE[$cookie_name]."";
			$result=mysqli_query($conn, $sql);
				if ($result==="FALSE") 
				{
					echo "problem";
				}
				else
				{   /*$row=mysqli_fetch_assoc($result);
					echo $row['image'];
					$path="images/".$row['image'];
					unlink($path);
					$sqld="DELETE image from example2 WHERE roll_no=".$_COOKIE[$cookie_name]."";
					mysqli_query($conn, $sqld);*/
					if(!$variable1)
					{?>
					<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data"/>
					<input type="text" name="nname" id="nname" placeholder="Enter the new name"  /><br>
					<input type="text" name="ncollege" id="ncollege" placeholder="Enter the new college"/><br>
					<input type="text" name="nyear" id="nyear" placeholder="Enter the new Year"/><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/><br>
					<input type="file" name="nimage" id="nimage" value=""/><br>
					<button type="submit" name="nsubmit">Submit</button><br></form>
					<?php
					}
				}
			}
		}
		elseif (isset($_POST["nsubmit"])) 
		{	include "dbh.inc.php";
			$nnameErr=$ncollegeErr=$nyearErr="";
			$nname=$ncollege=$nyear=$nimage="";
			$msg="";
			if (mysqli_connect_errno())
  			{
  				echo "Failed to connect to MySQL: " . mysqli_connect_error();
  			}
  			if (empty($_POST["nname"])) 
  			{
    			$nnameErr = "Name is required";
  			} 
  			else 
  			{
    			$nname = test_input($_POST["nname"]);
  			}
  			if (empty($_POST["ncollege"])) 
  			{
    			$ncollegeErr = "college is required";
  			} 
  			else 
  			{
    			$ncollege = test_input($_POST["ncollege"]);
  			}
  			if (empty($_POST["nyear"])) 
  			{
    			$nyearErr = "year is required";
  			} 
  			else 
  			{
    			$nyear = test_input($_POST["nyear"]);
  			}
			$nimage=$_FILES['nimage']['name'];
			$ntarget="images/".$_FILES['nimage']['name'];
			if(move_uploaded_file($_FILES['nimage']['tmp_name'], $ntarget))
			{
				$msg="Image uploaded";
			}
			else
			{
				$msg="error";
			}
			if (empty($nname)||empty($ncollege)||empty($nyear)||empty($nimage)) 
			{
				header("Location: edit.php?Do_not_leave_empty_places");
				exit();		
			}
			else
			{	$sql="UPDATE example2 SET name='$nname', college='$ncollege', year='$nyear', image='$nimage' WHERE roll_no=".$_COOKIE[$cookie_name]." ";
				$result=mysqli_query($conn, $sql);
			}
	
		}
		else
		{

		}
	}	
	else
	{

	}
	?>
	<form method="POST" action="edit.php">
		<input type="text" name="croll_no" placeholder="Enter the Roll no to edit"/><br>
		<button type="submit" name="submit3">Submit</button>
	</form>
	<form method="POST" action="viewdbs.php">
		<button type="submit" name="submit1">View current DB</button>
	</form>
	<form method="POST" action="../index.php">
		<button type="submit" name="submit4">Home</button>
	</form>
</body>
</html>