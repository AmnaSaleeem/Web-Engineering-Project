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
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
	<script type="text/javascript" src="jquery-3.5.1.js" ></script>
	<script type="text/javascript" src="jquery.dataTables.min.js"></script>
	<script type="text/javascript">

		// $(document).ready(function () {
  //   	$('#example').DataTable();
		// });

		/*ENTRIES*/
		$(document).ready(function () {
   		 $('#example').DataTable({
        lengthMenu: [
            [5, 15, 20, -1],
            [5, 15, 20, 'All'],
        ],
    });
});
		/*ENTRIES*/
	</script>
	<style type="text/css">
		#featuredimage{
			height: 200px;
			width: 200px;
		}
	</style>
	<!-- Ajax working For active inactive post -->
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
			obj.open('GET','post_process_ajax.php?action=active&post_id='+id);
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
			obj.open('GET','post_process_ajax.php?action=inactive&post_id='+id);
			obj.send();
		}
		function allowed(id)
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
			obj.open('GET','post_process_ajax.php?action=allowed&post_id='+id);
			obj.send();
		}
		function not_allowed(id)
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
			obj.open('GET','post_process_ajax.php?action=notAllowed&post_id='+id);
			obj.send();
		}
	</script>
	<!-- Ajax working For active inactive post -->

</head>
<body>
	<?php include('admin-header.php'); ?>
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-sm-12"></div>
			<div id="alert" class="alert alert-success text-center"></div>
				<table id="example" class="display" style="width:100%">
				    <thead>
				        <tr>
				            <th>POST ID</th>
				            <th>BLOG ID</th>
				            <th>POST TITLE</th>
				            <th>POST SUMMARY</th>
				            <th>POST DECRIPTION</th>
				            <th>FEATURED IMAGE</th>
				            <th>POST STATUS</th>
				            <th>IS COMMENT ALLOWED</th>
				            <th>CREATED DATE</th>
				            <th>UPDATED DATE</th>
				            <th>Action</th>
				            <th>Comment Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php 
				    		require('../back-end-pages/dbconnect.php');
				    		$query="SELECT * FROM post ";
				    		$result=mysqli_query($connection,$query);
				    		if(mysqli_num_rows($result))
				    		{
				    			while($post=mysqli_fetch_assoc($result))
				    			{
				    	 ?>
				        <tr>
				            <td><?php echo $post['post_id'] ; ?></td>
				            <td><?php echo $post['blog_id'] ; ?></td>
				            <td><?php echo $post['post_title'] ; ?></td>
				            <td><?php echo $post['post_summary'] ; ?></td>
				            <td><?php echo $post['post_description'] ; ?></td>
				            <td><img src="<?php echo $post['featured_image'];?>" id="featuredimage"></td>
				            <td><?php echo $post['post_status'] ; ?></td>
				            <td><?php echo $post['is_comment_allowed'] ?></td>
				            <td><?php echo $post['created_at'] ; ?></td>
				            <td><?php echo $post['updated_at'] ; ?></td>
				            <td>
				            	<button class="btn btn-success" onclick="active(<?php echo $post['post_id'];?>)">Active</button>
				    
				            	<button class="btn btn-warning" onclick="inactive(<?php echo $post['post_id'];?>)">InActive</button>
				            </td>
				            <td>
				            	<button class="btn btn-success" onclick="allowed(<?php echo $post['post_id'];?>)">Allowed</button>
				    
				            	<button class="btn btn-warning" onclick="not_allowed(<?php echo $post['post_id'];?>)">Not Allowed</button>
				            </td>
				        </tr>
				    <?php } } ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>