<?php
if ($_SESSION['usertype']!=102){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?>
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

  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Sales Report</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
    Sales Report
    </div>
    <div class="wrapper-md">
 
           
          <div class="col-sm-8">
            <b>Date Range</b><br><input ui-jq="daterangepicker" ui-options="{
                format: 'YYYY-MM-DD',
                startDate: '2013-01-01',
                endDate: '2013-12-31'
              }" class="form-control w-md" />
          </div>
          
           <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": false
        },
        "filtering": {
          "enabled": false
        },
        "sorting": {
          "enabled": false
        }}'>
        <thead>
          <tr>
            <th data-breakpoints="xs">SKU</th>
            <th>Product Name</th>
            <th data-breakpoints="xs">Quantity Sold</th>
            <th data-breakpoints="xs sm">Cost of Goods Soldf</th>
            <th data-breakpoints="xs sm md">Sales Revenue</th>
          </tr>
        </thead>
        <tbody>
          <tr data-expanded="true">
            <td>CHMK500</td>
            <td>500ml Chocolate Milk</td>
            <td>67</td>
            <td>PHP 3500</td>
            <td>PHP 4020</td>
          </tr>
          <tr>
            <td>QSPT200</td>
            <td>200g Quesong Puti</td>
            <td>85</td>
            <td>PHP 8500</td>
            <td>PHP 12750</td>
      
          </tr>
             
          
            
            
        </tbody>
      </table>
               
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Summary
    </div>
    <div class="wrapper-md">
 <div class="wrapper-md bg-white-only b-b">
      <div class="row text-center">
          <div class="col-sm-3 col-xs-6">
          <div>Quantity Sold <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">152</div>
        </div>
        <div class="col-sm-3 col-xs-6">
          <div>Total COGS <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">Php 12,000.00</div>
        </div>
        
        <div class="col-sm-3 col-xs-6">
          <div>Revenue <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">Php 16,770.00</div>
        </div>
        <div class="col-sm-3 col-xs-6">
         <div>Running Profit <i class="fa fa-fw fa-caret-down text-danger text-sm"></i></div>
          <div class="h2 m-b-sm">Php 4,770.00</div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
  
  



</div>



</body>
</html>
