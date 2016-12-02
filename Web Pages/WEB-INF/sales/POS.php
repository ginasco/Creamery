
<!DOCTYPE html>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
			<table>
			<thead>
			  <tr>
				<th></th>
				<th>Product Name</th>
				<th>Retail Price</th>
				<th>Quantity</th>
				<th>Expiry Date</th>
			  </tr>
            </thead>
				<tbody>
					<?php 
					require_once('../../mysqlConnector/mysql_connect.php');
					$query="SELECT i.productID, p.productName, p.retailPrice, i.inventoryQty, i.expiryDate
                    FROM perpetualinventory i JOIN products p ON i.productID = p.productID where inventoryQty>0";
					$result=mysqli_query($dbc,$query);
					while($row = $result->fetch_assoc()) {
                     echo"
                     
                            <tr>
                                <td><button type=submit name=add  class=btn btn-info btn-lg id=add>Add</button></td>
                                <td class=pR style=display:none>".$row["productID"]."</td>
                                <td class=pN>".$row["productName"]."</td> 
                                <td class=rP>".$row["retailPrice"]."</td>
                                <td class=qty>".$row["inventoryQty"]."</td>
                                <td class=qty>".$row["expiryDate"]."</td>
                            </tr>";
                }
					?>
				</tbody>
			</table>
            
          <!--  <button class="buttons btn btn-primary" ng-click="add(products.milk)">1L Whole Milk</button>
            <button class="buttons btn btn-primary" ng-click="add(products.1llfmilk)">1L Low Fat Milk</button>-->
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
                   
        <table id="receipt" style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable2" align="left">
        
            <thead>
  <tr>
	
    <th>Product Name</th>
    <th>Retail Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
	
      
  </tr>
            </thead> 
			
			<div>
                Received: <input id="received"   type="number" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="received" class="received"/>
               </div>
            
               <tbody id="tableList">           
           
                   
                 </tbody>
                
            
         </table>
		 
               
			   
			  
                  
                  
                </li>
              </ul>
			  

            </div>
            <div class="panel-footer" ng-show="order.length">
              <div class="label label-danger">Total: <input id="total" readonly style="background:transparent;border:none" type="number" name="total" class="total"/></div>
                 Change: <input id="change"  readonly type="number" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="change" class="change"/>
            </div>
			
            <div class="panel-footer" ng-show="order.length">
              <div class="text-muted">
               
              </div>
            </div>
            <div class="pull-right">
              <input type="submit" class="btn btn-danger" name="confirm" value="Confirm">
                <button class="btn btn-default" onclick="printContent('receipt')">Print Receipt</button>
            </div>
            
          </div>
		  </form>
        </div>
      </div>
    </div>
		</div>
		</div>
		<!-- content -->
 <?php
        if (isset($_POST['confirm'])){
            $productID=$_POST['productID'];
            $qtySold=$_POST['qtySold'];
            $productName=$_POST['productName'];
            $total=$_POST['total'];
           echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            $items = array_combine($productID,$qtySold);
            $pairs = array();
            
            
            $query="insert into sales(sold, status) values(1,0)";
            $result=mysqli_query($dbc,$query);
			//ok
            
            $query2="select receiptNum from sales order by dateSR DESC LIMIT 1";
            $result2=mysqli_query($dbc,$query2);
            //ok
            while($row = $result2->fetch_assoc()) {
                    $receiptNum=$row["receiptNum"];
                }
            $receiptNum;
            foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','."'{$_SESSION['username']}'".','."'$receiptNum'".','."'$total'".')';
                }
            $query3= "INSERT INTO salessr (productID, qtySR, username, receiptNum, totalSold) values".implode(',',$pairs);
            $result3=mysqli_query($dbc,$query3);
            //ok
            
            //update inventory
            
            $query7="select productID, expiryDate, inventoryQty
                    from perpetualinventory where inventoryQty<=0";
                $result7=mysqli_query($dbc,$query7);
                while($rowC = $result7->fetch_assoc()) {
                     $query8="update perpetualinventory set active=0 where expiryDate='{$rowC['expiryDate']}' and productID='{$rowC['productID']}'";
                     $result8=mysqli_query($dbc,$query8);
                 }
            
            
            $query4="select productID, qtySR
                    from salessr 
                    where receiptNum='{$receiptNum}'";
            $result4=mysqli_query($dbc,$query4);
            while($rowA = $result4->fetch_assoc()) {
                 $query6="select min(expiryDate) as expiryDate from perpetualinventory where productID ='{$rowA['productID']}' and active=1";
                 $result6=mysqli_query($dbc,$query6);
                 while($rowB = $result6->fetch_assoc()) {
                     $expiryDate=$rowB['expiryDate'];
                 }
                $expiryDate;
                
                
                
                
                $query5="UPDATE perpetualinventory
                         SET perpetualinventory.inventoryQty=perpetualinventory.inventoryQty-'{$rowA['qtySR']}'
                         WHERE perpetualinventory.productID='{$rowA['productID']}'
                         AND perpetualinventory.expiryDate = '$expiryDate' and active=1";
                $result5=mysqli_query($dbc,$query5);
				
				
            }
        }
        
        ?>
	 

	</div>
