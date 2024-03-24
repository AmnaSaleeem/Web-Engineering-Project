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
    /*ADD BLOG*/ 
    if(isset($_GET['action'])&&$_GET['action']=='submit')
    {
        $filename=$_FILES['image']['name'];
        $extension=pathinfo($filename,PATHINFO_EXTENSION);
        if($extension=='jpg'||$extension=='png'||$extension=='JPG'||$extension=='PNG')
        {
            $newname=rand().".".$extension;
            $path="images/".$newname;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
            {
                $query="INSERT INTO blog (user_id,blog_title,post_per_page,blog_background_image)
                        VALUES('".$_SESSION['user']['user_id']."','".$_POST['blog_title']."','".$_POST['post_per_page']."','".$path."')";
                $reuslt=mysqli_query($connection,$query);           
            }
        }
        if($reuslt)
        {
            echo "BLOG ADD SUCCESSFULLY.....!";
        }
        else
        {
            echo "ERROR";
        }
    }
    /*Chnage  BLOG Status to active*/
    elseif(isset($_GET['action'])&&$_GET['action']=='active')
    {
        $blog_id=$_GET['blog_id'];
        $query="UPDATE blog SET blog_status='Active' WHERE blog_id='".$blog_id."'";
        $result=mysqli_query($connection,$query);   
        if($result)
        {
        ?>
        <div class="alert alert-success" role="alert">BLOG STATUS CHANGE</div>
        <?php
        }
        else
        {
            echo "Status Not changed";
        }
    }
    /*Change blog status to inactive*/
    elseif(isset($_GET['action'])&&$_GET['action']=='inactive')
    {
        $blog_id=$_GET['blog_id'];
        $query="UPDATE blog SET blog_status='InActive' WHERE blog_id='".$blog_id."'";
        $result=mysqli_query($connection,$query);   
        if($result)
        {
        ?>
        <div class="alert alert-success" role="alert">BLOG STATUS CHANGE</div>
        <?php
        }
        else
        {
            echo "Status Not changed";
        }
    }
    /*UPDATE BLOG*/
    elseif(isset($_GET['action'])&&$_GET['action']=='update')
    {
        $query="SELECT * FROM blog WHERE blog_id='".$_GET['blog_id']."'";
        $result=mysqli_query($connection,$query);
        $data=mysqli_fetch_assoc($result);
        ?>
        <center>
       <table class="table" >
        <form action="" method="POST" onsubmit="return false" enctype="multipart/form-data">
        <h2>Update BLOG</h2>
           <tr>
               <td>BLOG TITE</td>
               <td><input type="text" name="blog_title" id="title" value="<?php echo $data['blog_title'] ?>"></td>
           </tr>
           <tr>
               <td>Post Per Page</td>
               <td><input type="text" name="page" id="page" value="<?php echo $data['post_per_page']; ?>"></td>
           </tr>
           <tr>
               <td>BLOG Back Ground Image</td>
               <td><input type="file" name="bg_image" id="bg_image" value="<?php echo $data['blog_background_image']; ?>"></td>
           </tr>
           <tr>
               <td colspan="2" align="center"><input onclick="updated(<?php echo $data['blog_id']; ?>)" type="Submit" name="submit" value="Update Blog"></td>
           </tr>
           </form>
       </table>
       </center>
        <?php
    }
    /*Upadating Record*/
    elseif(isset($_GET['action'])&&$_GET['action']=='updated')
    {
        $filename=$_FILES['image']['name'];
        $extension=pathinfo($filename,PATHINFO_EXTENSION);

        if($extension=='jpg'||$extension=='png'||$extension=='JPG'||$extension=='PNG')
        {
                
            $newname=rand().".".$extension;
            $path="images/".$newname;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
            {
                date_default_timezone_set('asia/karachi');
                $query="UPDATE blog  SET blog_title             =   '".$_POST['blog_title']."',
                                        post_per_page           =   '".$_POST['post_per_page']."',
                                        blog_background_image   =   '".$path."',
                                        updated_at              =   '".date('Y-m-d h:i:s')."'
                        WHERE blog_id   =   '".$_POST['blog_id']."'";
                $result=mysqli_query($connection,$query);           
            }
        }
        if($result)
        {
            ?>
                <div class="alert alert-success">Record Updated Successfully...</div>
            <?php
        }
        else
        {
            ?>
                <div class="alert alert-warning">Record Not Updated</div>
            <?php
        }
    }
    /*DELETE BLOG*/
    elseif(isset($_GET['action'])&&$_GET['action']=='delete')
    {
        $query="DELETE FROM blog WHERE blog_id='".$_GET['blog_id']."'";
        $result=mysqli_query($connection,$query);
        if($result)
        {
            echo "RECORD DELETE SUCCESSFULLY......!";
        }
        else{
            echo "RECORD NOT DELETED.....?";
        }
    }
 ?>