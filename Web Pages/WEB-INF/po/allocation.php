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


  <!-- content -->
  <div id="content" class="app-content" role="main">
   <div class="app-content-body ">


    <div class="bg-light lter b-b wrapper-md">
      <h1 class="m-n font-thin h3">Allocation</h1>
    </div>
    <div class="wrapper-md">
      <div class="panel panel-default">
        <div class="panel-heading">
          Products
        </div>
        <div class="table-responsive">
          <table  class="table table-striped b-t b-b">
            <thead>
              <tr>
                <th  style="width:20%">Product Name</th>
                <th  style="width:25%">Produced Qty</th>
                <th  style="width:25%">Expiration Date</th>
                <th  style="width:25%">Allocate</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              require_once('../../mysqlConnector/mysql_connect.php');

              $sql = "SELECT distinct(p.productionNo) as productionNo FROM `produced` p JOIN produced2 pu ON p.productionNo=pu.productionNo WHERE p.produced=1 and pu.allocated=0 ORDER BY producedDate";
              $result=mysqli_query($dbc,$sql);
              while($row = $result->fetch_assoc()) {

                $productionNo=$row["productionNo"];
                
                $sql = "SELECT p.productName,pr.producedQty, pr.expirationDate,pr.productID FROM produced2 pr JOIN products p ON pr.productID=p.productID WHERE pr.productionNo='{$productionNo}' ORDER BY p.productName";
                $result1=mysqli_query($dbc,$sql);
                while($row = $result1->fetch_assoc()) {

                 echo "<tr class='productRows'>
                 <td >".$row["productName"]."<input type=hidden class=productID name=productID value=".$row["productID"]."></td>
                 <td>".$row["producedQty"]."<input type=hidden class=producedQty name=producedQty value=".$row["producedQty"]."></td>
                 <td>".$row["expirationDate"]."<input type=hidden class=expirationDate name=expirationDate value=".$row["expirationDate"]."></td>
                 <td><button type=button name=allocate id=allocate >Allocate</button></td>";
               }



             }
             ?>

           </tbody>
         </table>
       </div>
     </div>
   </div>

   <form id="form" action="allocation.php"  method="post">
     <input type="hidden" id="toAllocateProdID" name="toAllocateProdID" />   
     <input type="hidden" id="toAllocatedProdQty" name="toAllocatedProdQty" />  
     <input type="hidden" id="toAllocatedExpiration" name="toAllocatedExpiration" />  
   </form> 




<div class="wrapper-md">
      <div class="panel panel-default">
        <div class="panel-heading">
           Allocation
        </div>
       


        <form  action="allocation.php"  method=Post>
                <div class="table-responsive">
<table class="table table-striped b-t b-b">
<thead>
              <tr>
                <th  style="width:20%">Dealer</th>
                <th  style="width:25%">Rating</th>
                <th  style="width:25%">Product Name</th>
                <th  style="width:25%">Quantity Ordered</th>
                <th  style="width:25%">Quantity Allocated</th>
              </tr>
            </thead>
<tbody>


