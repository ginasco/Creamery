<html>
    <head>       
        </head>
<body>
       <?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    }
?>

<h1>Expiry Tracker</h1>
<form method="POST">
<p> Search Product Name</p> <br>
<input type="TEXT"  name="search" />
<br> <br>

<input type="SUBMIT" name="submit" value="search"/>
    <input type="submit" name="showAll" value="Show All"/>
<br><br>

		
</form>


<?php
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
ON p.productID=pi.productID WHERE pi.username='{$_SESSION['username']}' and p.productName LIKE '$search%' and pi.inventoryQty!=0 order by pi.expiryDate");
//and p.productName='$search%'");
// WHERE pi.username='{$_SESSION['username']}' and p.productName='$search%'");

echo '<table width="75%" border="1" align="center" cellpadding="0" id="dataTable" cellspacing="0" bordercolor="#000000">
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
	}
    }else{
			
			echo"No results";
	}

}

if(isset($_POST['showAll'])){
    require_once('mysqlConnector/mysql_connect.php');
    
    echo '<table width="75%" border="1" align="center" cellpadding="0" id="dataTable" cellspacing="0" bordercolor="#000000">
            <tr>

            <td width="10%"><div align="center"><b>Product Name
            </div></b></td>
            <td width="10%"><div align="center"><b>Expiry Date
            </div></b></td>
            <td width="10%"><div align="center"><b>inventoryQty
            </div></b></td>
            </tr>';
      
    $query2="Select p.productName,pi.expiryDate, pi.inventoryQty FROM perpetualinventory pi JOIN products p  
            ON p.productID=pi.productID WHERE pi.username='{$_SESSION['username']}' and pi.inventoryQty!=0 order by pi.expiryDate";
    $result2=mysqli_query($dbc,$query2);
    if($result2->num_rows>0){
    while($row = $result2->fetch_assoc()) {
      
         $productName= $row['productName'];
		 $expiryDate=$row['expiryDate'];
		 $inventoryQty=$row['inventoryQty'];
         
        echo "<tr>
                <td width=\"5%\"><div align=\"center\">{$productName}
                </div></td>
                <td width=\"5%\"><div align=\"center\">{$expiryDate}
                </div></td>
                <td width=\"5%\"><div align=\"center\">{$inventoryQty}
                </div></td>
                </tr>";
     }
    }else{
			
			echo"No results";
	}
}
?>

<?php echo $output; ?>
            
        <a href="customer.php"> Main Menu</a>
			 <br><br>
 <a href="logout.php">Logout</a>
			  <br><br>    
 </body>
    
</html>