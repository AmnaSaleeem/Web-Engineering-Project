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

	/*Category FORM*/
	if(isset($_GET['action'])&&$_GET['action']=='addform')
		{
			?>
			<h3 align="center">ADD CATEGORY FORM</h3>
			<div class="mb-3">
				<form>
				  <label for="exampleFormControlInput1" class="form-label">Add Cateogory Title</label>
				  <input type="email" class="form-control" id="title" required >
			</div>
			<div class="mb-3">
				  <label for="exampleFormControlInput1" class="form-label">Add Category Description</label>
				  <input type="email" class="form-control" id="desc" required>
			</div>
			<div align="center">
				<button class="btn btn-success" onclick="AddCategory()">Add</button>
			</div>
				</form>
			<?php
		}

	/*Add Category*/
	elseif(isset($_GET['action'])&&$_GET['action']=='add')
	{
		$query="INSERT INTO category(category_title,category_description) VALUES('".$_GET['title']."','".$_GET['desc']."')";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			?>
			<div class="alert alert-success" role="alert">
				Category Add Successfully....
			</div>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-warning" role="alert">
				NOT ADDED....!
			</div>
			<?php	
		}
	}
	/*update Category FORM*/
	elseif(isset($_GET['action'])&&$_GET['action']=='updateform')
	{
		?>
		<h3 align="center">Update CATEGORY FORM</h3>
		<div class="mb-3">
			<form>
			  <label for="exampleFormControlInput1" class="form-label">Add Cateogory Title</label>
			  <input type="text" class="form-control" id="title" required >
		</div>
		<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Add Category Description</label>
			  <input type="text" class="form-control" id="desc" required>
			  
		</div>
		<div align="center">
			<button class="btn btn-info" onclick="UpdateCategory(<?php echo $_GET['id']; ?>)">Update</button>
		</div>
			</form>
		<?php
	}
	/*UPDATE CATEGORY*/
	elseif(isset($_GET['action'])&&$_GET['action']=='update')
	{
		$query="UPDATE category SET category_title='".$_GET['title']."',
									category_description='".$_GET['desc']."' 
				WHERE category_id='".$_GET['id']."'";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			?>
			<div class="alert alert-success" role="alert">
				Category Updated Successfully....
			</div>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-warning" role="alert">
				NOT Updated....!
			</div>
			<?php	
		}
	}
	/*VIEW ALL CATEGORY*/
	elseif(isset($_GET['action'])&&$_GET['action']=='viewall')
	{	
		// echo "HEllo";
		// die();	

		?>
		<h3 align="center">View All CATEGORY</h3>
		<table class="table">
			  <thead>
			    <tr>
			      <th>Category ID</th>
			      <th>Category Title</th>
			      <th>Category Description</th>
			      <th>Category Status</th>
			      <th>Created_At</th>
			      <th>Updated_At</th>
			      <th colspan="2">Change Status</th>
			      <th colspan="2">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			    	<!-- GET ALL CATEGORY -->
			    	<?php 

			    	$query="SELECT * FROM category";
			    	$result=mysqli_query($connection,$query);

			    	// print_r($result);
			    	
			    	if($result)
			    	{
			    		while($rows = mysqli_fetch_assoc($result))
			    		{
			    			?>
			    				<tr>
			    					<td><?php echo $rows['category_id']; ?></td>
			    					<td><?php echo $rows['category_title']; ?></td>
			    					<td><?php echo $rows['category_description']; ?></td>
			    					<td><?php echo $rows['category_status']; ?></td>
			    					<td><?php echo $rows['created_at']; ?></td>
			    					<td><?php echo $rows['updated_at']; ?></td>
			    					<td>
			    					<button onclick="Active(<?php echo $rows['category_id']; ?>)" class="btn btn-success">
			    					Active
			    					</button></td>
			    					<td><button onclick="InActive(<?php echo $rows['category_id']; ?>)" class="btn btn-warning">InActive</button></td>
			    					<td><button onclick="Update(<?php echo $rows['category_id']; ?>)" class="btn btn-info">Update</button></td>
			    					<td><button onclick="Del(<?php echo $rows['category_id']; ?>)" class="btn btn-danger">Delete</button></td>
			    				</tr>

			    			<?php
			    			
			    		}
			    	}else{
			    		
			    		?>
			    		<tr>
			    			<td>No Record</td>
			    		</tr>
			    		<?php
			    	}
			 		?>  
			  </tbody>
			</table>
		<?php
	}
	/*ACtive category*/
	elseif(isset($_GET['action'])&&$_GET['action']=='active')
	{
		$query="UPDATE category SET category_status='Active' 
				WHERE category_id='".$_GET['id']."'";
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
			<div class="alert alert-warning" role="alert">
			Status Not Change....!
			</div>
			<?php	
		}
	}
	/*Inactive Catergory*/
	elseif(isset($_GET['action'])&&$_GET['action']=='inactive')
	{
		$query="UPDATE category SET category_status='InActive' 
				WHERE category_id='".$_GET['id']."'";
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
			<div class="alert alert-warning" role="alert">
			Status Not Change....!
			</div>
			<?php	
		}
	}
	/*DEL*/
	elseif(isset($_GET['action'])&&$_GET['action']=='del')
	{
		$query="DELETE FROM category 
				WHERE category_id='".$_GET['id']."'";
		$result=mysqli_query($connection,$query);

		if($result)
		{
			?>
			<div class="alert alert-success" role="alert">
				 DElETE CATEGORY Successfully....
			</div>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-warning" role="alert">
			 Not DELETEs....!
			</div>
			<?php	
		}
	}

 ?>