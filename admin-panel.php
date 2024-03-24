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
                   $query="SELECT * FROM post p INNER JOIN blog b
                           WHERE p.`blog_id`= b.`blog_id`
                           ORDER BY p.post_id DESC
                           LIMIT 0,1;";
                  
                  $result=mysqli_query($connection,$query);
                  $lastpost=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Admin Panel</title>
       <!-- LINKS -->
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" type="text/css" href="bootstraps4.min.css">
      <link rel="stylesheet" href="css/style.css">
      <script type="text/javascript" src="jquery.min.js"></script>
      <script type="text/javascript" src="popper.min.js"></script>
       <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
   	<link rel="stylesheet" href="css/demo.css">
       <!-- LINKS -->
    
       
      <style type="text/css">
         #stat1
         {
            height: 130px;
            border: 2px solid black;
            background-color: orange;
            color: white; text-align: center;
            font:italic; font-size: 20px;
            /*margin: 10px;*/
         }
         #stat2{
            height: 130px;
            border: 2px solid black;
            background-color: purple;
            color: white;
            text-align: center;
            font: sans-serif;
            font-size: 20px;
            /*margin: 10px;*/
         }
         #stat3{
             height: 130px;
             border: 2px solid black;
             background-color: darkblue;
             color: white;
             text-align: center;
             font: sans-serif;
             font-size: 20px;
             /*margin: 10px;*/
         }
         #stat4{
             height: 130px;
             border: 2px solid black;
             background-color: tomato;
             color: white;
             text-align: center;
             font: sans-serif;
             font-size: 20px;
             /*margin: 10px;*/
         }
      </style>
      
      <!-- AJAX WORK  -->
      <script type="text/javascript">
    
         function Add(){
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','category_process_ajax.php?action=addform');
            obj.send();
         }
         /*ADD CATEGORY*/
         function AddCategory(){
            var title=document.getElementById('title').value;
            var desc=document.getElementById('desc').value;
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','category_process_ajax.php?action=add&title='+title+'&desc='+desc);
            obj.send();
         }
         /*UPDATEE FORM*/
         function Update(id){
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','category_process_ajax.php?action=updateform&id='+id);
            obj.send();
         }
         function UpdateCategory(id)
         {
            var title=document.getElementById('title').value;
            var desc=document.getElementById('desc').value;
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','category_process_ajax.php?action=update&title='+title+'&desc='+desc+'&id='+id);
            obj.send();
         }
         /*VIEW ALL CATEGORY*/
         function viewall(){
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','category_process_ajax.php?action=viewall');
            obj.send();
         }
         /*Active */
         function Active(id){
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','category_process_ajax.php?action=active&id='+id);
            obj.send();
         }
         /*Inactive*/
         function InActive(id)

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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','category_process_ajax.php?action=inactive&id='+id);
            obj.send();
         }
         function Del(id)

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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','category_process_ajax.php?action=del&id='+id);
            obj.send();
         }
         /*VIEW ALL FEED BACK*/
         function viewallfeedback()
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','ajax_process.php?action=viewallfeedback');
            obj.send();
         }
         /*VIEW ALL FEED BACK*/
         /*VIEW ALL COMMENTS*/
         function viewallcomment()
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
               }
            }
            obj.open('GET','comment_process_ajax.php?action=viewallcomments');
            obj.send();
         }
         /*COMMENT STATUS*/
         function postactive(id){
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','comment_process_ajax.php?action=active&id='+id);
            obj.send();
         }
         /*Inactive*/
         function postinactive(id)

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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','comment_process_ajax.php?action=inactive&id='+id);
            obj.send();
         }
         /*VIEW ALL FOLLOWER*/
         function countfollower()
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','ajax_process.php?action=countfollower');
            obj.send();
         }
         /*VIEW ALL FOLLOWER*/
         function view_all_follower(id)
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
                  document.getElementById('ajaxdiv').innerHTML=obj.responseText;
                 
               }
            }
            obj.open('GET','ajax_process.php?action=viewallfollower&blogid='+id);
            obj.send();
         }
         
          /*ADD BLOG*/
      </script>
      <!-- AJAX WORK  -->
  </head>
  <body>
 <header class="intro">
   <div class="container">
      <div class="row">
         <div class="col-sm-2" ></div>
         <!-- GETTING STATS FROM DATABASE -->
         <?php 
            require('../back-end-pages/dbconnect.php');
            $query="SELECT count(user_id) AS TOTAL_USER FROM user";
            $result =mysqli_query($connection,$query);
            $totaluser=mysqli_fetch_assoc($result);

            $query="SELECT count(post_id) AS TOTAL_POST FROM post";
            $result =mysqli_query($connection,$query);
            $totalpost=mysqli_fetch_assoc($result);

            $query="SELECT count('user_id') AS TOTAL_ONLINE FROM user WHERE is_active='Active'";
            $result =mysqli_query($connection,$query);
            $totalonline=mysqli_fetch_assoc($result);
          ?>
         <!-- GETTING STATS FROM DATABASE -->
         <div  class="col-sm-2" id="stat1">
             <br>
               <h4>Registered Users <br>
               <?php echo $totaluser['TOTAL_USER']; ?>
               </h4>
            </div>
            <div class="col-sm-2" id="stat2">
               <br>
               <h4>Total Posts <br>
               <?php echo $totalpost['TOTAL_POST'] ?>
               </h4>
            </div>
            <div class="col-sm-2" id="stat3">
               <br>
               <h4>Online User<br>
               <?php echo $totalonline['TOTAL_ONLINE']; ?>
               </h4>
            </div>
            <div class="col-sm-2" id="stat4">
               <br>
               <h4 align="center">Today Visitor<br>
               320
               </h4>
            </div>
         <div class="col-sm-2"></div>
      </div>
   </div>
 
 </header>
  <div class="container">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
      <div class="col-sm-12" id="ajaxdiv"></div>
        <div class="col-sm-12 border border-2 border-dark shadow" style="height: 400px; background-image: url(<?php echo $lastpost['blog_background_image'];?>); opacity: 0.5;background-repeat: no-repeat;background-size: 700px ;color: black  ;"  >
               <h2 class="text-center"><?php echo $lastpost['blog_title']; ?></h2>
               <h2><?php echo $lastpost['post_title'];?></h2>
               <p class="text-center"><?php echo $lastpost['post_summary'];?>.</p>
            </div>
            <div class="col-sm-12 mt-4">
              <!-- <div class="container" > -->
                        <div class="col-sm-12 ">
                        <div class="row row-cols-1 row-cols-md-3 g-4 pb-5">
                           <?php 
                              require('../back-end-pages/dbconnect.php');
                              $query="SELECT * from post";
                              $result=mysqli_query($connection,$query);
                              if(mysqli_num_rows($result))
                                 {
                                    while($posts=mysqli_fetch_assoc($result))
                                    {
                           ?>
                                   <!-- <div class="col"> -->
                                  <div class="card shadow border border-primary rounded"  style="height: 300px;">
                                    <img style="height:100px;" src="<?php echo $posts['featured_image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $posts['post_title']; ?></h5>
                                      
                                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $posts['post_id']; ?>">
                                         Read More....
                                       </button>

                                      <!-- READ MORE -->

                                      <div class="modal fade" id="exampleModal<?php echo $posts['post_id']; ?>" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <img src="<?php echo $posts['featured_image'];?>"  style="height:100px;">
                                                  <h5 class="modal-title" id="exampleModalLabel"><b>POST TITLE:</b><br><?php echo $posts['post_title']; ?></h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><b>POST SUMMARY: </b><br>
                                                  <?php echo $posts['post_summary'] ;?>
                                                  <br>
                                                  <b>POST DEESCRIPTION:</b><br>
                                                   <?php echo $posts['post_summary'] ;?>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                               
                                                </div>
                                              </div>
                                            </div>
                                       </div>
                                    </div>
                                  </div>
                                <!-- </div> -->
                          <?php } } ?>
                         </div>
                     </div>
                     <!-- </div> -->
            </div>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>

 
             <div class="page-wrapper chiller-theme toggled"> 
                     <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                     <i class="fas fa-bars"></i>
                     </a>
                     <nav id="sidebar" class="sidebar-wrapper">
                        <div class="sidebar-content">
                            <div class="sidebar-brand">
                              <a href="admin-panel.php">Admin Dashboard</a>
                           <div id="close-sidebar">
                              <i class="fas fa-times"></i>
                        </div>
                     </div>
                     <div class="sidebar-header">
                        <div class="user-pic">
                            
                           <img class="img-responsive img-rounded" src="<?php echo $_SESSION['user']['user_image'] ?>"
                              alt="User picture">
                        </div>
                        <div class="user-info">
                           <span><?php echo $_SESSION['user']['first_name'];?></span>
                           <span class="user-role">Administrator</span>
                           <span class="user-status">
                           <i class="fa fa-circle"></i>
                           <span>Online</span>
                           </span>
                        </div>
                     </div>
                     <!-- sidebar-header  -->
                     <!-- sidebar-search  -->
                     <div class="sidebar-menu">
                        <ul>
                           <li class="header-menu">
                              <span>General</span>
                           </li>
                           <!-- USER MANAGE -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-tachometer-alt"></i>
                              <span>Manage Users</span>
                              <span class="badge badge-pill badge-warning">New</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a href="user-requests.php">User Request
                                       <span class="badge badge-pill badge-success">Pro</span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="status-user.php">Change Status</a>
                                    </li>
                                    <li>
                                       <a href="view-all-users.php">View All User</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- BLOG MANAGE -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-shopping-cart"></i>
                              <span>Manage Blogs</span>
                              <span class="badge badge-pill badge-danger">3</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a  href="add-blog.php">Add Blogs
                                       </a>
                                    </li>
                                    <li>
                                       <a href="view_all_blog.php">Update Blog</a>
                                    </li>
                                    <li>
                                       <a href="view_all_blog.php">Delete Blog</a>
                                    </li>
                                    <li>
                                       <a href="view_all_blog.php">View All Blog</a>
                                    </li>
                                      <li>
                                       <a href="view_all_blog.php">Change The Blog Status</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- POST MANAGE -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="far fa-gem"></i>
                              <span>Manage Posts</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a href="add-post.php">Add New Post</a>
                                    </li>
                                   
                                    <li>
                                       <a href="view-all-post.php">View All Posts</a>
                                    </li>
                                    <li>
                                       <a href="view-all-post.php">Change the Status OF Post</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- MANAGE CATEGORY -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-chart-line"></i>
                              <span>Manage Category</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a onclick="Add()" href="#">Add Category</a>
                                    </li>
                                    <li>
                                       <a href="#" onclick="viewall()">Update Category</a>
                                    </li>
                                    <li>
                                       <a href="#" onclick="viewall()">Delete Category</a>
                                    </li>
                                    <li>
                                       <a href="#" onclick="viewall()">Change Status</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- Manage FeedBacks -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-chart-line"></i>
                              <span>Manage FeedBacks</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a href="#" onclick="viewallfeedback()">View All Feedback</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- MANAGE COMMENTS -->
                           <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-chart-line"></i>
                              <span>Manage Comments</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a href="#" onclick="viewallcomment()">View All Comments</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- MANGER FOLLOWER -->
                            <li class="sidebar-dropdown">
                              <a href="#">
                              <i class="fa fa-chart-line"></i>
                              <span>Manage FOLLOWER</span>
                              </a>
                              <div class="sidebar-submenu">
                                 <ul>
                                    <li>
                                       <a href="#" onclick="countfollower()">View All Followers</a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                           <!-- MANGER FOLLOWER -->
                         </div>
                         <!-- sidebar-content  -->
                         <div class="sidebar-footer">
                              <a href="#">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-pill badge-warning notification">3</span>
                              </a>
                              <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="badge badge-pill badge-success notification">7</span>
                              </a>
                              <a href="#">
                                <i class="fa fa-cog"></i>
                                <span class="badge-sonar"></span>
                              </a>
                              <a href="../back-end-pages/logout_process.php">
                                <i class="fa fa-power-off"></i>
                              </a>
                         </div>
                       </nav>
                 </div>
           <!-- sidebar-wrapper  -->
  
      <script>
               jQuery(function ($) {

             $(".sidebar-dropdown > a").click(function() {
           $(".sidebar-submenu").slideUp(200);
           if (
             $(this)
               .parent()
               .hasClass("active")
           ) {
             $(".sidebar-dropdown").removeClass("active");
             $(this)
               .parent()
               .removeClass("active");
           } else {
             $(".sidebar-dropdown").removeClass("active");
             $(this)
               .next(".sidebar-submenu")
               .slideDown(200);
             $(this)
               .parent()
               .addClass("active");
           }
         });

         $("#close-sidebar").click(function() {
           $(".page-wrapper").removeClass("toggled");
         });
         $("#show-sidebar").click(function() {
           $(".page-wrapper").addClass("toggled");
         });


            
            
         });     
      </script>
      <?php include('footer.php'); ?>
  
  </body>
</html>