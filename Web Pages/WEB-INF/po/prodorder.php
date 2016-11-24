
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

</head>
<body>
<div class="app app-header-fixed ">
  

 <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   
   <!-- / nav -->

   <?php
if ($_SESSION['usertype']!=101){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?>
<?php
$productionNo = $_SESSION['productionNo'];
echo $productionNo;
 ?>



  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md hidden-print">
  <a href class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
  <h1 class="m-n font-thin h3">Production Orders / PB-1000</h1>
</div>
<div class="wrapper-md">
    <p class="m-t m-b">P.B Date: <strong>1 November 2016</strong><br>
        
        P.B ID: <strong>PB-1000</strong><br>
    Status: <span class="label bg-warning">In Production</span>
    </p>
  <div>
    <div class="well m-t bg-light lt">
      <div class="row">
        
        
      </div>
    </div>
    <div class="line"></div>
    <table class="table table-striped bg-white b-a">
      <thead>
        <tr>
          <th style="width: 60px">QTY</th>
            <th style="width: 70px">SKU</th>
            <th style="width:400px">DESCRIPTION</th>
        
     
        </tr>
      </thead>
      <tbody>
      
     	<?php
			$output = NULL;
											
	//connect to db

												$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
										

	//query db
//if not work use *
												
							$resultSet=$mysqli->query("SELECT * FROM productionorder po JOIN products p ON p.productID=po.productID WHERE Date(productionDate) LIKE '2016-07-15'");

														if($resultSet->num_rows>0){
															
															while($rows=$resultSet->fetch_assoc()){
$status = $rows['ordered'];
if($status ==0){
$status="unprocessed";	
}
else{
	$status="processed";
}
																echo "</tbody><tr>
																<td ><a href=prodorder.php>".$rows['orderQty']."</td>
																<td >".$rows['sku']."</td>
																<td >".$rows['productName']."</td>
															
																
															</tr></tbody>";
														}
														}
														
			?>
			
        
      </tbody>
    </table> 
      
       <button class="btn m-b-xs w-xs btn-danger">Cancel P.B</button>
  </div>
</div>


	</div>
  </div>
  <!-- /content -->
  




</div>



</body>
</html>
