<?php
if ($_SESSION['usertype']!=101){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?>
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
  

 <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   
   <!-- / nav -->


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    
<div class="container">
    <h1 class="well">Create New Dealer</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" placeholder="Enter First Name Here.." class="form-control">
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" placeholder="Enter Last Name Here.." class="form-control">
							</div>
						</div>					
						<div class="form-group">
							<label>Address</label>
							<textarea placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>City</label>
								<input type="text" placeholder="Enter City Name Here.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>State</label>
								<input type="text" placeholder="Enter State Name Here.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>Zip</label>
								<input type="text" placeholder="Enter Zip Code Here.." class="form-control">
							</div>		
						</div>
						<div class="row">
								
							
						</div>						
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" placeholder="Enter Phone Number Here.." class="form-control">
					</div>		
					<div class="form-group">
						<label>Email Address</label>
						<input type="text" placeholder="Enter Email Address Here.." class="form-control">
					</div>	
				
					<button type="button" class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
				</div>
	</div>
	</div>
         
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</body>
</html>
