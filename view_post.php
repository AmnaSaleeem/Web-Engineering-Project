<?php 
require('../back-end-pages/dbconnect.php');
session_start();

if(isset($_GET['action'])&&$_GET['action']=='view_all_posts_of_blog')
{	
  	$querystatus="SELECT status,follower_id FROM following_blog
					WHERE blog_following_id='".$_GET['blogid']."' AND follower_id ='".$_SESSION['user']['user_id']."'";
	$resultstatus=mysqli_query($connection,$querystatus);
	$status=mysqli_fetch_assoc($resultstatus);	
	?>
	<center>
	<button class="btn btn-success mb-3" onclick="Followed(<?php echo $_GET['blogid'];?>)"><?php  ?>
		<?php if($status['status']=='Followed')
		{
			echo "Unfollowed";
		}
		else
		{
			echo "Follow";
		}
		 ?>
	</button>
	</center>
	<?php
	$query="SELECT * FROM post WHERE blog_id='".$_GET['blogid']."' AND post_status='Active'";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result))
	{
		while($posts=mysqli_fetch_assoc($result))
		{			
			?>
			<div class="card mb-3">
			  <div class="row g-0">
			    <div class="col-md-4">
			    	<a href="comments.php?post_id=<?php echo $posts['post_id']; ?>">
			      <img src="<?php echo $posts['featured_image'];?>" class="img-fluid rounded-start" alt="..." style="height:400px; width:100%"></a>  
			    </div>
			    <div class="col-md-8">
			      <div class="card-body" id="card">
			        <h5 class="card-title" id="posttitle"><b><u>POST TITLE : </u><b/><br>
			    	<?php echo $posts['post_title'] ?></h5>
			    	<!-- CATEGORY TITLE -->
			    	<?php 
			    	$query1="SELECT DISTINCT c.category_title FROM category c INNER JOIN post_category pc
								ON c.`category_id`=pc.`category_id`
								WHERE post_id='".$posts['post_id']."'";

					$result1=mysqli_query($connection,$query1);
					while($cat=mysqli_fetch_assoc($result1)){
			    	 ?>
			    	<h5 class="card-title" id="posttitle"><b><u>CATEGORY TITLE : </u><b/><br>
			    	<?php echo $cat['category_title'];?></h5>
			    <?php } ?>
			    	<!-- CATEGORY TITLE -->
			        <p class="card-text"><b>POST SUMMARY : <b/><br>
			    	<?php echo $posts['post_summary']; ?></p>
			    	<p class="card-text"><b>POST Description : <b/><br>
			    	<?php echo $posts['post_description']; ?>
			    	</p>
			        <p class="card-footer"><small class="text-muted"><b>POST Cretaed At 
			    	<?php echo $posts['created_at'];?></b><br></small></p>
			    	<a class="btn btn-secondary" href="comments.php?post_id=<?php echo $posts['post_id'];?>" id="commentbtn" >Comment</a>
			      </div>
			    </div>
			  </div>
			</div>
			
			<?php
		}
	}
	else
	{
		?>
		<div class="alert alert-warning text-center">NO POST ADDED ON THIS BLOG</div>
		<?php
	}
}
elseif(isset($_GET['action'])&&$_GET['action']=='follow')
{
	if(isset($_SESSION['user']))
		{

		$querycheck="SELECT * FROM following_blog WHERE follower_id='".$_SESSION['user']['user_id']."' AND blog_following_id='".$_GET['blogid']."'";
		$resultcheck=mysqli_query($connection,$querycheck);
		if(mysqli_num_rows($resultcheck))
			{	
				$status=mysqli_fetch_assoc($resultcheck);
				if($status['status']=='Followed')
					{
						$query="UPDATE following_blog SET status='Unfollowed' WHERE follower_id='".$_SESSION['user']['user_id']."'";
						$result=mysqli_query($connection,$query);
						if($result)
						{
							?>
							<div class="alert alert-success text-center">YOU UNFOLLOW THE BLOG</div>
							<?php
						}
					}
				else
					{
					$query="UPDATE following_blog SET status='Followed'";
					$result=mysqli_query($connection,$query);
					if($result)
					{
						?>
						<div class="alert alert-success text-center">YOU FOLLOW THE BLOG</div>
						<?php
					}
					}
			}
		else
			{
				/*NEW USER FOLLOW BLOG*/
				$query="INSERT INTO following_blog (follower_id,blog_following_id) VALUES('".$_SESSION['user']['user_id']."','".$_GET['blogid']."')";
				$result=mysqli_query($connection,$query);
		
				if($result)
					{
						$query1="SELECT blog_title FROM blog WHERE blog_id='".$_GET['blogid']."'";
						$result=mysqli_query($connection,$query1);
						$title=mysqli_fetch_assoc($result);
						?>
						<div class="alert alert-success text-center">You Follow <?php echo $title['blog_title']; ?></div>
						<?php	
					}
			}
		}	
		else
		{
			?>
			<div class="alert alert-warning text-center">YOU NEED TO REGISTER OR LOGIN FOR TO FOLLOW THE BLOG</div>
			<?php
		}
}	


?>
