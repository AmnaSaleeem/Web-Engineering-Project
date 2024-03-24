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
	<title>Add New Blog</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
		<!--  -->
	<script type="text/javascript">
		function SubmitForm()
			{
			var title=document.getElementById('blog_title').value;
			var page=document.getElementById('post_per_page').value;
			var bg_image=document.getElementById('bg_image');
			var formdata=new FormData();
			formdata.append('image',bg_image.files[0]);
			formdata.append('blog_title',title);
			formdata.append('post_per_page',page);
			
			// console.log(bg_image);
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
			obj.open('POST','blog_manage_ajax.php?action=submit');
			obj.send(formdata);
		}	
	</script>
		<!--  -->
<body>
	<?php include('admin-header.php');?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8" >
			   <table class="table border rounded">
				<form action="" method="POST" onsubmit="return false" enctype="multipart/form-data">
				   		<h2 align="center">ADD BLOG </h2>
				   	<tr>
				   		<td>Add Blog Title</td>
				   		<td><input type="text" name="blog_title" id="blog_title"></td>
				   	</tr>
				   	
				<tr>
					<td>Post Per Page</td>
					<td><input type="number" name="post_per_page" id="post_per_page"></td>
				</tr>
				<tr>
					<td>Blog BackGround Image </td>
					<td><input type="file" name="bg_image" id="bg_image"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input onclick="SubmitForm()"  type="submit" name="submit"  value="Add Blog" class="btn btn-success"> </td>
					
				</tr>
				</form>
			</table>
			     <p id="msg"></p>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
</body>
</head>
</html>