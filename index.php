<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form method="POST" action="includes/form1.inc.php" enctype="multipart/form-data"/>
	<input type="text" name="name" id="name" placeholder="Enter the name"  /><br>
	<input type="text" name="roll_no" id="roll_no" placeholder="Enter the Roll_no"/><br>
	<input type="text" name="college" id="college" placeholder="Enter the college"/><br>
	<input type="text" name="year" id="year" placeholder="Enter the Year"/><br>
	<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/><br>
	<input type="file" name="image" id="image" value=""/><br>
	<button type="submit" name="submit">Submit</button><br>
</form>
<form method="POST" action="includes/viewdbs.php">
	<button type="submit" name="submit1">View</button>
</form>
<form method="POST" action="includes/edit.php">
	<button type="submit" name="submit2">EditDB</button>
</form>
</body>
</html>