
<!DOCTYPE html>
<html lang="en" class="">


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

$servername = "localhost";
$username = "holly";
$password = "milk";
$dbname = "devapps";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select p.productName, pi.inventoryQty from products p join perpetualinventory pi on p.productID = pi.productID  WHERE pi.username='{$_SESSION['username']}'and pi.active=1;";
$result = $conn->query($sql);
$message = "";
    echo "As of " . date("Y/m/d") . " The following products should be re-ordered:<br>";
while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
    if("{$row['inventoryQty']}" <= 10)
        echo "{$row['productName']} with {$row['inventoryQty']} stocks left.<br>";
    else
        $message = "These are the only products needed to be re-ordered. If empty, there are no products needed to be re-ordered.";
}
    echo $message . "<br>";
    echo "============================================================================================= <br>";



?>



<?php

?>
<form method="POST">
  <!-- content -->
  

</html>
