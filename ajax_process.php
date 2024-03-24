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
			/*Work FOR USER REQUEST*/
			if(	isset($_GET['action'])	&&	$_GET['action']=='accept'	)
				{
					$user_id=$_GET['user_id'];
					$query="UPDATE user SET is_approved='Approved' WHERE user_id='".$user_id."'";
					$result=mysqli_query($connection,$query);
					// GET RECORD IN TABLE
					echo GetTableRequest();
				}
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='reject'	)
				{
					$user_id=$_GET['user_id'];
					$query="UPDATE user SET is_approved='Rejected' WHERE user_id='".$user_id."'";
					$result=mysqli_query($connection,$query);
					echo GetTableRequest();
				}
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='gettable'	)
				{
					echo GetTableRequest();
				}
			/*Work FOR USER REQUEST*/

			/*Work For USER STATUS*/
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='active'	)
				{
					$user_id=$_GET['user_id'];
					$query="UPDATE user SET is_active='Active' WHERE user_id='".$user_id."'";
					$result=mysqli_query($connection,$query);
					// GET RECORD IN TABLE
					echo GetTableStatus();
				}
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='inactive'	)
				{
					$user_id=$_GET['user_id'];
					$query="UPDATE user SET is_active='InActive' WHERE user_id='".$user_id."'";
					$result=mysqli_query($connection,$query);
					echo GetTableStatus();
				}
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='gettablestatus'	)
				{
					echo GetTableStatus();
				}
			/*Work For USER STATUS*/

			/*WORKING WITH VIEW ALL USER*/
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='ViewAllUser'	)
				{
					echo ViewAllUser();
				}
				/*edit RECORD SHOW IN MODEL*/
			elseif(	isset($_GET['action'])	&&	$_GET['action']=='edit'	)
				{
					// echo UpdateForm();
					?>
					<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body" style="background-color: #2b6777">
					        	<table align="center">
					       
					        		<?php
					        		$query="SELECT * FROM user WHERE user_id='".$_GET['user_id']."'";
					        		$result=mysqli_query($connection,$query);
					        		if(mysqli_num_rows($result))
					        		{
					        			$data=mysqli_fetch_assoc($result);
					        		 ?>
					        	<tr>
					        		<td>First Name</td>
					        		<td><input type="text" name="firstname" id="firstname" value="<?php echo $data['first_name']; ?>" required/>
					        		</td>
					        	</tr>
					        	<tr>
					        		<td>Last Name</td>
					        		<td><input type="text" name="lastname" id="lastname" value="<?php echo $data['last_name']; ?>"required/>
					        		</td>
					        	</tr>
					        	<tr>
					        		<td>Email</td>
					        		<td><input type="email" name="email" id="email" value="<?php echo $data['email']; ?>"required/>
					        		</td>
					        	</tr>
					        	<tr>
					        		<td>Password</td>
					        		<td><input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" required/>
					        		</td>
					        	</tr>
					        	<tr>
					        		<td>Date Of Birth</td>
					        		<td><input type="date" name="dateofbirth" id="dateofbirth"  value="<?php echo $data['date_of_birth']; ?>">
					        		</td>
					        	</tr>
					        	<tr>
					        		<td>Address</td>
					        		<td><textarea  name="address" id="address"> <?php echo $data['address']; ?></textarea>
					        		</td>
					        	</tr>
					        <?php } ?>

					        <tr>
					        	<input type="hidden" id="user_id" value="<?php echo $data['user_id']; ?>">
					        </tr>
					        </table>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					        <button type="button" class="btn btn-primary" onclick="updating()">Update</button>
					      </div>
					    </div>
					  </div>
				</div>
					<?php
				}
				/*UPDATE THE RECORD */
			elseif (isset($_GET['action'])&&$_GET['action']=='update')
				{
					date_default_timezone_set('asia/karchi');
					$query="UPDATE user
							 SET first_name='".$_GET['firstname']."',
							 	 last_name='".$_GET['lastname']."',
							 	 email='".$_GET['email']."',
							 	 password='".$_GET['password']."',
							 	 date_of_birth='".$_GET['dateofbirth']."',
							 	 address='".$_GET['address']."',
							 	 updated_at='".date('d-m-Y h:i:s')."'
							WHERE user_id='".$_GET['userid']."' ";

					$result = mysqli_query($connection,$query);
		
					if($result){
						?>
						<div class="alert alert-success">RECORD UPDATED SUCCESSFULLY...</div>
						<?php
					}
					else
					{
						?>
						<div class="alert alert-warning">RECORD NOT UPDATE..</div>
						<?php	
					}
				}
			/*FORGET PASSWORD FORM*/
			elseif(isset($_GET['action'])&&$_GET['action']=='forgetform')
				{	
					
					?>
					<table id="fotgetform"  align="center">
						<h3 align="center" >Forget password Form</h3>
						<tr>
							<td>Enter Your Email</td>
							<td><input type="email" name="email" id="email"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><button type="submit" onclick="forgetpassword()">Submit</button></td>
						</tr>
						<tr>
							<td><?php if(isset($_GET['msg']))
							{
								echo $_GET['msg'];
							} ?></td>
						</tr>
					</table>
					<?php
				}
			/*CHECK EMAIL FOR FORGET PASSWORD*/
			elseif(isset($_GET['action'])&&$_GET['action']=='forgetpassword')
				{
					$query="SELECT email FROM USER WHERE email = '".$_GET['email']."' ";
					$result=mysqli_query($connection,$query);
					if(mysqli_num_rows($result))
					{
						session_start();
						$_SESSION['useremail']=$_GET['email'];
						if(mail($_GET["email"],'THIS EMAIL IS AUTO GENERATED','CHECK THE LINK TO RESET THE PASSWORD http://localhost/18406/Final%20Project(Online%20Blogging%20Application)/verison1.2.2/front-end-pages/forgetlink.php'))
						{
							header('location:login.php?msg=Mail Send Check Email Inbox');
						}
					}
					else
					{
						header('location:login.php?msg=EMAIL DOES NOT EXIST');
					}
				}

			/*FORGET PASSWORD FORM*/
			/*CHANGE PASSWORD*/
			elseif(isset($_GET['action'])&&$_GET['action']=='change_password')
				{
					if($_GET['password']==$_GET['confirmpassword'])
					{
						session_start();
						//echo $_SESSION['useremail'];
					
						$query="UPDATE user SET password='".$_GET['password']."' WHERE email='".$_SESSION['useremail']."'";
						$result=mysqli_query($connection,$query);
							if($result)
							{
								echo "valid";
								session_destroy();
								header('location:login.php?msg=Password Change Successfully....! ');	

							}

					}
					else
					{
							echo "invalid";
						header('location:login.php?msg=password Did Not Match....! ');
						//echo "password Did Not Match";
					}
				}
			/*CHANGE PASSWORD*/

			/*View All FeedBacks*/
			elseif(isset($_GET['action'])&&$_GET['action']=='viewallfeedback')
				{
					?>
					<table class="table">
						<thead class="thead-dark">
							<tr >
								<th>Feedback Id</th>
								<th>User Id</th>
								<th>User Name</th>
								<th>User Email</th>
								<th>Feedback</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$query="SELECT * FROM user_feedback";
							$result=mysqli_query($connection,$query);
							if(mysqli_num_rows($result))
							{
								while($feedbacks=mysqli_fetch_assoc($result))
								{
							 ?>
							
									<tr class="table-primary">
										<td><?php echo $feedbacks['feedback_id'];?></td>
										<td><?php echo $feedbacks['user_id'];?></td>
										<td><?php echo $feedbacks['user_name'];?></td>
										<td><?php echo $feedbacks['user_email'];?></td>
										<td><?php echo $feedbacks['feedback'];?></td>
										<td><?php echo $feedbacks['created_at'];?></td>
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
			/*View All FeedBacks*/

			/*VIEW ALL FOLLOWER*/
			elseif(isset($_GET['action'])&&$_GET['action']=='countfollower')
				{
					?>
					<table class="table">
						<thead class="thead-dark">
							<tr >
								<th>Blog Title</th>
								<th>Total Follower</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							/*GETTING TOTAL FOLLOWER*/
							$query="SELECT * , COUNT(f.`follow_id`)AS total_Follower  FROM following_blog f INNER JOIN blog b 
									WHERE f.`blog_following_id`=b.`blog_id` AND  status='Followed'";
							$result=mysqli_query($connection,$query);
							$total=mysqli_fetch_assoc($result);
							$total_follower=$total['total_Follower'];
							/*GETTING TOTAL FOLLOWER*/
							$query="SELECT distinct blog_following_id FROM following_blog WHERE status='Followed';";
							$result=mysqli_query($connection,$query);
							if(mysqli_num_rows($result))
							{
								while($follow=mysqli_fetch_assoc($result))
								{
							 ?>
							
									<tr class="table-primary">
										
										<td><?php echo $total['blog_title'];?></td>
										
										<td><?php echo $total_follower;?></td>
										<td><button class="btn btn-success" onclick="view_all_follower(<?php echo $follow['blog_following_id']; ?>)">View All</button></td>
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

			elseif(isset($_GET['action'])&&$_GET['action']=='viewallfollower')
				{
					?>
					<table class="table">
						<thead class="thead-dark">
							<tr >
								<th>Follow Id</th>
								<th>Follower Name</th>
								<th>Blog Title</th>
								<th>Status</th>
								<th>Created At</th>
								<!-- <th>Updated At</th> -->
							</tr>
						</thead>
						<tbody>
							<?php 
							/*GETTING TOTAL FOLLOWER*/
				
							/*GETTING TOTAL FOLLOWER*/
							$query="SELECT * FROM following_blog,USER,blog 
							WHERE STATUS='Followed' AND blog_following_id='".$_GET['blogid']."'
						 	AND following_blog.`follower_id`=user.`user_id`
 							AND blog.blog_id= following_blog.`blog_following_id`";
 							$result=mysqli_query($connection,$query);
 							if(mysqli_num_rows($result))
 							{
 								while($data=mysqli_fetch_assoc($result))
 								{
							 ?>
							
									<tr class="table-primary">
										<td><?php echo $data['follow_id'];?></td>
										<td><?php echo $data['first_name'];?></td>
										<td><?php echo $data['blog_title'];?></td>
										<td><?php echo $data['status'];?></td>
										<td><?php echo $data['created_at'];?></td>
										<!-- <td><?php echo $data['updated_at'];?></td> -->
										
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
			/*VIEW ALL FOLLOWER*/

		/*Function  FOR TABLE Requests */
			function GetTableRequest()
			{
				?>
					<table class="table mt-3">
								<thead>
										<tr class="text-center" style="background-color:#f2f2f2;">
											<th>User Name</th>
											<th>User Email</th>
											<th>User Gender </th>
											<th>User Date Of Birth</th>
											<th>Address</th>
											<th>User Request</th>
											<th>User Account Created Date</th>
											<th colspan="2">Change Status</th>
										</tr>
								</thead>	<!-- GET RECORD FROM DATA BASE -->
											<?php 
											require('../back-end-pages/dbconnect.php');
											$query="SELECT * FROM USER WHERE is_approved='Pending' OR is_approved='Rejected'";
											$result=mysqli_query($connection,$query);
											if(mysqli_num_rows($result))
											{
												while ($data=mysqli_fetch_assoc($result))
												{   								
											 ?>
								<tbody>	<!-- GET RECORD FROM DATA BASE -->
										<tr class="text-center" style="background-color: #c8d8e4;">
											<td><?php echo $data['first_name'].$data['last_name']; ?></td>
											<td><?php echo $data['email']; ?></td>
											<td><?php echo $data['gender']; ?></td>
											<td><?php echo $data['date_of_birth']; ?></td>
											<td><?php echo $data['address']; ?></td>
											<td><?php echo $data['is_approved']; ?></td>
											<td><?php echo $data['created_at']; ?></td>
											<td>
											<a onclick="accept(<?php echo $data['user_id']; ?>)" class="btn btn" style="background-color: #52ab98;">Approved</a>
											</td>
											<td>
											<a onclick="reject(<?php echo $data['user_id']; ?>)" class="btn btn" style="background-color: #52ab98;">Rejected</a> 
											</td>
										</tr>
									</tbody>
									<?php
										 	}
										 }
										 	else{
										 ?>
										 <td colspan="8" align="center">NO USER REQUEST</td>
										 <?php 
											
											 }
									  ?> 
									</table>
				<?php
			}

			/*Function  FOR TABLE status */
			function GetTableStatus()
			{
				?>
					<table class="table mt-3">
						<thead>
										<tr class="text-center">
											<td>User Name</td>
											<td>User Email</td>
											<td>User Gender </td>
											<td>User Date Of Birth</td>
											<td>Address</td>
											<td>User Status</td>
											<td>User Account Created Date</td>
											<td colspan="2">Change Status</td>
										</tr>
						</thead>				<!-- GET RECORD FROM DATA BASE -->
											<?php 
											require('../back-end-pages/dbconnect.php');
											$query="SELECT * FROM USER WHERE
											is_active = 'Active' OR is_active='InActive' OR is_active IS NULL
											HAVING role_id='2'
											";
											$result=mysqli_query($connection,$query);
											if(mysqli_num_rows($result))
											{
												while ($data=mysqli_fetch_assoc($result))
												{   								
											 ?>
						<tbody>					<!-- GET RECORD FROM DATA BASE -->
										<tr class="text-center">
											<td><?php echo $data['first_name'].$data['last_name']; ?></td>
											<td><?php echo $data['email']; ?></td>
											<td><?php echo $data['gender']; ?></td>
											<td><?php echo $data['date_of_birth']; ?></td>
											<td><?php echo $data['address']; ?></td>
											<td><?php echo $data['is_active']; ?></td>
											<td><?php echo $data['created_at']; ?></td>
											<td>
											<a onclick="active(<?php echo $data['user_id']; ?>)" class="btn btn" style="background-color: #52ab98;">Active</a>
											</td>
											<td>
											<a onclick="inactive(<?php echo $data['user_id']; ?>)" class="btn btn" style="background-color: #52ab98;">InActive</a> 
											</td>
										</tr>
									<?php
										 	}
										 }
										 	else{
										 ?>
										 <td colspan="8" align="center">NO USER </td>
										 <?php 
											
											 }
									  ?>
						</tbody>			   
									</table>
				<?php
			}
				

 ?>