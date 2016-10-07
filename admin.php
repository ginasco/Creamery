<html>
<body>
<?php
session_start();

    if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
    
else{
    
    echo "WELCOME ".$_SESSION["username"]."!";
}

?>
<p><p>
FUNCTIONALITIES:
	<br><br>
	<a href="addnewUser.php">Add New User</a>
	<br><br>
	<a href="updateUser.php"> Update/Disable User</a>
	<br><br>
	<a href="editProduct.php"> Edit Products</a>
 	<br><br>		
	<a href="salesReport.php"> Sales Report</a>
	<br><br>
			
			 
			 
			 
			 
			 
			 
			 
			 
			 <a href="logout.php">Logout</a>
			  <br><br>
			

	
			 
		
		
		
		
		
		
		
		
</body>
</html>