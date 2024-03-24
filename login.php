
<?php 
session_start();
	if(isset($_SESSION['user']))
	{
		header('location:index.php');
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="jquery-3.5.1.js" ></script>
	<style type="text/css">
		a{
			text-decoration: none;
			margin-left: 10px;
			margin-top: 10px;
		}
		#login-btn{
			display: none;
		}
		#contact_us{
			display: none;
		}
		#about_us{
			display: none;
		}
		#dropdownMenuLink
		{
			display: none;
		}
		#our_team
		{
			display: none;
		}
	</style>

</head>
<body >
		<?php include('header.php'); ?>
		<hr>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2"></div>
					<div class="col-sm-8 p-3" style="height: 380px;" id="forgetform">
						<h3 class="text-center text-light rounded" style="background-color: #52ab98">Blogging Application</h3>
							<!-- message from php -->
							<div class="alert alert-warning text-center col-sm-12" role="alert">
							<?php 
							if(isset($_GET['msg']))
								echo $_GET['msg'];
							 ?>
							 </div>
							<!-- message from php -->

							<form class="row g-3" action="../back-end-pages/login_process.php" method="POST">
					  			<div class="col-md-12 text-dark">
					    			<label for="validationServer01" class="form-label">Enter Email</label>
					    			<input type="email" name="email" class="form-control is-valid" id="validationServer01" placeholder="Enter Email Address here" required>
					    		
					  			</div>
					  				<div class="col-md-12 text-dark">
					    				<label for="validationServer01" class="form-label">Enter Password</label>
					    				<input type="password" name="password" class="form-control is-valid" id="validationServer01" placeholder="Enter Password here" required>
					    		
					  				</div>
					 
					  				<div class="col-12 text-center">
					    				<input class="btn btn" type="submit" name="submit" value="Login" style="background-color:#c8d8e4">
					    				<br>
					    				<a href="forgetlink.php" class="btn btn-outline-danger">Forget Password</a>
					    				<a href="register.php" class="btn btn-outline-success">Register New Account</a>
					  				</div>
							</form>
					</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<?php include('footer.php'); ?>
</body>
</html>