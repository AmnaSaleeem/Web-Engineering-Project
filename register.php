<?php 

session_start();
	if(isset($_SESSION['user']))
	{
		header('location:index.php');
	} ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		#register-btn{
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
	</style>
</head>
<body>
	<!-- HEADER  -->
	<?php include('header.php');?>
	<!-- HEADER  -->

	<!-- CONTENT  -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 rounded mt-3 border border-2">
				<h3 class="text-center text-light" align="center" style="background-color: #52ab98;">Register YourSelf To Explore Blogs</h3>
					<!-- message from other page -->
					<div class="col-md-12 alert alert" role="alert">
					<?php if(isset($_GET['msg']))
							echo $_GET['msg'];
					 ?>
					 </div>
					<!-- message from other page -->
					<form class="row g-3" action="../back-end-pages/register_process.php" method="POST" enctype="multipart/form-data">
				  		<div class="col-md-12">
				    		<label for="validationDefault01" class="form-label">First name</label>
				    		<input type="text" class="form-control" id="validationDefault01" name="firstname" required>
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Last name</label>
						    <input type="text" class="form-control" id="validationDefault02" name="lastname" required>
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Email</label>
						    <input type="email" class="form-control" id="validationDefault02" name="email" required>
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Password</label>
						    <input type="password" class="form-control" id="validationDefault02" name="password" required>
				  		</div>
				  		<div class="col-md-1">
				    		<label for="validationDefault03" class="form-label">Gender</label>
						</div>
						<div class="col-md-11" style="word-spacing: 40px;">
							<input type="radio" name="gender" value="male" required align="center">Male
							<input type="radio" name="gender" value="female" required align="c">Female
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Date Of Birth</label>
						    <input type="date" class="form-control" id="validationDefault02" name="dateofbirth" required>
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Select Profile Image</label>
						    <input type="file" class="form-control" id="validationDefault02" name="profileimage" required>
				  		</div>
				  		<div class="col-md-12">
						    <label for="validationDefault02" class="form-label">Address</label>
						    <textarea name="address" placeholder="Enter Address Here" style="width:100%"></textarea>
						</div>
						<div class="col-md-12 text-center">
							<input type="submit" name="submit" value="Register" class="btn btn" href="register_process.php" style="background-color:#c8d8e4">
					  </div>
					  <div class="col-md-12 text-center">
							<a class="btn btn-outline-success" href="login.php">Alreday Have Account</a>
					  </div>
					</form>
			</div>
			<div class="col-sm-"></div>
	<!-- CONTENT  -->
	<!-- FOOTER  -->
	<?php include('footer.php'); ?>
	<!-- FOOTER  -->
</body>
</html>