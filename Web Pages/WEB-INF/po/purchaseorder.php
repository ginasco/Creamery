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
        </b> 

    <div class="table-responsive">
      <table  class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:10%">SKU</th>
            <th  style="width:25%">Product Name</th>
            <th  style="width:10%">Quantity</th>
            <th  style="width:10%">Purchasing Price</th>
            <th  style="width:10%">Selling Price</th>
            
          </tr>
        </thead>
        <tbody>
            <tr>
            <td>QSPT200</td>
            <td>200g Quesong Puti</td>
            <td><div class="col-sm-10">
            <input type="number" min="0" ui-options="" class="form-control w-md" />
          </div></td>
            <td>Php 50.00</td>
            <td>Php 70.00</td>
          
      
          </tr>
             <tr>
            <td>CHMK500</td>
            <td>500ml Chocolate Milk</td>
            <td><div class="col-sm-10">
            <input type="number" min="0" ui-options="" class="form-control w-md" />
          </div></td>   
            <td>Php 50.00</td>
            <td>Php 70.00</td>
          
               
          </tr>
          
        </tbody>
      </table>
      <button type="submit" class="btn btn-default">Reset</button>     <button type="submit" class="btn btn-success">Submit</button> 
    </div>

                  
</di
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
  
 



</div>


</body>
</html>
