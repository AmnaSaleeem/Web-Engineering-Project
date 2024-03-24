<?php 
session_start();
require('../back-end-pages/dbconnect.php');
	if( isset($_SESSION['user'])&&$_SESSION['user']['role_id']==1)
		{
			header('location:admin-panel.php');
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Blogging Application</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
			ul li{
				font-size: 20px;
			}
			.imgheight{
				height: 200px;
				width: 100%;
			}
			.imgteam{
				height: 100px;
				/*image-rendering: auto;*/
			}
			p.card-title{
				white-space: nowrap; 
				  width: 100px; 
				  overflow: hidden;
				  text-overflow: ellipsis; 
				  border: 1px solid #000000;
			}
			#featuredcard{
				background-color: #c8d8e4;
				margin: 5px;
			}
			<?php if(!isset($_SESSION['user'])){ ?>
				#commentbtn{
					display: none;
				}
				#dropdownMenuLink
				{
					display: none;
				}
			<?php } ?>
			/*h4.card-title{
				white-space: nowrap; 
				  width: 350px; 
				  overflow: hidden;
				  text-overflow: ellipsis; 
				  border: 1px solid #000000;
			}*/
			#scrollcat{
				overflow-y: scroll;
				height: 400px;
				width: 100%;
				
			}
			#latestposts{
				overflow-y: scroll;
				height: 400px;
				width: 100%;
				padding: 0px;
				margin: 0px;	
				
			}
	</style>
