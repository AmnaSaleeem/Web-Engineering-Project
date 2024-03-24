<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apply Your Setting To post</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	
</head>
<body class="bg-danger">
	<center>
		<h3 class="display-5 mb-5">SELECT YOUR POST SETTING </h3>
	<table border="3" class="bg-dark text-light" id="table">
		<form action="" method="POST">
		<tr>
			<td>SELECT BACKGROUND COLOR</td>
			<td><input type="color" name="bgcolor"></td>
		</tr>
		<tr>
			<td>SELECT FONT SIZE</td>
			<td><input type="number" name="fontsize"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Apply Setting" class="btn btn-success"></td>
		</tr>
		</form>
	</table>
	</center>
</body>
</html>

<?php 
require('../back-end-pages/dbconnect.php');
	session_start();
	if(isset($_POST['submit']))
	{
		unset($_POST['submit']);
		foreach ($_POST as $key => $value) 
		{
			$query="INSERT INTO setting(user_id,setting_key,setting_value)
								VALUES('".$_SESSION['user']['user_id']."',
										'".$key."',
										'".$value."')";
			$result=mysqli_query($connection,$query);
		}
		if($result)
		{
			header('location:blogs.php');
		}
	}

 ?>