<?php 
if (isset($_POST['toAllocateProdID'])){
  $toAllocateProdID=$_POST['toAllocateProdID'];
  $toAllocatedProdQty= $_POST['toAllocatedProdQty'];
  $toAllocatedExpiration=$_POST['toAllocatedExpiration'];


$sql = "SELECT  SUM(pu.purchaseQty) AS purchaseQty FROM purchase2 pu JOIN purchase p ON p.poNumber=pu.poNumber JOIN users u ON u.username=p.username JOIN usersinfo ui ON u.userID=ui.userID WHERE p.ordered=1 and pu.allocated=0 and pu.productID='{$toAllocateProdID}'";
  $result1=mysqli_query($dbc,$sql);



  while($row = $result1->fetch_assoc()) {
    $purchaseQty=$row["purchaseQty"];
  }


 $sql = "SELECT p.poNumber, p.username, ui.rating, pu.purchaseQty, u.userID, pt.productName FROM purchase2 pu JOIN purchase p ON p.poNumber=pu.poNumber JOIN users u ON u.username=p.username JOIN usersinfo ui ON u.userID=ui.userID JOIN products pt ON pu.productID=pt.productID WHERE p.ordered=1 and pu.allocated=0 and pu.productID='{$toAllocateProdID}'";
  $result1=mysqli_query($dbc,$sql);

// production = ordered
if($purchaseQty==$toAllocatedProdQty){

  while($row = $result1->fetch_assoc()) {
    $poNumbere=$row["poNumber"];
    $username=$row["username"];
    $rating=$row["rating"];
    $purchaseQty=$row["purchaseQty"];

     echo "<tr>
    <td>".$username."<input type=hidden name='usernameAllocation[]' value=".$row["username"]."></td>
    <td>".$rating."<input type=hidden name='expirationAllocation' value=".$toAllocatedExpiration."></td>
    <td>".$row["productName"]."<input type=hidden name='poNumber[]' value=".$row["poNumber"]."></td>
    <td>".$purchaseQty."</td>
    <td><input type=number readOnly name='prodQtyAllocation[]' id=toAllocatedProdQty value=".$purchaseQty."><input type=hidden name='productIdAllocation' value=".$toAllocateProdID."></td>
    </tr>";

  }
  
}


//
// else if(){
//}
  

//
// else if(){

// }



 






}


?>
</tbody >
</table>
</div>


<div class="pull-right">
<button  name="confirm">Confirm</button>
</div>
</form>




</div>


</div>
 </div>
</div>
<!-- /content -->
<?php  

  $items = array();
  $pairs3 = array();
if (isset($_POST['confirm'])){
   $usernamerray=$_POST['usernameAllocation'];
   $productID=$_POST['productIdAllocation'];
   $expirationDate=$_POST['expirationAllocation'];
   $poNumber=$_POST['poNumber'];
   $allocateQty=$_POST['prodQtyAllocation'];
   $deliveredBy="n/a";
   $deliveryDate="0000-00-00";
   $receiptGenerated=0;



foreach ($usernamerray as $key => $value) {
  $items[] = array(
     'usernameAllocation' => $usernamerray[$key],
   'allocatedQty' =>  $allocateQty[$key],
   'poNumber' =>  $poNumber[$key]
   );
}

    
 

 foreach($items as $key=>$value){

    $pairs3[] = '("'.strval($value['usernameAllocation']).'",'.intval($value['allocatedQty']).','.intval($value['poNumber']).','."'$expirationDate'".','."'$productID'".','."'$receiptGenerated'".')';
  }
   
//print_r($pairs3);


   // update produce table allocation status
   $sql = "UPDATE `produced2` SET `allocated`=1 WHERE `productID`='{$productID}' AND `expirationDate`='{$expirationDate}' ";
   $result=mysqli_query($dbc,$sql);


   //update purchase table allocation status
    $sql = "UPDATE `purchase2` SET `allocated`=1 WHERE `productID`='{$productID}' AND `poNumber` IN ('".implode($poNumber,"', '")."')";
    $result=mysqli_query($dbc,$sql);

   

   //insert into delivery table

   $sql = "INSERT INTO `allocation`(`username`, `qtyAllocated`,`purchaseNo`,`expirationDate`, `productID`,`receiptGenerated`) VALUES".implode(',',$pairs3);
   $result=mysqli_query($dbc,$sql);
}


?>


</div>
<script>

 $(document).on('click', "#allocate", function(e){
  e.preventDefault();
  var producID =  $(this).closest ('tr').find(".productID").val();
  var producedQty =  $(this).closest ('tr').find(".producedQty").val();
  var expirationDate =  $(this).closest ('tr').find(".expirationDate").val();
  document.getElementById('toAllocateProdID').setAttribute('value',producID);
  document.getElementById('toAllocatedProdQty').setAttribute('value',producedQty);
  document.getElementById('toAllocatedExpiration').setAttribute('value',expirationDate);
  $("#form").submit();
}); 


 

</script>


</body>
</html>
