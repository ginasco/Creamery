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
        <h1 class="m-n font-thin h3">Admin Purchase Order List</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Dealer Purchase Orders
          </div>
          <div class="table-responsive">
            <table  class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:20%">P.O Number</th>
                  <th  style="width:25%">P.O Date</th>
                  <th  style="width:25%">Dealer Name</th>
                  <th  style="width:25%">Production Batch</th>
                  <th  style="width:15%">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                 <td> <a href="PO.php"><u>000002</u></a></td>
                 <td>1 November 2016</td>
                 <td>Marcus Ko</td>
                 <td>PB-1000</td>
                 <td><span class="label bg-warning">Unfulfilled</span></td>
               </tr><tr>
               <td> <a href="PO.php"><u>000001</u></a></td>
               <td>8 October 2016</td>
               <td>Marcus Ko</td>
               <td>N/A</td>
               <td><span class="label bg-danger">Cancelled</span></td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
   </div>



 </div>
</div>
<!-- /content -->





</div>



</body>
</html>
