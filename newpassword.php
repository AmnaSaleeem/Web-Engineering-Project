<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Password Form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		
		#about_us
		{
			display: none;
		}
		#contact_us{
			display: none;
		}
		#our_team{
			display: none;
		}
		#categories{
			display: none;
		}
		#dropdownMenuLink{
			display: none;
		}
	</style>
</head>
<body>
	<?php require('header.php'); ?>
			<form action="" method="POST">
				<table align="center" >
					<h3 align="center" >New Password password Form</h3>
						<tr>
							<td>Enter New Pasword</td>
							<td><input type="password" name="password" required></td>
						</tr>
						<tr>
							<td>Enter Confirm Password</td>
							<td><input type="password" name="confirmpasword" required></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" name="submit" value="Submit"/></td>
						</tr>
				</table>
			</form>
	<?php require('footer.php'); ?>
</body>
</html>
<!-- Update New Password -->
<?php 
require('../back-end-pages/dbconnect.php');
		if(isset($_POST['submit']))
			{
				if(($_POST['password'])==$_POST['confirmpasword'])
				{
					session_start();
					$email=$_SESSION['user_email'];
					$query="UPDATE user SET password='".$_POST['password']."' WHERE email ='".$email."'";
					$result1=mysqli_query($connection,$query);
					if($result1)
					{
						session_destroy();
						echo "Password Change Successfully";
					}
					else
					{
						echo "There is problem try again";
					}
				}
				else
				{
					echo "Password Not Same";
				}
			}	


 ?>