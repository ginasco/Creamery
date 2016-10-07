 <a href="customer.php"> Main Menu</a>
			 <br><br>
<?php
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
$dr = $_POST['dr'];
//changes
if(!is_numeric($dr) || $dr < 0)
echo "Invalid input. Please enter a valid input.";
//
else{
$sql = "SELECT distributorName, deliveredBy FROM delivery where drNumber = $dr;";
$result = $conn->query($sql);

echo "<h1>Delivery Receipt No. $dr</h1>";
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">';
while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"left\"><b>From: {$row['deliveredBy']}
</div></td>
<td width=\"10%\"><div align=\"left\"><b>To: {$row['distributorName']}
</div></td>
</tr>";
}

echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Product ID
</div></b></td>
<td width="10%"><div align="center"><b>Product
</div></b></td>
<td width="10%"><div align="center"><b>Quantity
</div></b></td>
<td width="10%"><div align="center"><b>Delivery Date
</div></b></td>
</tr>';

$sql = "SELECT delivery.deliveryDate, delivery.productID, delivery.quantityDR, products.productName
FROM delivery 
inner join products 
on delivery.productID = products.productID 
where drNumber = $dr;";
$result = $conn->query($sql);
while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['productID']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['productName']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['quantityDR']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['deliveryDate']}
</div></td>
</tr>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
