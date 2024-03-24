<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forget Password Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		table
		{
			background-color:  #f2f2f2;
			border: 3px solid black;
			width: 50%;
			height: 100px;
		}
		#dropdownMenuLink{
			display: none;
		}
	</style>
	
</head>
<body>
	<?php require('header.php'); ?>
	<table align="center" >
					<h3 align="center" >Forget password Form</h3>
					<form action="" method="POST">
						<tr>
							<td>Enter Your Email</td>
							<td><input type="email" name="email" required></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" name="submit" value="Submit"/></td>
						</tr>
						
					</form>
				</table>
	<?php require('footer.php'); ?>
</body>
</html>
<!-- Check Email -->
<?php 
require('../back-end-pages/dbconnect.php');
if(isset($_POST['submit']))
{
	$query="SELECT email FROM user WHERE EMAIL='".$_POST['email']."'";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result))
	{
		session_start();
		$_SESSION['user_email']=$_POST['email'];
		$Toemail=$_POST['email'];

		if(mail('Ahtishamsaleem76@gmail.com','THIS EMAIL IS AUTO GENERATED DONOT REPLY THIS','CLICK THE LINK BELOW TO RESET THE PASSWORD \n http://localhost/18406/Final%20Project(Online%20Blogging%20Application)/front-end-pages/newpassword.php'))
		{
			?>
			<div class="alert alert-success text-center">Mail Sent Check Your Inbox</div>
	 		<?php
		}
		else
		{
			?>
	 		<div class="alert alert-warning text-center">Connection Problem Please try Again</div>
	 		<?php	
		}
	}
	else
	{
		?>
	 	<div class="alert alert-danger text-center">No Such Email Exist Or Enter Correct Email</div>
	 	<?php
	}
}
 ?>
