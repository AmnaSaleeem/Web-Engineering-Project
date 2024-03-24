<?php  
			$per_page = 2;
			if(isset($_REQUEST['page']))
				{
					$start = $_REQUEST['page'] * $per_page ;
				}
			else
				{
					$start = 0;
					$_REQUEST['page'] = 0;
				}
			$query_total = "SELECT COUNT(*) AS 'total' FROM `post`";
			$res_total = mysqli_query($connection,$query_total);
			$total_rows = mysqli_fetch_assoc($res_total);
			$total_links =  ceil($total_rows['total']/$per_page);
			//echo $total_rows['total'];
			?>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
			<?php
			if($_REQUEST['page'] > 0)
			{
				?>
			 	<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $_REQUEST['page']-1; ?>">Previous
			 	</a> </li> 
				<?php
			}
			for ($i=1; $i < $total_links; $i++) 
			{ 	
				if($_REQUEST['page'] == $i)
				{
					?>
					<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ; ?>" id="active_link">
						<?php echo $i; ?>	
					</a></li>
					<?php
				}
				else
				{
					?>
					<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
				}
			}
			if($_REQUEST['page'] != $total_links - 1)
			{
				?>
				<li class="page-item">
			 	 <a class="page-link" href="index.php?page=<?php echo $_REQUEST['page']+1; ?>">Next
			 	</a>
			 	</li>
			<?php
			}
			?>
				</ul>
			 </nav>
