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
  <h1 class="m-n font-thin h3">Invoice List</h1>
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
            <th  style="width:25%">Invoice Date</th>
            <th  style="width:25%">Sales Period</th>
            <th  style="width:15%">Status</th>
          </tr>
        </thead>
        <tbody>
              <tr>
           <td> <a href="invoice.html"><u>9399034</u></a></td>
            <td>20 OCT 2016</td>
            <td>15 October - 19 October 2016</td>
            <td><span class="label bg-warning">Unpaid</span></td>
            </tr><tr>
                  <td>9399034</td>
            <td>10 OCT 2016</td>
            <td>5 October - 9 October 2016</td>
            <td><span class="label bg-success">Paid</span></td></tr>
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
