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


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VIEW ALL USER</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
	<script type="text/javascript" src="jquery-3.5.1.js" ></script>
	<script type="text/javascript" src="jquery.dataTables.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function () {
    	$('#example').DataTable();

		});
	</script>
	<!-- Ajax Work -->
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
						document.getElementById('updated').innerHTML=obj.responseText;
					}
				}
				obj.open('GET','ajax_process.php?action=update&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&password='+password+'&dateofbirth='+dateofbirth+'&address='+address+'&userid='+userid);
				obj.send();
			}

		/*USER REQUEST*/
		setInterval('gettable()', 1000);
		function gettable()
		{
			var obj;
			if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4&&obj.status==200)
				{
					document.getElementById('Gettable').innerHTML=obj.responseText;
					console.log(obj.responseText);
				}
			}
			obj.open('GET','ajax_process.php?action=gettable');
			obj.send();}
		function accept(id)
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
						document.getElementById('updated').innerHTML=obj.responseText;
						// console.log(obj.responseText);
					}
				}
				obj.open('GET','ajax_process.php?action=accept&user_id='+id);
				obj.send();
			}
		function reject(id)
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
					document.getElementById('updated').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','ajax_process.php?action=reject&user_id='+id);
			obj.send();
		}
		/*USER REQUEST*/
	</script>
	<style type="text/css">
		#img
		{
			width: 50px;
			height: 50px;
		}
	</style>
</head>
<body>
	<?php include('admin-header.php'); ?>
	<div id="updated"></div>
	<div class="container-fluid mt-3">
		<div class="row">
			<div id="model"></div>
			<div class="col-sm-12"></div>
				<table id="example" class="display" style="width:100%;background-color: #f2f2f2">
				    <thead>
				        <tr>
				            <th>USER ID</th>
				            <th>ROLE Types</th>
				            <th>FIRST NAME</th>
				            <th>LAST NAME</th>
				            <th>EMAIL</th>
				            <th>PASSWORD</th>
				            <th>GENDER</th>
				            <th>DATE OF BIRTH</th>
				            <th>User Image</th>
				            <th>ADDRESS</th>
				            <th>STATUS</th>
				            <th>CREATED AT</th>
				            <th>UPDATED AT</th>
				            <th>Edit Record</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php 
				    		require('../back-end-pages/dbconnect.php');
				    		$query="SELECT * FROM USER,role WHERE role.`role_id`='2' AND role.`role_id`= user.`role_id` ";
				    		$result=mysqli_query($connection,$query);
				    		if(mysqli_num_rows($result))
				    		{
				    			while($user=mysqli_fetch_assoc($result))
				    			{
				    	 ?>
				        <tr>
				            <td><?php echo $user['user_id'] ; ?></td>
				            <td><?php echo $user['role_type'] ; ?></td>
				            <td><?php echo $user['first_name'] ; ?></td>
				            <td><?php echo $user['last_name'] ; ?></td>
				            <td><?php echo $user['email'] ; ?></td>
				            <td><?php echo $user['password'] ; ?></td>
				            <td><?php echo $user['gender'] ; ?></td>
				            <td><?php echo $user['date_of_birth'] ?></td>
				            <td><img src="<?php echo $user['user_image'];?>" id="img"></td>
				            <td><?php echo $user['address'] ; ?></td>
				            <td><?php echo $user['is_active'] ; ?></td>
				            <td><?php echo $user['created_at'] ; ?></td>
				            <td><?php echo $user['updated_at'] ; ?></td>
				            <td>
				            	<button class="btn btn-outline-success" onclick="edit(<?php echo $user['user_id']; ?>)">Edit</button>
				            </td>
				        </tr>
				    <?php } } ?>
				    </tbody>
				</table>
				<!--  -->

				<!--  -->
			</div>
		</div>
	</div>
	


	<?php include('footer.php'); ?>
</body>
</html>