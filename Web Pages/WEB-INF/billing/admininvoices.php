
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
  <h1 class="m-n font-thin h3">Admin Invoice List</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Invoices
    </div>
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
            <th  style="width:20%">Invoice Number</th>
            <th  style="width:25%">Dealer Name</th>
            <th  style="width:25%">Invoice Date</th>
            <th  style="width:15%">Status</th>
       
          </tr>
        </thead>
        <tbody>
              <tr>
           <td> <a href="invoice.html"><u>9399034</u></a></td>
            <td>Marcus Ko</td>
            <td>20 OCT 2016</td>
            <td><span class="label bg-warning">Unpaid</span></td>
            <td><input type="checkbox" value=""></td>
            </tr>
            <tr>
           <td> <a href="invoice.html"><u>9499034</u></a></td>
            <td>Marcus Ko</td>
            <td>9 OCT 2016</td>
            <td><span class="label bg-success">Paid</span></td>
            <td><input type="checkbox" value=""></td>
            </tr>
        </tbody>
      </table>
<div class="col-sm-2">
         <select name="account" class="form-control m-b">
              <label class="col-sm-2 control-label">Change Invoice Status</label>
              <option>Paid</option>
              <option>Unpaid</option>
              <option>Overdue</option>
              <option>Canceled</option>
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
</body>
</html>
