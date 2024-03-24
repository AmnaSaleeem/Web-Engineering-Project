
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Requests</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">	
	setInterval('gettable()', 1000);
	function gettable()
	{
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
				document.getElementById('Gettable').innerHTML=obj.responseText;
				console.log(obj.responseText);
			}
		}
		obj.open('GET','ajax_process.php?action=gettable');
		obj.send();
	}
	function accept(id)
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
					document.getElementById('record').innerHTML=obj.responseText;
					// console.log(obj.responseText);
				}
			}
			obj.open('GET','ajax_process.php?action=accept&user_id='+id);
			obj.send();
		}
	function reject(id)
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
					
				}
			}
			obj.open('GET','ajax_process.php?action=reject&user_id='+id);
			obj.send();
		}
	</script>
	
</head>
<body>
	<?php include('admin-header.php'); ?>
	<div class="container mt-3">
		<div class="row">
				<h3 class="text-center"><u>User Requests</u></h3>
				<hr>
			<div class="col-sm-12 border rounded" id="Gettable">
				
			</div>		
		</div>
	</div>
</body>
</html>