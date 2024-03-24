<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comments</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		#categories{
			display: none;
		}
		#about_us{
			display: none;
		}
		#contact_us{
			display: none;
		}
		#our_team{
			display: none;
		}
		<?php session_start();
		if(!isset($_SESSION['user']))
		{ ?>
			#commentsection
			{
				display: none;
			}
			#dropdownMenuLink{
				display: none;
			}
		<?php } ?>
		input{
			width: 90%;
			height: 50px;
		}
		#show_chat{
			overflow-x:auto;
			height: 300px;
		}
		#postattach{
			width: 300px;
			height: 300px;
		}
	</style>
	<!-- Ajax Code -->
	<script type="text/javascript">
		setInterval('show_chat(id=<?php echo $_GET['post_id']; ?>);', 1000);
		
		function AddMessage(id){
			var message=document.getElementById('msg').value;
			var obj;
			if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.onreadystatechange=function(){
				if(obj.readyState==4&&obj.status==200)
				{
					if(message!="")
					{
					document.getElementById('msg').value="";
					}
					else
					{
						alert('Write Msg First');
					}
				}
			}
			obj.open("GET","comment_process_ajax.php?action=AddMessage&message="+message+'&post_id='+id);
			obj.send();
			
			}
		function show_chat(id){
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
					document.getElementById('show_chat').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','comment_process_ajax.php?action=show_chat&post_id='+id);
			obj.send();
		}
	</script>
	<!-- Ajax Code -->

</head>
<body>
	<?php require('header.php');?>
	<div class="col-sm-12">		
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-3">
						<?php 
						require('../back-end-pages/dbconnect.php');
						$query="SELECT * FROM post WHERE post_id='".$_GET['post_id']."' ";
						$result=mysqli_query($connection,$query);
						$data=mysqli_fetch_assoc($result);
						?>
						<div class="row g-0">
							<div class="col-md-4">
							 	 <img src="<?php echo $data['featured_image'];?>" class="img-fluid rounded-start" alt="...">
							</div>
							<div class="col-md-8">
								  <div class="card-body" >
								    <h5 class="card-title"><b>POST TITLE:</b> <br>
								    	<?php echo $data['post_title']; ?></h5>
								    <p class="card-text"><b>Post Summary: </b><br>
								     <?php echo $data['post_summary']; ?> 
								     <br>
								     <b>Post Description: </b><br>
								     <?php echo $data['post_description'];?>
								     <br>
								     <b>Post Created Date : </b>
								     <br>
								 <small class="text-muted "><?php echo $data['created_at']; ?> </small></p>
								  </div>
								  <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
									  VIEW ATTACHEMENT
									</button>

									<!-- Modal -->
									<?php $query="SELECT * FROM post p ,post_atachment pa WHERE p.`post_id`=pa.`post_id` AND p.`post_id`='".$_GET['post_id']."'";
											$result=mysqli_query($connection,$query);
											$postattach=mysqli_fetch_assoc($result);
									 ?>
									<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="staticBackdropLabel"><?php echo $postattach['post_title']; ?></h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>
									      <div class="modal-body">
									       <h3><?php echo  $postattach['post_attachment_title']; ?></h3>
									       <img src="<?php echo $postattach['post_attachment_path'];?>" id="postattach">
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									        
									      </div>
									    </div>
									  </div>
									</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<div class="container" id="commentsection">
		<div class="row">
			<h3 class="text-center display-5">Comment Section</h3>
			<div class="col-sm-12">
				<div id="show_chat" class="border border-2 border-dark shadow "></div>
				<div>
					<br>
					<input type="text" name="" id="msg" placeholder="TYPE MESSAGE HERE.........!">
					<button id="sent" class="btn btn-outline-success" onclick="AddMessage(<?php echo $_GET['post_id'];?>)">Sent</button>
				</div>
			</div>
		</div>
	</div>
	<?php require('footer.php') ?>
</body>
</html>