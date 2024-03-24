<?php 
	require('../back-end-pages/dbconnect.php');
	session_start();
		/*ADD MESSAGE*/
		if(isset($_GET['action'])&&$_GET['action']=='AddMessage')
			{
			$query="INSERT INTO post_comment (post_id,user_id,comment) 
					VALUES ('".$_GET['post_id']."','".$_SESSION['user']['user_id']."','".$_GET['message']."')";
			$result=mysqli_query($connection,$query);
			}
		/* SHOW COMMENTS*/
		elseif(isset($_GET['action'])&&$_GET['action']=='show_chat')
		{
			$query="SELECT * FROM post_comment,USER,post
					WHERE post_comment.`user_id`=user.`user_id`
					AND post_comment.`post_id`=post.`post_id` 
					AND post_comment.`post_id`='".$_GET['post_id']."' 
					AND post_comment.`is_active`='Active'";
			$result=mysqli_query($connection,$query);
			if(mysqli_num_rows($result))
			{
				while($comments=mysqli_fetch_assoc($result))
				{
					?>
					<div class="alert alert-success">
						<img src="<?php echo $comments['user_image']; ?>" style="width:50px;height: 50px;">
						<?php echo $comments['comment']; ?>
						<span>(<?php echo $comments['first_name']; ?>)</span>
						<span style="float:right"><?php echo $comments['created_at']; ?></span>
					</div>
					<?php
				}
			}
			else
			{
				?>
					<div class="alert alert-warning">No Comment Added Yet Be The First</div>
				<?php
			}}
		/*VIEW ALL COMMNENTS*/
		elseif(isset($_GET['action'])&&$_GET['action']=='viewallcomments')
		{
				?>
				<table class="table">
					<thead class="thead-dark">
						<tr >
							<th>Comment Id</th>
							<th>Post Title</th>
							<th>User Name</th>
							<th>Comment</th>
							<th>Status</th>
							<th>Created At</th>
							<th colspan="2">Change Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query="SELECT * FROM post_comment,USER,post WHERE post_comment.`user_id`=user.`user_id` AND post_comment.`post_id`=post.`post_id`;";
						$result=mysqli_query($connection,$query);
						if(mysqli_num_rows($result))
						{
							while($comments=mysqli_fetch_assoc($result))
							{
						 ?>
						
								<tr class="table-primary">
									<td><?php echo $comments['post_comment_id'];?></td>
									<td><?php echo $comments['post_title'];?></td>
									<td><?php echo $comments['first_name']." ".$comments['last_name'];?></td>
									<td><?php echo $comments['comment'];?></td>
									<td><?php echo $comments['is_active'];?></td>
									<td><?php echo $comments['created_at'];?></td>
									<td>
										<button onclick="postactive(<?php echo $comments['post_comment_id'];?>)" class="btn btn-success">
										Active
										</button>
									</td>
									<td><button onclick="postinactive(<?php echo $comments['post_comment_id'];?>)" class="btn btn-danger">InActive</button></td>
								</tr>
							<?php }
						} 
						else {?>
						<tr>
							<td align="center"><?php echo "NO Record Found" ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php
			}
		/*CHANGE COMMENT TO ACTIVE*/
		elseif(isset($_GET['action'])&&$_GET['action']=='active')
		{
				$query="UPDATE post_comment SET is_active='Active' 
						WHERE post_comment_id='".$_GET['id']."'";
				$result=mysqli_query($connection,$query);

				if($result)
				{
					?>
					<div class="alert alert-success" role="alert">
						 Status Change Successfully....
					</div>
					<?php
				}
				else
				{
					?>
					<div class="alert alert-success" role="alert">
					Status Not Change....!
					</div>
					<?php	
				}
		}
	/*Inactive Commets to Inactive*/
		elseif(isset($_GET['action'])&&$_GET['action']=='inactive')
		{
			$query="UPDATE post_comment SET is_active='InActive' 
					WHERE post_comment_id='".$_GET['id']."'";
			$result=mysqli_query($connection,$query);

			if($result)
			{
				?>
				<div class="alert alert-success" role="alert">
					 Status Change Successfully....
				</div>
				<?php
			}
			else
			{
				?>
				<div class="alert alert-success" role="alert">
				Status Not Change....!
				</div>
				<?php	
			}
		}

 ?>