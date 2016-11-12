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


      <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
      app.settings.asideFolded = true; 
      app.settings.asideDock = true;
      ">
      <!-- main -->
      <div class="col">
        <div class="bg-black dker wrapper-lg" ng-controller="FlotChartDemoCtrl">
          <ul class="nav nav-pills nav-xxs nav-rounded m-b-lg">
            <li class="active"><a href>Day</a></li>
            <li><a href ng-click="refreshData()">Week</a></li>
            <li><a href ng-click="refreshData()">Month</a></li>
          </ul>
          <div ui-jq="plot" ui-refresh="d0_1" ui-options="
          [
          { data: [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ], points: { show: true, radius: 2}, splines: { show: true, tension: 0.4, lineWidth: 1 } }
          ],
          {
          colors: ['#23b7e5', '#7266ba'],
          series: { shadowSize: 3 },
          xaxis:{ font: { color: '#507b9b' } },
          yaxis:{ font: { color: '#507b9b' }, max:16 },
          grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#1c2b36' },
          tooltip: true,
          tooltipOpts: { content: 'Visits of %x.1 is %y.4',  defaultTheme: false, shifts: { x: 10, y: -25 } }
        }
        " style="min-height:360px" >
      </div>
    </div><br>
    
    <div class="wrapper-md bg-white-only b-b">
      <div class="row text-center">
        <div class="col-sm-3 col-xs-6">
          <div>Number of Sales <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">212</div>
        </div>
        <div class="col-sm-3 col-xs-6">
          <div>Items in Stock <i class="fa fa-fw fa-caret-down text-warning text-sm"></i></div>
          <div class="h2 m-b-sm">55</div>
        </div>
        <div class="col-sm-3 col-xs-6">
          <div>Next Delivery <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm">Not Scheduled</div>
        </div>
        <div class="col-sm-3 col-xs-6">
          <div>SKUs Low in Stock <i class="fa fa-fw fa-caret-down text-danger text-sm"></i></div>
          <div class="h2 m-b-sm">1</div>
        </div>
      </div>
    </div>
    <div class="wrapper-md">
      <div class="panel-heading">

        <div class="padder">      
          <b>My Invoices</b>
          <div class="table-responsive">
          <!--   <table ui-jq="dataTable" ui-options="{
            sAjaxSource: 'api/datatable.json',
            aoColumns: [
            { mData: 'engine' },
            { mData: 'browser' },
            { mData: 'platform' },
            { mData: 'version' },
            { mData: 'grade' }
            ]
          }" class="table table-striped b-t b-b"> -->
            <table ui-jq="dataTable" class="table table-striped b-t b-b">
          <thead>
            <tr>
              <th  style="width:15%">Invoice Number</th>
              <th  style="width:17%">Client Name</th>
              <th  style="width:17%">Invoice Date</th>
              <th  style="width:17%">Invoice Total</th>
              <th  style="width:17%">Balance Due</th>
              <th  style="width:17%">Due Date</th>
              <th  style="width:17%">View</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td>MK-0001</td>
              <td>Marcus Ko</td>
              <td>2016-11-3</td>
              <td>PHP 500</td>
              <td>PHP 0</td>
              <td>2016-11-4</td>
              <td><u>View</u></td>

            </tr>
            <tr>
              <td>MK-0002</td>
              <td>Marcus Ko</td>
              <td>2016-11-4</td>
              <td>PHP 1000</td>
              <td>PHP 1000</td>
              <td>2016-11-5</td>
              <td><u>View</u></td>


            </tr>

          </tbody>
        </table>
      </div>
    </div>


  </div>



</div>
<div class="wrapper-md">
  <!-- users -->

  <!-- / users -->
</div>
</div>
<!-- / main -->
<!-- right col -->

<!-- / right col -->
</div>


</div>
</div>
<!-- /content -->

</div>
</script>
</body>
</html>
