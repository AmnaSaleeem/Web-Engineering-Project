<?php 
	require('../back-end-pages/dbconnect.php');
	session_start();
	/*ADD POST*/
	if(isset($_GET['action'])&&$_GET['action']=='addpost')
	{
		$filename=$_FILES['image']['name'];
        $extension=pathinfo($filename,PATHINFO_EXTENSION);
        if($extension=='jpg'||$extension=='png'||$extension=='JPG'||$extension=='PNG')
        {
            $newname=rand().".".$extension;
            $path="images/".$newname;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
            {
						$query="INSERT INTO post
						(blog_id,post_title,post_summary,post_description,featured_image)
							VALUES('".$_POST['blogid']."',
									'".$_POST['title']."',
									'".$_POST['summary']."',
									'".$_POST['desc']."',
									'".$path."')";
						$result=mysqli_query($connection,$query);
						/*GET POST ID*/
						$lastpostid=mysqli_insert_id($connection);	
						$list = $_POST['categories'];		
						$list=explode(',',$list );
						foreach ($list as  $value) 
						{
							$query="INSERT INTO post_category (post_id,category_id)
							VALUES('".$lastpostid."','".$value."')";
							$result2=mysqli_query($connection,$query);	
						}	
			}
		}
		/*POST ATTACHEMENT*/
		$total_files=count($_FILES);
		$i=0;
		while($i<=$total_files)
		{
			if(isset($_FILES['attachfiles'.$i]))
			{
				if($_FILES['attachfiles'.$i]['name']!='')
				{
					
					$filename=$_FILES['attachfiles'.$i]['name'];
					$extension=pathinfo($filename,PATHINFO_EXTENSION);
					if($extension=='jpg'||$extension=='png'||$extension=='JPG'||$extension=='PNG')
						{
							$newname=rand().".".$extension;
							$path="images/".$newname;
							if(move_uploaded_file($_FILES['attachfiles'.$i]['tmp_name'], $path))
								{
									$query="INSERT INTO post_atachment
									( post_id,post_attachment_title,post_attachment_path )
									VALUES('".$lastpostid."','".$_POST['attachtitle']."','".$path."') ";
									$result3=mysqli_query($connection,$query);
								}		
						}
				}
			}	
				$i++;
		}

				if($result || $result2 || $result3)
				{

					?>
					<div class="alert alert-success" role="alert">
						Post Added Successfully....!
					</div>
					<?php
				}
				else{
				?>
					<div class="alert alert-warning" role="alert">
						Post Not Added......Try Again.!
					</div>
					<?php	
				}
	}
	/*Status Change for post to active*/
	elseif(isset($_GET['action'])&&$_GET['action']=='active')
	{
		$query="UPDATE post SET post_status='Active' WHERE post_id='".$_GET['post_id']."'";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			echo "Status Change To Active Successfully....";
		}
		else
		{
			echo "Staus Not Changed";
		}
	}
	/*status changed to inactive for post*/
	elseif(isset($_GET['action'])&&$_GET['action']=='inactive')
	{
		$query="UPDATE post SET post_status='InActive' WHERE post_id='".$_GET['post_id']."'";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			echo "Status Change To InActive Successfully....";
		}
		else
		{
			echo "Staus Not Changed";
		}
	}
	/*COMMENT ALLOWED OR NOT*/
	elseif(isset($_GET['action'])&&$_GET['action']=='allowed')
	{
		$query="UPDATE post SET is_comment_allowed='1' WHERE post_id='".$_GET['post_id']."'";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			echo "Comment Status chnage To Allowed Successfully....";
		}
		else
		{
			echo "Staus Not Changed";
		}
	}
	/*status changed to inactive for post*/
	elseif(isset($_GET['action'])&&$_GET['action']=='notAllowed')
	{
		$query="UPDATE post SET is_comment_allowed='0' WHERE post_id='".$_GET['post_id']."'";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			echo "Comment Status Change To Not Allowed Successfully....";
		}
		else
		{
			echo "Staus Not Changed";
		}
	}
 ?>