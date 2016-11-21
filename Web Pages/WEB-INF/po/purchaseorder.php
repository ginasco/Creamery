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
   if ($_SESSION['usertype']!=102){
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
        <h1 class="m-n font-thin h3">Purchase Order</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Create Purchase Order
          </div>
          <div class="wrapper-md">

           <b>Products to be Ordered
           </b> <br>
           <select id="productChosen">
             <?php 
                require_once('../../mysqlConnector/mysql_connect.php');
                $query="select productID, productName, wholesalePrice, retailPrice, sku from products;";
                $result=mysqli_query($dbc,$query);
                
                if ($result!=null){
                  while($row=$result->fetch_assoc()) {
                    echo"<option value=".$row["productID"].">".$row["productName"]."</option>";
                  }
                }
                ?>
           </select> <button type="submit" name="add" class="btn btn-default" id="add">Add Product</button><br>
           <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="table-responsive">
              <table  class="table table-striped b-t b-b" id="myTable">
                <thead>
                  <tr>
                    <th  style="width:25%">Product Name</th>
                    <th  style="width:10%">Quantity</th>
                    <th  style="width:10%"></th>

                  </tr>
                </thead>
                <tbody id="tableList">
               </tbody>
              </table>
              <button type="submit" name="confirm" class="btn btn-success">Submit</button> 
              </form>
              
            </div>

</div>
</div>
</div>
</div>
</div>
</div>

<?php
        if (isset($_POST['confirm'])){
            $productID=$_POST['productName'];
            $purchaseQty=$_POST['orderQty'];
            $total="n/a";
            
            $items = array_combine($productID,$qtyOrder);
            $pairs = array();
            
            $remarks="n/a";
            
            foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','."'{$_SESSION['username']}'".','."'$total'".','."'$remarks'".')';
                }
            
            require_once('../mysql_connect.php');
            $query3= "INSERT INTO purchase (productID, purchaseQty, username, totalAmount, remarks) values".implode(',',$pairs);
            $result3=mysqli_query($dbc,$query3);
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
               var productChosen = $("#productChosen").find(":selected").text();
               alert(productChosen);

                $(".trList").append('<td>'+productChosen+'<input type="text" style=display:none readOnly name="productName[]" value="'+productChosen+'"</td>');
                $(".trList").append('<td><input type="number" min="0" name="orderQty[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="quantity"/></td>');
                $(".trList").append('<td><input type="button" name="delete" class="ibtnDel btn btn-outline btn-danger"  value=Delete ></td>');

                para.setAttribute("class", "trListSaved");
            });
</script>
</body>
</html>
