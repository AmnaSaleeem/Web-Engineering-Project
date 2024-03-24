<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Status</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		setInterval('GetTable()',1000);
		function GetTable()
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
				if(	obj.readyState==4	&&	obj.status==200 )
				{
					document.getElementById('Gettable').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','ajax_process.php?action=gettablestatus');
			obj.send();
		}
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
				if(	obj.readyState==4	&&	obj.status==200 )
				{
					document.getElementById('Gettable').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','ajax_process.php?action=active&user_id='+id);
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
				if(	obj.readyState==4	&&	obj.status==200 )
				{
					document.getElementById('Gettable').innerHTML=obj.responseText;
				}
			}
			obj.open('GET','ajax_process.php?action=inactive&user_id='+id);
				obj.send();
		}
	</script>
</head>
<body>
	<?php include('admin-header.php'); ?>
	<div class="container-fluid mt-3 ">
		<div class="row">
				<h3 class="text-center">Change Status Of User</h3>
				<hr>
			<div class="col-sm-12 border border-dark border-2 shadow rounded" id="Gettable">
				
			</div>
		</div>
	</div>
</body>
</html>