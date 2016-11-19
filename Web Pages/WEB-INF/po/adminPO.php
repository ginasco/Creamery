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
        <h1 class="m-n font-thin h3">Purchase Orders / PO-00002</h1>
      </div>
      <div class="wrapper-md">
        <p class="m-t m-b">P.O Date: <strong>1 November 2016</strong><br>
         For Sales Period: <strong>2 November 2016 - 10 November 2016</strong><br>
         P.O ID: <strong>PO-00002</strong><br>
         Status: <span class="label bg-warning">Unfulfilled</span>
       </p>
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
            
          </div>
        </div>
        <div class="line"></div>
        <table class="table table-striped bg-white b-a">
          <thead>
            <tr>
              <th style="width: 60px">QTY</th>
              <th style="width: 70px">SKU</th>
              <th style="width:400px">DESCRIPTION</th>
              
              <th style="width: 70px">UNIT PRICE</th>
              <th style="width: 90px">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>51</td>
              <TD>CHMK500</TD>
              <td>500ml Chocolate Milk</td>
              <td>PHP 50.00</td>
              <td>PHP 2550.00</td>
            </tr>
            <tr>
              <td>5</td>
              <TD>QSPT200</TD>
              <td>500G Quesong Puti</td>
              <td>PHP 50.00</td>
              <td>PHP 250.00</td>
            </tr>
            <tr>
              <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
              <td>PHP 2800.00</td>
            </tr>
            
            <tr>
              <td colspan="4" class="text-right no-border"><strong>12% VAT</strong></td>
              <td>PHP 336.00</td>
            </tr>
            <tr>
              <td colspan="4    " class="text-right no-border"><strong>Total</strong></td>
              <td><strong>PHP 3136.00</strong></td>
            </tr>
          </tbody>
        </table> 
        
        <button class="btn m-b-xs w-xs btn-danger">Cancel P.O</button>
      </div>
    </div>


  </div>
</div>
<!-- /content -->





</div>


</body>
</html>
