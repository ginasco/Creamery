
<!DOCTYPE html>
<form method="POST">
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

</head>
<body>
<div class="app app-header-fixed ">
  

 <!-- nav -->
<?php include '../session/levelOfAccess.php';
	$totalAmount= 0;
	$inHand=0;?>
<!-- / nav -->

<?php
if ($_SESSION['usertype']!=102){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?>

 
    
    <!-- Insert php here -->
<?php

if(isset($_POST['submit'])){
	//connect to db

	$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
	$search = $mysqli->real_escape_string($_POST['search']);
	$search2 = $mysqli->real_escape_string($_POST['search2']);

	//query db
 if(empty($search3)){
    $resultSet=$mysqli->query("SELECT pi.dateInstance,p.productName,p.qtyUnit,pi.inventoryQty,p.wholesalePrice,(p.wholesalePrice *(pi.inventoryQty)) AS total,pi.username FROM  products p  JOIN perpetualinventory pi ON p.productID= pi.productID 	
				   WHERE   pi.username='{$_SESSION['username']}' and pi.dateInstance BETWEEN '$search2%' AND '$search%'  and pi.active=1 ORDER BY pi.dateInstance");
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
$inHand+=$rows['inventoryQty'];
$totalAmount+=$rows['total'];
 //echo $inHand;
// echo $totalAmount;	
		
		}//if no data output 
		}//if no data output 
	else{
			
		echo"No results";
		}
 }








}
?>
 <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Outlet Inventory</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Inventory List
    </div>
    <div class="wrapper-md">
 <div class="wrapper-md bg-white-only b-b">
      <div class="row text-center">
        <div class="col-sm-3 col-xs-6">
          <div>Quantity in Hand <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm"><?php echo $inHand; ?></div>
        </div>
        
        <div class="col-sm-3 col-xs-6">
          <div>Inventory Valuation <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm"><?php echo $totalAmount; ?></div>
        </div>
       
      </div>
    </div>

		
		<div class="col-sm-8">  
      <div class="hero-unit">
		
		<p> Starting Date:
         <input type="text"  name="search2" data-date-format='yyyy-mm-dd' id="from" > 
		<?php //$date=0;	$from_date = date("Y-m-d", strtotime($date)); echo $from_date; ?>
		<p> End Date </p>
			 <input type="text" name="search"  data-date-format='yyyy-mm-dd' id="to" > 
			 <?php //  $to_date= date("Y-m-d", strtotime($date));  echo $to_date;?>
			 		<input type="SUBMIT" name="submit" value="search"/>
			 
			<br> <br> <br> 	<br> <br> <br><br> <br> <br>	<br> <br> <br><br> <br> <br>

        </div>
    </div>


        <script type="text/javascript">
 $(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
</script>     

<script src="../sales/js/bootstrap-datepicker.js"></script>     
</div>
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
  
  



</div>



</body>
</html>
