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
          <div class="h2 m-b-sm">55</div>
        </div>
        
        <div class="col-sm-3 col-xs-6">
          <div>Inventory Valuation <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">Php 3850</div>
        </div>
        <div class="col-sm-3 col-xs-6">
         <div>Quantity to be Delivered <i class="fa fa-fw fa-caret-down text-danger text-sm"></i></div>
          <div class="h2 m-b-sm">300</div>
        </div>
      </div>
    </div>
    
     <b>Current Stock Summary (Inventory)</b> 

    <div class="table-responsive">
      <table ui-jq="dataTable" ui-options="{
          sAjaxSource: 'api/datatable.json',
          aoColumns: [
            { mData: 'engine' },
            { mData: 'browser' },
            { mData: 'platform' },
            { mData: 'version' },
            { mData: 'grade' }
          ]
        }" class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:10%">SKU</th>
            <th  style="width:25%">Product Name</th>
            <th  style="width:20%">Expiration</th>
            <th  style="width:10%">Quantity</th>
            <th  style="width:10%">Purchasing Price</th>
            <th  style="width:10%">Selling Price</th>
            
        
          </tr>
        </thead>
        <tbody>
            <tr>
            <td>QSPT200</td>
            <td>200g Quesong Puti</td>
            <td>2016-11-12</td>
            <td>5</td>
            <td>Php 50</td>
            <td>Php 70</td>
          
      
          </tr>
             <tr>
            <td>CHMK500</td>
            <td>500ml Chocolate Milk</td>
            <td>2016-11-15</td>
            <td>50</td>   
            <td>Php 50</td>
            <td>Php 70</td>
          
               
          </tr>
          
        </tbody>
      </table>
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
