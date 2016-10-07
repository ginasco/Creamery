<html>
    <body>

<h1>Inventory Valuation(YY-MM-DD)</h1>
<form method="POST">
<p> From </p> <br>
<input type="TEXT" required name="search2" />
<p> To </p> <br>
<input type="TEXT" required name="search" />
<br> <br>
<p>Search by productID</p>
<input type='TEXT' name='search3' />
<br> <br>

<input type="SUBMIT" name="submit" value="search"/>
<br><br>
 
</form>

<style>

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<p>Product ID Legend</p>
<table style="width:25%">

  <tr>
    <td>Milk</td>
    <td>Yogurt</td>
    <td>Chocolate Milk</td>
	 <td>Kesong Puti</td>
    <td>Low Fat Milk</td>
  </tr>
  <tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
	 <td>4</td>
    <td>5</td>
  </tr>

</table>


<?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 


$output = NULL;
if(isset($_POST['submit'])){
	//connect to db

	$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
	$search = $mysqli->real_escape_string($_POST['search']);
	$search2 = $mysqli->real_escape_string($_POST['search2']);
	$search3 = $mysqli->real_escape_string($_POST['search3']);
	//query db
 if(empty($search3)){
    $resultSet=$mysqli->query("SELECT pi.dateInstance,p.productName,p.qtyUnit,pi.inventoryQty,p.wholesalePrice,(p.wholesalePrice *(pi.inventoryQty)) AS total,pi.username FROM  products p  JOIN perpetualinventory pi ON p.productID= pi.productID 	
				   WHERE   pi.username='{$_SESSION['username']}' and pi.dateInstance BETWEEN '$search2%' AND '$search%' ORDER BY pi.dateInstance");
  // pi.username='{$_SESSION['username']}' 
    
    echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Date
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
<td width="5%"><div align="center"><b>Product Name
</div></b></td>
<td width="5%"><div align="center"><b>quantity
</div></b></td>
<td width="5%"><div align="center"><b>quantityUnit
</div></b></td>
<td width="5%"><div align="center"><b>Wholesale Price
</div></b></td>
<td width="5%"><div align="center"><b>Total
</div></b></td>

</tr>';
    
    	if($resultSet->num_rows>0){
		while($rows=$resultSet->fetch_assoc()){

echo "<tr>
<td width=\"10%\"><div align=\"center\">".$rows['dateInstance']."
</div></td>
<td width=\"10%\"><div align=\"center\">".$rows['username']."
</div></td>
<td width=\"25%\"><div align=\"center\">".$rows['productName']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['inventoryQty']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtyUnit']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['wholesalePrice']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['total']."
</div></td>

</tr>";

	
		
		}//if no data output 
		}//if no data output 
	else{
			
		echo"No results";
		}
 }

else{$resultSet=$mysqli->query("SELECT pi.dateInstance,p.productName,p.qtyUnit,pi.inventoryQty,p.wholesalePrice,(p.wholesalePrice *(pi.inventoryQty)) AS total,pi.username FROM  products p  JOIN perpetualinventory pi ON p.productID= pi.productID 	
				   WHERE  pi.username='{$_SESSION['username']}' and p.productID='$search3' and pi.dateInstance BETWEEN '$search2%' AND '$search%' ORDER BY pi.dateInstance");
														//put here the session
														
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Date
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
<td width="25%"><div align="center"><b>Product Name
</div></b></td>
<td width="5%"><div align="center"><b>quantity
</div></b></td>
<td width="5%"><div align="center"><b>quantity unit
</div></b></td>
<td width="5%"><div align="center"><b>Wholesale Price
</div></b></td>
<td width="5%"><div align="center"><b>Total
</div></b></td>

</tr>';
	
	
	
	
	
	
	//check if there are any info gathered from db
	if($resultSet->num_rows>0){
		while($rows=$resultSet->fetch_assoc()){

echo "<tr>
<td width=\"10%\"><div align=\"center\">".$rows['dateInstance']."
</div></td>
<td width=\"10%\"><div align=\"center\">".$rows['username']."
</div></td>
<td width=\"25%\"><div align=\"center\">".$rows['productName']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['inventoryQty']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtyUnit']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['wholesalePrice']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['total']."
</div></td>

</tr>";

	
		}
		//if no data output 
	}else{
			
			echo"No results";
		}
	
	
        }





echo $output;

}
?>


			  <br><br>
			 <a href="customer.php"> Main Menu</a>
			 <br><br>
<a href="logout.php">Logout</a>

    </body>
</html>
