
<!DOCTYPE html>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
<?php

//$orderQty = $mysqli->real_escape_string($_POST['orderQty']);
//$productID = $mysqli->real_escape_string($_POST['productID']);
if (isset($_POST['submit'])){
$message=NULL;
 if (empty($_POST['productID'])){
  $productID=FALSE;
  $message.='<p>You forgot to enter the Contact Number!';
 }else
  $productID=$_POST['productID'];

 if (empty($_POST['orderQty'])){
  $orderQty=FALSE;
  $message.='<p>You forgot to enter the Email Address!';
 }else
  $orderQty=$_POST['orderQty'];


require_once('../../mysqlConnector/mysql_connect.php');
$query="INSERT INTO  productionorder (productID, orderQty) VALUES('{$productID}','{$orderQty}')";

$result=mysqli_query($dbc,$query);
echo $result;
$flag=1;


}
?>
  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Create Production Order</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Laguna Creamery Production Order
    </div>
    <div class="wrapper-md">
    
     <b>Quantity of Production
        </b> 

    <div class="table-responsive">
     
	<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

	<TABLE id="dataTable" width="350px" border="1">
		<TR>
			<TD><INPUT type="checkbox" name="chk" /></TD>
			<TD><INPUT type="text" name="orderQty" value="<?php if (isset($_POST['orderQty']) && !$flag) echo $_POST['orderQty']; ?>"/> </textarea></TD>
			<TD>
				<SELECT name="productID">
					<OPTION value=1>Milk</OPTION>
					<OPTION value=2>Yogurt</OPTION>
					<OPTION value=3>Chocolate Milk</OPTION>
					<OPTION value=4>Kesong Puti</OPTION>
					<OPTION value=5>Low Fat Milk</OPTION>
				</SELECT>
			</TD>
		</TR>
	</TABLE>

          <button type="submit" name="submit" class="btn btn-success">Submit</button> 
    </div>

                  
</div>
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
  
  



</div>



</body>
<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
</html>
