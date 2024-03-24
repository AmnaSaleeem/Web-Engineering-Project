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
	<title>ALL BLOG</title>
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
	<script type="text/javascript">
		function active(id)
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
					document.getElementById('alert').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','blog_manage_ajax.php?action=active&blog_id='+id);
			obj.send();
		}
		function inactive(id)
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
					document.getElementById('alert').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','blog_manage_ajax.php?action=inactive&blog_id='+id);
			obj.send();
		}
		function update(id)
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
					document.getElementById('update').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','blog_manage_ajax.php?action=update&blog_id='+id);
			obj.send();
		}
		function updated(id)
		{
			var blogtitle=document.getElementById('title').value;
			var postperpage=document.getElementById('page').value;
			var bgimage=document.getElementById('bg_image');
			var formdata=new FormData();
			formdata.append('image',bgimage.files[0]);
			formdata.append('blog_id',id);
			formdata.append('blog_title',blogtitle);
			formdata.append('post_per_page',postperpage);
			
			// console.log(bgimage);
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
					document.getElementById('alert').innerHTML=obj.responseText;
				}
			}
			obj.open('POST','blog_manage_ajax.php?action=updated');
			obj.send(formdata);
		}
		function del(id)
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
					document.getElementById('alert').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','blog_manage_ajax.php?action=delete&blog_id='+id);
			obj.send();
		}
	</script>

</head>
<body>
	<?php require('admin-header.php'); ?>
	</div>
	<p id="alert" class="col-sm-12 text-center alert alert-success"></p>
	<div id="update"></div>  
	<table id="example" class="display" style="width:100%; background-color: #f2f2f2;">
        <h3 align="center" style="background-color: #2b6777;">VIEW ALL BLOG</h3>
        <thead>
            <tr>
               <td>Blog_Id</td> 
               <td>Blog Title</td> 
               <td>Post Per Page</td> 
               <td>Blog Background Image</td> 
               <td>Blog Status</td> 
               <td>Created At</td> 
               <td>Updated At</td> 
               <td>Change Status</td>
               <td>Action</td>
               
            </tr>
        </thead>
            	<?php 
            	require('../back-end-pages/dbconnect.php');
            	$query="SELECT * FROM blog";
            	$result=mysqli_query($connection,$query);
            	if(mysqli_num_rows($result))
            	{
            		while($data=mysqli_fetch_assoc($result))
            		{
            	 ?>
        <tbody>
            <tr>
                <td><?php echo  $data['blog_id']; ?></td>
                <td><?php echo $data['blog_title']; ?></td>
                <td><?php echo $data['post_per_page']; ?></td>
                <td><?php echo $data['blog_background_image']; ?></td>
                <td><?php echo $data['blog_status']; ?></td>
                <td><?php echo $data['created_at']; ?></td>
                <td><?php echo $data['updated_at']; ?></td>
                <td><button class="btn btn-success" onclick="active(<?php echo $data['blog_id']; ?>)">Active</button>
                	<button class="btn btn-warning" onclick="inactive(<?php echo $data['blog_id']; ?>)">InActive</button></td>
                <td><button class="btn btn-info" onclick="update(<?php echo $data['blog_id']; ?>)">Update</button>
                	<button class="btn btn-danger" onclick="del(<?php echo $data['blog_id']; ?>)">Delete</button></td>
            </tr>
        <?php } } ?>
        </tbody>
    </table>
    <?php require('footer.php'); ?>
</body>
</html>