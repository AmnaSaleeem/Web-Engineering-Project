<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="container">
 		<div class="row">
 			<div class="col-sm-12">
 				<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
				  <div class="carousel-indicators">
				    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
				  </div>
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="images/bgimage1.jpg" class="d-block w-100" alt="..." style="height: 300px;">
				      <div class="carousel-caption d-none d-md-block text-dark">
				        <h5>New Post</h5>
				        <p>Some representative placeholder content for the first slide.</p>
				      </div>
				    </div>
				    <div class="carousel-item">
				      <img src="images/bgimage2.jpg" class="d-block w-100" alt="..." style="height: 300px;">
				      <div class="carousel-caption d-none d-md-block text-dark">
				        <h5>Second slide label</h5>
				        <p>Some representative placeholder content for the second slide.</p>
				      </div>
				    </div>
				    <div class="carousel-item">
				      <img src="images/bgimage3.jpg" class="d-block w-100" alt="..." style="height: 300px;">
				      <div class="carousel-caption d-none d-md-block text-dark">
				        <h5>Third slide label</h5>
				        <p>Some representative placeholder content for the third slide.</p>
				      </div>
				    </div>
				  </div>
				  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Previous</span>
				  </button>
				  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Next</span>
				  </button>
				</div>
 			</div>
 			<!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
			  <div class="carousel-inner">
			  	<?php
			  		require('../back-end-pages/dbconnect.php');
			  		 $query="SELECT * FROM post";
			  		  $result=mysqli_query($connection,$query);
			  		  while($postimages=mysqli_fetch_assoc($result))
			  		  {
			  	?>
			    <div class="carousel-item active">
			      <img src="<?php echo $postimages['featured_image'];?>" class="d-block w-100" alt="..." style="height: 200px;width: 100% ;  animation-delay: 10s;">
			    </div>
				<?php } ?>
			  </div>
			</div> -->
 		</div>
 	</div>

</body>
</html>