
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

   <!-- modal -->

    <?php include '../view/modal.html';?>
   <!-- /modal -->

   <!-- content -->
   <div id="content" class="app-content" role="main">
     <div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Spoilage List</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
           Spoilage List
         </div>
         <div class="wrapper-md">
           

          <b>Spoilage List Summary</b> 

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">

            <div class="table-responsive">
              <table class="table table-striped b-t b-b">
                <thead>
                  <tr>
                    <th  style="width:30%">Control Number</th>
                    <th  style="width:45%">Dealer Name</th>
                    <th  style="width:30%">Pullout Date</th>
                  </tr>
                </thead>

                <?php

                require_once('../../mysqlConnector/mysql_connect.php');
                $query="Select distinct controlNum, distributorName, DATE(pullOutDate) AS pullOutDate From pullouts;";
                $result=mysqli_query($dbc,$query);
                while($row = $result->fetch_assoc()) {
                  $conNum=$row["controlNum"];
                  echo "<tbody><tr class='productRows'>
                   <td><a href=spoilage_info.php?action&conNum=".$conNum.">".$conNum."</a><input type=hidden name=controlNum value=".$row["controlNum"]."></td>
                   <td>".$row["distributorName"]."<input type=hidden name=distributorName value=".$row["distributorName"]."></td>
                   <td>".$row["pullOutDate"]."<input type=hidden name=pullOutDate value=".$row["pullOutDate"]."></td>
                   <td></td> 
                   </tr></tbody>";
             }

             ?>
             <p></p>

             <p></p>

           </table>

           <span ng-controller="ModalDemoCtrl">
            <script type="text/ng-template" id="myModalContent.html">
              <div ng-include="'tpl/modal.form.html'"></div>
            </script>
            
            
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php

if (isset($_POST['confirm'])){


  require_once('../../mysqlConnector/mysql_connect.php');
  $productID=$_POST['productID'];
  $inventoryQty=$_POST['inventoryQty'];
  //$pullOutName=$_POST['pullOutName']; --- do we still need this colum?
  $expiryDate=$_POST['expiryDate'];

  
    //-------insert to pullouts -------
    $query="insert into pullouts (distributorName) values ('{$_SESSION['username']}')";
    $result=mysqli_query($dbc,$query);
  //------- /insert to pullouts -------

  //------- get latest pullout control number -------
    $query2="select controlNum from pullouts order by controlNum DESC LIMIT 1";
    $result2=mysqli_query($dbc,$query2);
    while($row=$result2->fetch_assoc()) {
      $controlNum=$row["controlNum"];
    }
    $controlNum;
  //------- /get latest pullout control number -------

    $items = array_combine($productID,$inventoryQty);
    $pairs = array();

    $remarks="spoilage";

    foreach($items as $key=>$value){
      $pairs[] = '('.intval($key).','.intval($value).','."'$controlNum'".','."'$remarks'".')';
    }

  //------- inserting to pullouts2 table -------
    $query3= "INSERT INTO pullouts2 (productID, pullOutQty, controlNum, remarks) values".implode(',',$pairs);
    $result3=mysqli_query($dbc,$query3);
  //------- /inserting to pullouts2 table -------

  //------- update inventory -------
    $query4= "UPDATE perpetualinventory SET pulloutStat=1 WHERE productID IN ('".implode($productID,"', '")."') AND expiryDate IN ('".implode($expiryDate,"', '")."')";
    $result4=mysqli_query($dbc,$query4);
  //------- /update inventory -------

    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";

    header("location:expired.php"); 
    exit;
}

?>
<!-- /content -->
</div>
<script>
var rowCount = 0;
var quantityCount=0;
  $('.productRows').each(function(){
    rowCount++;

 });

  $('.inventoryQty').each(function(){
    quantityCount += parseFloat(this.value);

 });

if(rowCount==0){
  $("#confirm").prop('disabled', true); 
}

 var x = document.getElementById("qtyExpired");
 x.setAttribute("value", quantityCount);

 var y = document.getElementById("expiredSku");
 y.setAttribute("value", rowCount);

</script>

</body>
<script src="../sales/js/bootstrap-datepicker.js"></script>
</html>