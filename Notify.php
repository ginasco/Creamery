 <!DOCTYPE html>
<html lang="en">
    <?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    }
?>
    <head>
        <meta charset="utf-8" />
        <title></title>
        
    </head>
    <body>
        <form method="post" action="Re-Order.php"> 
            <p><input type="submit" name="submit" value="Re-order"/></p>
            
        </form>
        
        
        <?php
        require_once('mysqlConnector/mysql_connect.php');

$sql = "select distinct(pi.productID), p.productName, sum(pi.inventoryQty) as inventoryQty
from products p join perpetualinventory pi on p.productID = pi.productID
group by productID";
$result = mysqli_query($dbc,$sql);
$message = "";
    echo "As of " . date("Y/m/d") . " The following products should be re-ordered:<br>";
while($row = $result->fetch_assoc()){
    if("{$row['inventoryQty']}" <= 10)
        echo "{$row['productName']} with {$row['inventoryQty']} stocks left.<br>";
    else
        $message = "These are the only products needed to be re-ordered. If empty, there are no products needed to be re-ordered.";
}
    echo $message . "<br>";
    echo "============================================================================================= <br>";



?>
        
        
        <a href="customer.php"> Main Menu</a>
			 <br><br>
    </body>
</html>
