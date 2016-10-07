
<p>
<?php
session_start();
if ($_SESSION['usertype']!=102){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
}    
    
else{
    echo "WELCOME ".$_SESSION["username"]."!";
}

?>

<p><p>
FUNCTIONALITIES:
	<br><br>
	<a href="POS.php"> Record Sales </a>
	<br><br> 
	<a href="PO.php"> Generate Purchase Order</a>
	<br><br>	
	<a href="purchaseOrderReport.php"> Purchase Order Report</a>
	<br><br>
	<a href="Notify.php"> Notify and Confirm Re-order</a>
	<br><br>
	<a href="DR.php"> Generate Delivery Receipt</a>
	<br><br>
	<a href="invoiceReport.php"> Invoice Report</a>
	<br><br>
	<a href="searchDeliveryReceive.php"> Confirm Products Received</a>
	<br><br>		
	<a href="expiryTracker.php"> Expiry Tracker</a>
	<br><br>
	<a href="pullOut.php"> Pullouts</a>
	<br><br>	 	
    <a href="inventoryValuation.php"> Inventory Valuation</a>
	<br><br>
	<a href="salesReport2.php"> Sales Report</a>
	<br><br>
	
	
	 <a href="logout.php">Logout</a>
			  <br><br>
			
			