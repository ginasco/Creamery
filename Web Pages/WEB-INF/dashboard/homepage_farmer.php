
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

</head>
<body>
<div class="app app-header-fixed ">
  

 <!-- header -->
  <?php include '../session/levelOfAccess.php';?>
  <!-- / aside -->


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = true; 
    app.settings.asideDock = true;
  ">
  <!-- main -->
  <div class="col">
    
	<h1>
	<center>
	<center>Welcome to Dairy MAN </center>
	<?php echo "Today is " . date("Y/m/d") . "<br>"; 
	date_default_timezone_set("asia/manila");
		echo "The time is " . date("h:i:sa");?>
	
	</center>
	</h1>
  <!-- / main -->
  <!-- right col -->
  
  <!-- / right col -->
</div>


	</div>
  </div>
  <!-- /content -->
</div>

</body>
</html>
