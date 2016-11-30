
<!DOCTYPE html>
<html lang="en" class="">


<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" type="text/css" href="../sales/css/style.css" />

</head>
<body>
	<div class="app app-header-fixed ">


		<!-- nav -->
		<?php include '../session/levelOfAccess.php';
		?>

		<?php
		if ($_SESSION['usertype']!=102){
			header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
		} ?>

		<div id="content" class="app-content" role="main">
			<div class="app-content-body ">


				<div class="container">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-6">
        <div class="well">
          <div class="box">
            <div class="text-info">Products</div>
            <hr>
            
            <button class="buttons btn btn-primary" ng-click="add(products.milk)">1L Whole Milk</button>
            <button class="buttons btn btn-primary" ng-click="add(products.1llfmilk)">1L Low Fat Milk</button>
          </div>
          
          <br>
        
          
        </div>
      </div>
      
      <div class="col-sm-6">
        <div id="receipt" class="well">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Order Summary</h3>
            </div>
             <center> <H2>Laguna Creamery, Inc.</H2></center>
            <div class="panel-body" style="max-height:320px; overflow:auto;">
              <div class="text" ng-hide="order.length">
                Select products.
              </div>
              <ul class="list-group">
                <li class="list-group-item" ng-repeat = "item in order">
                  <div class="label label-success"> PHP {{item.item.price}}</div>
                   {{item.item.detail}}
                  
                  <button class="btn btn-danger btn-xs pull-right" ng-click="deleteItem($index)">
                    <span class="glyphicon glyphicon-trash"></span>
                  </button>
                </li>
              </ul>

            </div>
            <div class="panel-footer" ng-show="order.length">
              <div class="label label-danger">Subtotal: PHP {{getSum()}}</div>
                 <form>Cash Tendered: <input id="tendered" type="number" name="points" min="0" ></form>
            </div>
            <div class="panel-footer" ng-show="order.length">
              <div class="text-muted">
               
              </div>
            </div>
            <div class="pull-right">
              <span class="btn btn-default" ng-click="clearOrder()" ng-disabled="!order.length">Clear</span>
              <span class="btn btn-danger" ng-click="checkout()" ng-disabled="!order.length">Checkout</span>
                <button onclick="printContent('receipt')">Print Receipt</button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
		</div>
		</div>
		<!-- content -->

	 

	</div>
</div>




<script src="../sales/js/pos.js"></script>

    <script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

</body>


</html>
