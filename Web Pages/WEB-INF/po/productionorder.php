<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

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
  require_once('../../mysqlConnector/mysql_connect.php');
                $query="select productID, productName, wholesalePrice, retailPrice, sku from products";
                $result=mysqli_query($dbc,$query);
  ?>

  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Production Order</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Create Production Order
          </div>
          <div class="wrapper-md">

           <b>Products to be Ordered
           </b> <br>
        <!--  <button type="submit" name="add" class="btn btn-default" id="add">Add Product</button><br> -->
           <form action="productionorder.php" method="post">
            <div class="table-responsive">
              <table  class="table table-striped b-t b-b" id="myTable">
                <thead>
                  <tr>
                    <th  style="width:25%">SKU</th>
					  <th  style="width:25%">Product Name</th>
                    <th  style="width:10%">Quantity</th>
					  <th  style="width:10%">Produce</th>
                   
                  </tr>
                </thead>
                <tbody id="tableList">
					<?php

											$output = NULL;
										
	//connect to db

												$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
											

	//query db
//if not work use *
$resultSet=$mysqli->query("SELECT sku, productName, SUM(pu2.purchaseQty) as purchaseQty,pu2.productID, pu.poNumber FROM purchase pu JOIN purchase2 pu2
ON pu.poNumber=pu2.poNumber JOIN
 products p ON p.productID=pu2.productID WHERE ordered=0  GROUP BY productID;");
 
$resultSet2=$mysqli->query("SELECT DISTINCT pu.poNumber FROM purchase pu JOIN purchase2 pu2
ON pu.poNumber=pu2.poNumber JOIN
 products p ON p.productID=pu2.productID WHERE ordered=0 ;");
 While($row=$resultSet2->fetch_assoc()){
	 echo "
<input type=hidden name='poNumber[]' value=".$row['poNumber'].">";
															
 }


														if($resultSet->num_rows>0){
															while($rows=$resultSet->fetch_assoc()){

																echo "</tbody><tr>
															<td >".$rows['sku']."<input type=hidden name='productID[]' value=".$rows['productID']."></td>
																<td >".$rows['productName']."</td>
																<td >".$rows['purchaseQty']."</td>
																<td><input type=number min=0 name='orderQty[]' onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder=quantity>
															</tr></tbody>";
														}
		//if no data output 
													}else{

														echo"No results";
													}

										?>
               </tbody>
              </table>
              <button type="submit" name="confirm" class="btn btn-success">Submit</button> 
              
              
            </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>





<?php
        if (isset($_POST['confirm'])){
            $productID=$_POST['productID'];
            $orderQty=$_POST['orderQty'];
			$poNumber=$_POST['poNumber'];
			

            echo "<script>alert('1');</script>";
            $items = array_combine($productID,$orderQty);
            $pairs = array();
            
  
            $query4="INSERT INTO productionorder (produced,username) VALUES ('1','{$_SESSION['username']}');";

		
			//$result4=mysql_query($dbc,$query4);
			$result4 = mysqli_query($dbc,$query4);
			
			$query5="UPDATE purchase SET ordered=1 WHERE poNumber IN('".implode(poNumber,"','")."')";
		
			print_r($poNumber);
			
			$result5=mysqli_query($dbc,$query5);
			
			
			$query6="SELECT productionNo FROM productionorder ORDER BY productionNo DESC limit 1";
			$result6=mysqli_query($dbc,$query6);
			
			while($row=$result6->fetch_assoc()){
				$productionNo = $row["productionNo"];
				
			}
			
			$productionNo;
			
            foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','."'$productionNo'".')';
                }
            
           
            $query3= "INSERT INTO productionorder2 (productID, qty, productionNo) values".implode(',',$pairs);
            $result3=mysqli_query($dbc,$query3);
             echo "<script>alert('success');</script>";
        }
        
        ?>
  <!-- /content -->
  

</div>

<script>
 $(document).on('click', "#add", function(){
               var para = document.createElement("tr");
               var element = document.getElementById("tableList");
               para.setAttribute("class", "trList");
               element.appendChild(para);
               var e = document.getElementById("productChosen");
               var productID = e.options[e.selectedIndex].value;
               
               var productChosen = $("#productChosen").find(":selected").text();


                $(".trList").append('<td>'+productChosen+'<input type="number" style=display:none readOnly name="productID[]" value="'+productID+'"</td>');
                $(".trList").append('<td><input type="number" min="0" name="orderQty[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="quantity"/></td>');
                $(".trList").append('<td><input type="button" name="delete" id="delete" class="ibtnDel btn btn-outline btn-danger"  value=Delete ></td>');

                para.setAttribute("class", "trListSaved");
            });

 $(document).on('click', "#delete", function(event){
        $(this).closest("tr").remove();
               
            });


</script>
</body>
</html>
