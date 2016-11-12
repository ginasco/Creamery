<?php
if ($_SESSION['usertype']!=101){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?><!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  

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
        <h1 class="m-n font-thin h3">Products</h1>
        <br><button class="btn m-b-xs  btn-default" data-toggle="modal" data-target="#modal">Create Product</button>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Master List of all products for sale across outlets
          </div>
          <div>
            <table class="table" >
              <thead>
                <tr>
                  <th data-breakpoints="xs">SKU</th>
                  <th>Product Name</th>
                  <th data-breakpoints="xs">Shelf Life</th>
                  <th data-breakpoints="xs sm">Quantity Distributed</th>
                  <th data-breakpoints="xs sm md" data-title="Status">Unit Price</th>
                  <th data-breakpoints="xs sm md" data-title="Status">Retail Price</th>
                  <th data-breakpoints="xs sm md" data-title="Status">Status</th>
                  <th width="20px" data-title="Status">Select</th>
                </tr>
              </thead>
              <tbody>
                <tr data-expanded="true">
                  <td>CHMK500</td>
                  <td>500ml Chocolate Milk</td>
                  <td>D+5</td>
                  <td>90</td>
                  <td>Php 50.00</td>
                  <td>Php 55.00</td>
                  <td><button class="btn m-b-xs w-xs btn-success">Active</button>
                    <td><input type="checkbox" value=""></td></td>
                    
                  </tr>
                  <tr data-expanded="true">
                    <td>QSPT200</td>
                    <td>200g Quesong Puti</td>
                    <td>D+7</td>
                    <td>35</td>
                    <td>Php 50.00</td>
                    <td>Php 55.00</td>
                    <td><button class="btn m-b-xs w-xs btn-success">Active</button> </td>
                    <td><input type="checkbox" value=""></td>
                    
                  </tr>
                  
                  <tr data-expanded="true">
                    <td>LFMK500</td>
                    <td>500ML Low Fat Milk</td>
                    <td>D+5</td>
                    <td>0</td>
                    <td>Php 50.00</td>
                    <td>Php 55.00</td>
                    <td><button class="btn m-b-xs w-xs btn-default disabled">Disabled</button> </td>
                    <td><input type="checkbox" value=""></td>
                  </tr>
                  
                </tbody>
              </table>
              
              <div class="col-sm-2">
               <select name="account" class="form-control m-b">
                <label class="col-sm-2 control-label">Change Product Status</label>
                <option>Active</option>
                <option>Disabled</option>
              </select>
              <button class="btn m-b-xs  btn-default">Reset</button> <button class="btn m-b-xs w-xs btn-success">Submit</button> 
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
  <!-- /content -->
  




</div>



<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Create Product</h4>
      </div>
      <div class="modal-body">
        
       <div class="panel-heading font-bold">All Fields are Required</div>
       <div class="panel-body">
        <form role="form">
          <div class="form-group">
            <label>SKU</label>
            <input  class="form-control" placeholder="SKU Code" maxlength="7">
          </div>
          <div class="form-group">
            <label>Product Name</label>
            <input  class="form-control" placeholder="Name" required >
          </div>
          
          <div class="form-group">
            <label>Product Volume</label>
            <input  class="form-control" maxlength="3" placeholder="Volume" required>
          </div>
          
          <div class="form-group">
            <label>Product Unit</label>
            <input  class="form-control" maxlength="2" placeholder="Unit" required >
          </div>
          
          
          <div class="form-group">
            <label>Unit Price</label>
            <input type="number" class="form-control"  placeholder="Unit Price" required>
          </div>
          
          <div class="form-group">
            <label>Retail Price</label>
            <input type="number" class="form-control"  placeholder="Retail Price" required >
          </div>
          
          <div class="form-group">
            <label>Shelf Life</label>
            <input type="number" class="form-control"  placeholder="Days (D+X)" required >
          </div>
          
          
          
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
    
  </div>
  <div class="modal-footer">
  </div>
</div>
</div>
</div>

</body>
</html>
