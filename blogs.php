<?php 

session_start();
       if($_SESSION['user']['role_id']==2)
       {
         header('location:index.php');
       }
       elseif(!isset($_SESSION['user']))
       {
         header('location:index.php');
       }
require('../back-end-pages/dbconnect.php');
	$query="SELECT * FROM blog WHERE blog_status='Active'";
	$result=mysqli_query($connection,$query);
 	
 	$query1="SELECT * FROM setting";
	$result1=mysqli_query($connection,$query1);
	$postsetting=mysqli_fetch_assoc($result1);
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blogs</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<script type="text/javascript">
		function view_all_posts(id)
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
					document.getElementById('ajaxdiv').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','view_post.php?action=view_all_posts_of_blog&blogid='+id);
			obj.send();
		}
		/*FOLLOW FUNCTION*/
		function Followed(id)
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
					document.getElementById('msg').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','view_post.php?action=follow&blogid='+id);
			obj.send();
		}
		/*FOLLOW FUNCTION*/
	</script>
	<style type="text/css">
		
			<?php if(!isset($_SESSION['user'])){ ?>
				#commentbtn{
					display: none;
				}
				#commentsection
				{
					display: none;
				}
				#dropdownMenuLink
				{
					display: none;
				}
			<?php }
			else
			{
				if($postsetting['user_id']==$_SESSION['user']['user_id'])
				{
				while($postsetting=mysqli_fetch_assoc($result1))
					{
					?>
						#card
						{
							<?php if($postsetting['setting_key']=='bgimage')
									{
							?>
									background-image: url(<?php echo $postsetting['setting_value']; ?>);
							<?php
									}
							 elseif($postsetting['setting_key']=='bgcolor')
									{
							?>
									background-color:<?php echo $postsetting['setting_value']; ?>

							<?php
									}
							elseif($postsetting['setting_key']=='fontsize')
									{
							?>
										font-size:<?php echo $postsetting['setting_value']; ?>;
							<?php
									}
							?>
						}<?php
					}
				}
		}
		?>
		#editbtn{
			display: none;
		}
	
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-lg">
				  <div class="container-fluid  rounded" style="background-color: #2b6777">
				    <a class="navbar-brand" href="#">Blogs</a>
				    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				      <span class="navbar-toggler-icon"></span>
				    </button>
				    <div class="collapse navbar-collapse" id="navbarNav">
				      <ul class="navbar-nav">
				        <li class="nav-item">
				          <a class="nav-link active  border border-2 border-dark rounded text-light" aria-current="page" href="<?php if($_SESSION['user']['role_id']==1)
				          {echo 'admin-panel.php';} 
				          else{echo 'index.php';}
				      		?>">Home</a>
				        </li>
				        <?php 
				        	if(mysqli_num_rows($result))
				        	{
				        		while($blog=mysqli_fetch_assoc($result))
				        		{
				         ?>
				        <li class="nav-item">
				          <button class="btn btn text-light" 
				          onclick="view_all_posts(<?php echo $blog['blog_id'];?>)">
				          	<?php echo $blog['blog_title']; ?>
				          </button>
				        </li>
				    <?php } } ?>
				       
				      </ul>
				    </div>
				    <!-- DROP DOWN  MENU -->
				       <div class="dropdown">
								  <a class="btn btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    -- <?php echo $_SESSION['user']['first_name'];?> --
								  </a>
								  <ul class="dropdown-menu dropdown-menu-first bg-dark" aria-labelledby="dropdownMenuLink">
								    <li style="width: 5px;"><a id="btnsetting" class="btn btn-success text-light" href="setting.php">Setting</a></li>
								    <li><a class="btn btn-success text-light" type="submit" href="../back-end-pages/logout_process.php" id="logout-btn" style="margin-right: 10px;">Logout</a></li>
								    <li><button class="btn btn-success text-light" type="button" onclick="edit(<?php echo $_SESSION['user']['user_id'] ?>)" >Edit</button></li>
								  </ul>
							</div>
				    <!-- DROP DOWN  MENU -->
				  </div>
				</nav>
			</div>
		</div>
	</div>
	<div class="col-sm-12" id="msg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12" id="ajaxdiv">
				<h1 class="display-5 text-center">Random Posts</h1>
			
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
                                        <img class="img-fluid" alt="100%x280" style="height:200px; width:100%;" src="<?php echo $data['featured_image'];?>"></a>
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
</body>
</html>
