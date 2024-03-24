<?php 
	require('../back-end-pages/dbconnect.php');
	$query="SELECT * from Blog";
	$result=mysqli_query($connection,$query);

	$query1="SELECT * FROM category";
	$result1=mysqli_query($connection,$query1);
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
	<title>Add New Post</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
		
<!-- ajax WORK START -->
	<script type="text/javascript">
	function addpost()
		{
			var blogid=document.getElementById('blogid').value;
			var title=document.getElementById('title').value;
			var summary=document.getElementById('summary').value;
			var desc=document.getElementById('desc').value;
			var image=document.getElementById('image');
			document.getElementById('submit').onclick = function() {
		    var select = document.getElementById('category');
		    var selected = [...select.selectedOptions]
		                    .map(option => option.value);
			var formdata=new FormData();
		    formdata.append('categories',selected);
			formdata.append('image',image.files[0]);
			formdata.append('blogid',blogid);
			formdata.append('title',title);
			formdata.append('summary',summary);
			formdata.append('desc',desc);

			/*FOR ATTACHEMENT*/
			var attachtitle=document.getElementById('attachtitle').value;
			var attachfiles=document.getElementById('multiplefiles');
			var total_files=attachfiles.files['length'];
			var i=0;
			while(i<total_files)
			{
				formdata.append('attachfiles'+i,attachfiles.files[i]);
				i++;
			}	
			formdata.append('attachtitle',attachtitle);
			/*FOR ATTACHEMENT*/	
				
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
						document.getElementById('title').value='';
						document.getElementById('summary').value='';
						document.getElementById('desc').value='';
					}
				}
			obj.open('POST','post_process_ajax.php?action=addpost');
			obj.send(formdata);
			}		
		}
	</script>
	<style type="text/css">
		input{
			width: 90%;
		}
		textarea{
			width: 90%;
		}
		
			}
		
	</style>
</head>
<body>
	<?php include('admin-header.php');?>
	<div class="container-fluid">
		<div class="row">
		<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div id="msg"></div>
				<h3 align="center">Add Post Data</h3>
			  <table class="table border" >
				<hr>
				<form action="" method="POST" onsubmit="return false" enctype="multipart/form-data">
				<tr>
					<td><b>SELECT PARTICULAR BLOG</b></td>
					<td>
						<select class="form-select" aria-label="Default select example" id="blogid">
							<!-- GETTING BLOG TITLE FROM DATABASE -->
						  <option>--SELECT BLOG--</option>
						<?php while($blogs=mysqli_fetch_assoc($result))
						{ ?>
						  <option value="<?php echo $blogs['blog_id'] ?>"><?php echo $blogs['blog_title']; ?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Add Post Title</b></td>
					<td><input type="text" name="title" id="title"></td>
				</tr>
				<tr>
					<td><b>Add Post Summary</b></td>
					<td><input type="text" name="summary" id="summary"></td>
				</tr>
				<tr>
					<td><b>Add  Post Description</b></td>
					<td>
						<!-- Editor Start from here -->
					      <textarea id="desc" name="description" placeholder="ADD POST DECRIPTION HERE"></textarea>
					   	<!-- Editor End at here -->
					</td>
				</tr>
				<tr>
					<td>Featured Image</td>
					<td><input type="file"  id="image"></td>
				</tr>
				<tr>
					<td>Select Post Cateogry</td>
					<!-- GET ALL CATEGORY -->
					<td>
							<select id="category" multiple>
						<?php 
						while($data=mysqli_fetch_assoc($result1)){ ?>
							<option value="<?php echo $data['category_id'];?>">
								<?php echo $data['category_title'];?>
							</option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Post Attachement Title</td>
					<td><input type="text" name="attachtitle" id="attachtitle"></td>
				</tr>
				<tr>
					<td>Post Attachement</td>
					<td><input type="file" name="multiplefiles" id="multiplefiles" multiple></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input onclick="addpost()" type="submit" name="submit" id="submit" value="Add Post" style="width:30%" class="btn btn-success"></td>
				</tr>
				</form>
			</table>
			     
			</div>
				<div class="col-sm-2"></div>
		</div>
	</div>
</body>
</html>