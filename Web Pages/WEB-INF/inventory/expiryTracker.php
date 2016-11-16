
<!DOCTYPE html>
<html lang="en" class="">
<form method="POST">

  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

</head>
<body>
<div class="app app-header-fixed ">
  

 <!-- nav -->
<?php include '../session/levelOfAccess.php';?>
<?php
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
    } 
$flag=0;
$output = NULL;
if(isset($_POST['submit'])){
$message=NULL;

 if (empty($_POST['productName'])){
  $productName=NULL;
 }else
  $productName=$_POST['productName'];

	//connect to db
	$mysqli = NEW MySQLi("localhost","holly","milk","devapps");

	//get string value from search
	//removes any special characters
	$search = $mysqli->real_escape_string($_POST['search']);
	

	$resultSet=$mysqli->query("
Select p.productName,pi.expiryDate, pi.inventoryQty FROM perpetualinventory pi JOIN products p  
ON p.productID=pi.productID WHERE pi.username='{$_SESSION['username']}' and p.productName LIKE 'Milk' and pi.active=1;");
//and p.productName='$search%'");
// WHERE pi.username='{$_SESSION['username']}' and p.productName='$search%'");

echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>

<td width="10%"><div align="center"><b>Product Name
</div></b></td>
<td width="10%"><div align="center"><b>Expiry Date
</div></b></td>
<td width="10%"><div align="center"><b>inventoryQty
</div></b></td>
</tr>';

	//check if there are any info gathered from db
	
	if($resultSet->num_rows>0){
		while($rows=$resultSet->fetch_assoc()){

		$productName= $rows['productName'];
		$expiryDate=$rows['expiryDate'];
		$inventoryQty=$rows['inventoryQty'];
		
echo "<tr>
<td width=\"5%\"><div align=\"center\">{$productName}
</div></td>
<td width=\"5%\"><div align=\"center\">{$expiryDate}
</div></td>
<td width=\"5%\"><div align=\"center\">{$inventoryQty}
</div></td>
</tr>";
	//if no data output 
	}}else{
			
			echo"No results";
	}








}
?>
		<div class="col-sm-4 form-group">
							<p>Product:</p> <br>
               <select name="search">
						
                        <option value="Milk">Milk</option>
                        <option value="Yogurt">Yogurt</option>
						<option value="Chocolate Milk">Chocolate Milk</option>
                        <option value="Kesong Puti">Kesong Puti</option>
						<option value="Low Fat Milk">Low Fat Milk</option>
           
                       
                    </select>
					<input type="SUBMIT"  required name="submit" value="search"/>
							</div>
<br> <br>
<br> <br>
<br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>

<br><br>



<?php

?>
<form method="POST">
  <!-- content -->
  

</html>