</head>
<body>
	<!-- header -->
 	<?php require('header.php'); ?>
 	<!-- slider -->
 	<?php include('user-slider.php'); ?>
 	<!-- main body -->
 	<div class="container" >
 		<div class="row mt-4" >
 			<!-- LFET SIDE -->
 			<div class="col-sm-2">
				<h2>Categories</h2>

 				<ul style="" id="scrollcat">
 					<!-- GETTING CATEGORY FROM DATABASE -->
 					<?php
 					 $query="SELECT * FROM category  WHERE category_status='Active'";
 					 $result=mysqli_query($connection,$query);
 					 while($data=mysqli_fetch_assoc($result))
 					 {
 					 ?>

 					<li ><?php echo $data['category_title']; ?></li>
 					<?php } ?>
 				</ul>
 			</div>
 			<!-- Center -->
 			 	<div class="col-8">
 			 		<!-- PAgination -->
 			 		
 			 		<?php require('pagination.php'); ?>
 			 		<!-- PAgination -->
 			 		<!-- GETTING POST -->
 			 		<?php 
 			 			$query = "SELECT * FROM `post` ORDER BY `post`.`post_id` DESC LIMIT $start, $per_page ";
 			 			$result=mysqli_query($connection,$query);
 			 			while($posts=mysqli_fetch_assoc($result))
 			 			{
 			 		 ?>
		 				<div class="card text-center" id="featuredcard">
						  <div class="card-header">
						    Featured
						  </div>
						  <div class="card-body">
						    <h5 class="card-title"><?php echo $posts['post_title'];?></h5>
						    <p class="card-text"><?php echo $posts['post_summary'];?></p>
						    <a class="btn btn-secondary" href="comments.php?post_id=<?php echo $posts['post_id'];?>" id="commentbtn" >Comment</a>
						  </div>
						  <div class="card-footer text-muted">
						    <?php
						     echo $posts['created_at'];
						     ?>
						  </div>
						</div>
					<?php } ?>
 				
 				</div>


			<!-- Right Side  -->
			<div class="col-sm-2">
				<h2>Latest Posts</h2>
				<div class="col-sm-12" id="latestposts">
						<?php 
						$query="SELECT * FROM post WHERE post_status='Active' ";
						$result=mysqli_query($connection,$query);
						while($data=mysqli_fetch_assoc($result))
						{ 
						?>
					<div class="card mb-3" style="width:auto;height: 120px;">
						<div class="row g-0">
							<div class="col-md-4">
							 	 <img src="<?php echo $data['featured_image'];?>" class="img-fluid rounded-start" alt="..." style="height:100px">
							</div>
							<div class="col-md-8">
								  <div class="card-body">
								    <p class="card-title" id="title"><?php echo $data['post_title']; ?></p>
								    <p class="card-text"><!-- <?php echo $data['post_summary']; ?> -->
								 <small class="text-muted"><?php echo $data['created_at']; ?></small></p>
								  </div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
 	</div>
 </div>
 	<div class="container">
 		<div class="row mt-4">
            <div class="col-12">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                            	<?php 
                            	$query="SELECT * FROM post WHERE post_status='Active' HAVING post_id < 44";
								$result=mysqli_query($connection,$query);
								while($data=mysqli_fetch_assoc($result))
								{ 
                            	 ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card" style="height:380px">
                                    	<a href="comments.php?post_id=<?php echo $data['post_id']; ?>">
                                        <img class="img-fluid" alt="100%x280" style="height:200px;width: 100%" src="<?php echo $data['featured_image'];?>"></a>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $data['post_title'];?></h4>
                                            <p class="card-text">.</p>
                                            <a class="btn btn-secondary" href="comments.php?post_id=<?php echo $data['post_id'];?>" id="commentbtn">Comment</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>    
                            </div>
                        </div>   
 		</div>
 	</div>
 	
</div>
</div>
</div>
	<!-- MOST VIEW POSTS -->
	<div class="container mt-5 border border-2 ">
		<div class="row mb-3" >
			<div class="col-sm-12">
			<h1 align="center" class="display-5">MOST VIEWED POST</h1>
			</div>
			<?php 
			$query="SELECT * FROM post p ORDER BY p.`post_id` DESC LIMIT 1,4";
			$result=mysqli_query($connection,$query);
			while($lastposts=mysqli_fetch_assoc($result))
			{
			 ?>
			<div class="col-sm-3" ><a href="comments.php?post_id=<?php echo $lastposts['post_id'];?>"><img src="<?php echo $lastposts['featured_image'] ?>" class="imgheight"></a></div>
			<?php
			 }
			 ?>
		</div>
	</div>
	<!-- MOST VIEW POSTS -->
	
	<!-- OUR TEAM -->
	<div class="container mt-5" id="ourteam">
		<div class="row mb-5">
			<div class="col-sm-12">
				<h1 class="display-5" align="center"> OUR TEAM</h1>
					<div class="card-group" >
				  		<div class="card">
				    		<img src="images/team1.jpg" class="card-img-top" alt="..." class="imgteam">
				    	<div class="card-body">
				      	<h5 class="card-title">Card title</h5>
				      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				    </div>
				  </div>
				  <div class="card">
				    <img src="images/team2.jpg" class="card-img-top" alt="..." class="imgteam">
				    <div class="card-body">
				      <h5 class="card-title">Card title</h5>
				      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
				      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				    </div>
				  </div>
				  <div class="card">
				    <img src="images/team3.jpg" class="card-img-top" alt="..." class="imgteam">
				    <div class="card-body">
				      <h5 class="card-title">Card title</h5>
				      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				    </div>
				  </div>
				  <div class="card">
				    <img src="images/team5.jpg" class="card-img-top" alt="..." class="imgteam">
				    <div class="card-body">
				      <h5 class="card-title">Card title</h5>
				      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<!-- OUR TEAM -->


 	<div class="container position-aboslute mt-4" id="aboutus">
 		<div class="row">
 			<div class="col-sm-12 border border-dark border-1 shadow">
 				<h1 class="text-center text-decoration-underline" style="background-color: #f2f2f2;color: #52ab98;">About Us</h1>
 				<h3 class="text-center text-decoration-underline">--Our Stories--</h3>
 				<p class="text-center">
 					<img src="images/aboutus.jpg" style="width: 35%; height: 350px; float: left;">
		 				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		 				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		 				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		 				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		 				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		 				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		 				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		 				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		 				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		 				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		 				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		 				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
 			</p>
 			</div>
 		</div>
 	</div>
 	<!-- About Us Section -->

 	<!-- Contact Us Section -->
	<div class="container-fluid position-aboslute mt-4" id="contactus">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
 				<h1 class="text-center text-decoration-underline" >Contact Us</h1>
 				<h3 class="text-center text-decoration-underline" style="background-color: #f2f2f2;color: #52ab98;">--Give Your Valueable  (FEEDBACK)--</h3>
 				<div class="mb-3">
 					<form action="" method="POST">
				  <label for="exampleFormControlInput1" class="form-label">Enter Your Name</label>
				  <input type="text" name="fullname" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name Here" required>
				</div>
 				<div class="mb-3">
				  <label for="exampleFormControlInput1" class="form-label">Email address</label>
				  <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
				</div>
				<div class="mb-3">
				  <label for="exampleFormControlTextarea1" class="form-label">Feed Back</label>
				  <textarea class="form-control" name="feedback" id="exampleFormControlTextarea1" rows="3" required></textarea>
				</div>
				<div class="mb-3 text-center">
				  	<input type="submit" name="submit" value="Submit" class="btn btn" style="background-color:#52ab98">				
				</div>
				</form>
			</div>
			<div class="col-sm-2"></div>
		</div>	
	</div>

	<?php require('footer.php'); ?>


</body>
</html>

<?php  
if(isset($_POST['submit']))
{
	extract($_POST);
	if($fullname!=''&& $email!='' &&$feedback!='')
	{
		$query="SELECT * from user WHERE email='".$email."' ";
		$result=mysqli_query($connection,$query);
		if(mysqli_num_rows($result))
		{	$data=mysqli_fetch_assoc($result);
			$userid=$data['user_id'];
			$fname=$data['first_name'];
			$email=$data['email'];
		 	
			$queryInsertFeed="INSERT INTO user_feedback (user_id,user_name,user_email,feedback)
							VALUES('".$userid."','".$fname."','".$email."','".$feedback."')";
			$result1=mysqli_query($connection,$queryInsertFeed);			
			if($result1)
			{
				if(mail('Ahtishamsaleem76@gmail.com', 'New Feed Back Receive by user'.$name , $feedback))
				{
					?>
					<div class="alert alert-success">Feed back Send To Admin Successfully....</div>
					<?php
				}

			}
			else
			{
				echo "ERROR";
			}
		}
		else
		{
			$queryInsertFeed="INSERT INTO user_feedback(user_name,user_email,feedback)
							VALUES('".$fullname."','".$email."','".$feedback."') ";
			$result2=mysqli_query($connection,$queryInsertFeed);
			if($result2)
			{
				if(mail('Ahtishamsaleem76@gmail.com', 'New Feed Back Receive by user'. $name, $feedback))
				{
					?>
					<div class="alert alert-success">Feed back Send To Admin Successfully....</div>
					<?php
				}
			}
			else
			{
				echo "ERROR";
			}	
		}
	}
}

?>