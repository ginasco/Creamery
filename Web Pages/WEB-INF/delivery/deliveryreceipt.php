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
	    

<div class="bg-light lter b-b wrapper-md hidden-print">
  <a href class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
  <h1 class="m-n font-thin h3">Delivery Receipt / DEL/MK/00001</h1>
</div>
<div class="wrapper-md">
  <div>

    <div class="well m-t bg-light lt">
      <div class="row">
        <div class="col-xs-6">
          <strong>Customer:</strong>
          <h4>Marcus Ko</h4>
          <p>
            19 Anahaw Road<br>
            North Forbes Park, Makati City<br>
            National Capital Region <br>
            Phone: +63 917 325 8562<br>
            Email: marcus_ko@gmail.com<br>
          </p>
        </div>
        <div class="col-xs-6">
          <strong>DETAILS</strong>
          <p>
            <B>Date of Delivery:</B> November 3, 2016 <br>
            <b>Truck Assigned:</b> PPO 686<br>
           
          </p>
        </div>
      </div>
    </div>
    <p class="m-t m-b">Order date: <strong>November 1, 2016</strong><br>
        Order status: <span class="label bg-warning">In Transit</span><br>
        Purchase Order ID: <strong>#9399034</strong>
    </p>
    <div class="line"></div>
    <table class="table table-striped bg-white b-a">
      <thead>
        <tr>
          <th style="width: 60px">RECEIVED</th>
          <th style="width: 140px">SKU</th>
              <th>PRODUCT DESCRIPTION</th>
          <th style="width: 60px">QTY</th>
          <th style="width: 90px">EXPIRY DATE</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="checkbox" value=""></td>
          <td>CHMK500</td>
          <td>500ml Chocolate Milk</td>
          <td>30</td>
          <td>2016-11-9</td>
        </tr>
        <tr>
        <TD><input type="checkbox" value=""></TD>
           <td>QSPT200</td>
          <td>200g Quesong Puti</td>
          <td>30</td>
          <td>2016-11-9</td>
        </tr>
        
      </tbody>
    </table>   
      
      <Strong>Delivery Confirmation Code</Strong>
      <br><Strong>CLICK FIELD THEN SCAN BARCODE WITH SCANNER</Strong>
       <input type="password" class="form-control" placeholder="Confirmation Code">
            
      
       <align="right"><button class="btn m-b-xs w-xs btn-success">Delivered</button></align> 
  </div>
</div>
        </div>
        
        


	</div>
  </div>
  <!-- /content -->
  
  



</div>


</body>
</html>
