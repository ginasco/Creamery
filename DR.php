<?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 

$servername = "127.0.0.1:3306";
$username = "holly";
$password = "milk";
$dbname = "devapps";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM devapps.delivery;";
$result = $conn->query($sql);


echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Delivery Number
</div></b></td>
<td width="10%"><div align="center"><b>Delivery Date
</div></b></td>
<td width="10%"><div align="center"><b>Product ID
</div></b></td>
<td width="10%"><div align="center"><b>Quantity Delivery Receipt
</div></b></td>
<td width="10%"><div align="center"><b>Distributor Name
</div></b></td>
<td width="10%"><div align="center"><b>Delivered By
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['drNumber']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['deliveryDate']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['productID']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['quantityDR']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['distributorName']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['deliveredBy']}
</div></td>
</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <form method="post" action="GenerateDR.php">
            <p>Input Delivery Number to generate a Delivery Receipt</p>
            <p><input type="text" name="dr"></p>
            <p><input type="submit" name="submit" value="Generate"></p>
        </form>

    </body>
</html>
		 <a href="customer.php"> Main Menu</a>
			 <br><br>