</div>

<script src='js/angular.js'></script>
<script src='js/angular-animate.js'></script>

<script src='js/jquery-2.0.3.min.js'></script>
<script src='js/bootstrap.min.js'></script>



<script>
$(document).ready(function() {

var app = angular.module('myApp', []);

app.controller('POSController', function ($scope) {
    $scope.products = {
      milk : {count: 1, detail: "One Liter Whole Milk", price: 150},

    };
    
    
    $scope.itemsCnt = 1;
    
    $scope.order = [];
    
    $scope.add = function(item) {
			alert("hello...");
      var foodItem = {
        id : $scope.itemsCnt,
        item : item
      };
      $scope.order.push(foodItem);
      $scope.itemsCnt = $scope.order.length;
    };
    
    $scope.getSum = function() {
      var i = 0,
        sum = 0;
      for(; i < $scope.order.length; i++) {
        sum += parseInt($scope.order[i].item.price, 10);
      }
      return sum;
    };
    
    $scope.deleteItem = function(index) {
      $scope.order.splice(index,1);
    };
    
    $scope.checkout = function(index) {
      alert("Order total: $" + $scope.getSum() + "\n\nPayment received. Thanks.");
    };
    
    $scope.clearOrder = function() {
      $scope.order = [];
    };
});
});
</script>

    <script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

<script>
            var change = 0;
           $(document).on('click', "#add", function(){
         //  document.getElementById().disabled = true; 
               
            $(this).prop('disabled', true);   
            var pR =  $(this).closest('tr').find(".pR").text();
            var pN =  $(this).closest('tr').find(".pN").text();
            var rP =  $(this).closest('tr').find(".rP").text();
            var qty =  $(this).closest('tr').find(".qty").text();
               
               var para = document.createElement("tr");
               var element = document.getElementById("tableList");
               para.setAttribute("class", "trList");
                element.appendChild(para);
				$(".trList").append('<td style=display:none><input name="productID[]" id="productID" type="text" readOnly value="'+pR+'" /></td>');
             $(".trList").append('<td><input name="productName" id="productName" type="text" readOnly value="'+pN+'"/></td>');
             $(".trList").append('<td><input type="hidden" class="currQty" value="'+qty+'"/> <input name="retailPrice" class="retailPrice" type="number" readOnly value="'+rP+'"/></td>');
             $(".trList").append('<td>  <input type="number" class="num" id="orderValue" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="qtySold[]"></td> <td><input readOnly type="number" class="eachQty" /></td>');
                para.setAttribute("class", "trListSaved");
			
			 
            });
                    
            
             $(document).unbind('keyUp').on('keyup', "#orderValue", function(){
                 var x =  parseInt($(this).val(), 10);               
                 var y = parseInt( $(this).closest('tr').find('.currQty').val(), 10);
                 
                 console.log("ENTERED "+ x);
                 console.log("CURRENT QTY "+ y);
                 console.log("LALALLALALLLA")
                if(x<=y){
                     var currEnter =  $(this).val();
                     var rp = $(this).closest('tr').find('.retailPrice').val();
                     console.log("Current ENTERED IF " + currEnter);
                    
                     var sumEach = rp * currEnter;
                     $(this).closest('tr').find('.eachQty').val(sumEach);
                      var sumTotal = 0;
                    $('#receipt tbody tr').each(function() {
                       
                       
                        var $row = $(this);
                        var rp = parseInt($row.find('.eachQty').val(),10);
                     
                         console.log(rp);
                         sumTotal +=rp;
                     $("#total").val(sumTotal);
                            });
                    
                    
               } else{
                     alert("ERROR PLEASE ENTER EQUALS TO OR LESS THAN" + y);
               } 
                 
                     
             });
            
            
            $(document).unbind('keyUp').on('keyup', "#received", function(){
                  x =  $(this).val();
                  y = $("#total").val();
                  console.log("TOTAL" + y);
                console.log("RECEIVED"+ x);
                change=x-y;
                     console.log("change:" + change);
                      
                     $("#change").val(change);
                     
             });
		 
            
            
            
        </script>

</body>


</html>
