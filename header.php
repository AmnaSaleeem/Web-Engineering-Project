<?php
		require('../back-end-pages/dbconnect.php'); 
		session_start();
		?>
	<head>
	<script type="text/javascript" src="jquery-3.5.1.js" ></script>
	<script type="text/javascript" src="jquery.dataTables.min.js"></script>
	</head>
	<style type="text/css">
		<?php 
		if(isset($_SESSION['user']))
		{
		 ?>
			#login-btn
			{
				display: none;
			}
			#register-btn
			{
			display: none;
			}
		<?php
		 }
		else{
		 ?>
		 	#btnsetting{
		 		display: none;
		 	}
		 	#username{
		 		display: none;
		 	}
			#logout-btn
			{
				display: none;
			}
			#proimg{
				display: none;
			}
		<?php } ?>

		
		}
	</style>
	

	<script type="text/javascript">
		function edit(id)
		{
			var obj;
			if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4&&obj.status==200)
				{
					document.getElementById('model').innerHTML=obj.responseText;
					$('#staticBackdrop').modal('show');
				}
			}
			obj.open('GET','ajax_process.php?action=edit&user_id='+id);
			obj.send();
		}
		function updating()
			{
				var userid=document.getElementById('user_id').value;
				var firstname=document.getElementById('firstname').value;
				var lastname=document.getElementById('lastname').value;
				var email=document.getElementById('email').value;
				var password=document.getElementById('password').value;
				var dateofbirth=document.getElementById('dateofbirth').value;
				var address=document.getElementById('address').value;

				var obj;
				if(window.XMLHttpRequest)
				{
					obj=new XMLHttpRequest();
				}
				else
				{
					obj=new ActiveXObject('Microsoft.XMLHTTP');
				}
				obj.onreadystatechange=function()
				{
					if(obj.readyState==4&&obj.status==200)
					{
						$('#staticBackdrop').modal('hide');
						// document.getElementById('updated').innerHTML=obj.responseText;
					}
				}
				obj.open('GET','ajax_process.php?action=update&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&password='+password+'&dateofbirth='+dateofbirth+'&address='+address+'&userid='+userid);
				obj.send();
			}
	</script>

		<!-- Menu bar -->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<nav class="navbar navbar-expand-lg text-light" style="background-color: #2b6777">
					   
					    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					      <span class="navbar-toggler-icon"></span>
					    </button>
					    <div class="collapse navbar-collapse" id="navbarSupportedContent">
					      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					        <li class="nav-item">
					          <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link text-light" href="blogs.php">Blogs</a>
					        </li>
					        <li class="nav-item dropdown">
					          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="categories">
					            Categories
					          </a>
					          <ul class="dropdown-menu bg-dark">
					          	<?php 
					          	$query="SELECT * FROM category WHERE category_status='Active'";
					          	$result=mysqli_query($connection,$query);
					          	if(mysqli_num_rows($result))
					          	{
					          		while($cat=mysqli_fetch_assoc($result))
					          		{
					          	 ?>
					            <li><a class="dropdown-item text-light" href="#"><?php echo $cat['category_title']; ?></a></li>
					            
					        <?php } } ?>
					          </ul>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link text-light" href="#aboutus" id="about_us">About Us</a>
					        </li>
					        
					        <li class="nav-item">
					          <a class="nav-link text-light" href="#ourteam" id="our_team">Our Team</a>
					        </li>
					          <li class="nav-item">
					          <a class="nav-link text-light" href="#contactus" id="contact_us">Contact Us</a>
					        </li>
					      </ul>
					      <form class="d-flex">
					      	

					        <a class="btn btn-outline-success text-light" type="submit" style="margin-right: 10px;" id="login-btn" href="login.php">Login</a>
					        <a class="btn btn-outline-success text-light" type="submit" href="register.php" id="register-btn" style="margin-right: 10px;">Register</a>
							
							

					        <div class="dropdown" style="margin-right: 10px;">
					        	<img src="<?php echo $_SESSION['user']['user_image'];?>" style="height: 50px; width: 50px; border-radius: 30px;" id="proimg">
								  <a class="btn btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    <?php echo $_SESSION['user']['first_name'];?>
								  </a>
								  <ul class="dropdown-menu dropdown-menu-first " aria-labelledby="dropdownMenuLink" style="width:10px">
								  	 <li id="editbtn"><button  class="btn btn text-dark" type="button" onclick="edit(<?php echo $_SESSION['user']['user_id'] ?>)"  >Edit</button></li>
								    <li style="width: 5px;"><a id="btnsetting" class="btn btn text-dark" href="setting.php">Setting</a></li>
								    <li><a class="btn btn text-dark" type="submit" href="../back-end-pages/logout_process.php" id="logout-btn" style="margin-right: 10px;">Logout</a></li>
								   
								  </ul>
							</div>
					      </form>
					    </div>
					  </div>
					</nav>
				</div>
			</div>
		</div>
		<div id="model"></div>
		
