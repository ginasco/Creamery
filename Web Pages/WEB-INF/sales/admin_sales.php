
<!DOCTYPE html>
<html lang="en" class="">


<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

</head>
<body>
	<div class="app app-header-fixed ">


		<!-- nav -->
		<?php include '../session/levelOfAccess.php';?>


		<?php
		if ($_SESSION['usertype']!=101){
			header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
		}
		?>


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
							<div class="wrapper-md bg-white-only b-b">
								<div class="row text-center">
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="col-sm-8" align="left">  
											<div class="container">
												<div class="hero-unit">
													<p> Starting Date: <input type="text"  name="search2" data-date-format='yyyy-mm-dd' id="from" > End Date:<input type="text" name="search"  data-date-format='yyyy-mm-dd' id="to" > </p>
												</div>
											</div>
										</div>
										<div  align="right">
											<p>Search by username: <input type="text" name="search3"><input type="submit" name="submit" value="search"></p>
										</div>
									</form>
									<div class="wrapper-md bg-white-only b-b">
										<div class="row text-center">
											<div class="col-sm-3 col-xs-6">
												<div>Total Quantity<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalQty">
											</div>
											<div class="col-sm-3 col-xs-6">
												<div>Total Amount <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalAmount">
											</div>

										</div>
									</div>
								</div>

								<b>Sales Report</b> 

								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
									<div class="table-responsive">
										<table  class="table table-striped b-t b-b">
											<thead>
												<tr>
													<th  style="width:10%">Date</th>
													<th  style="width:10%">Dealer Name</th>
													<th  style="width:10%">SKU</th>
													<th  style="width:20%">Product Name</th>
													<th  style="width:10%">Quantity</th>
													<th  style="width:10%">Unit</th>
													<th  style="width:10%">Wholesale Price</th>
													<th  style="width:10%">Total</th>
												</tr>
											</thead>

											<?php

											$output = NULL;
											if(isset($_POST['submit'])){
	//connect to db

												$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
												$search = $mysqli->real_escape_string($_POST['search']);
												$search2 = $mysqli->real_escape_string($_POST['search2']);
												$search3 = $mysqli->real_escape_string($_POST['search3']);

	//query db
//if not work use *
<<<<<<< HEAD

    if(empty($search3)){
    $resultSet=$mysqli->query("SELECT p.sku,p.productName,DATE(s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
	JOIN sales s ON sr.receiptNum=s.receiptNum WHERE dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
    
    
    echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Date
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
<td width="5%"><div align="center"><b>SKU
</div></b></td>
<td width="25%"><div align="center"><b>Product Name
</div></b></td>
<td width="5%"><div align="center"><b>quantity
</div></b></td>
<td width="5%"><div align="center"><b>quantityUnit
</div></b></td>
<td width="5%"><div align="center"><b>Wholesale Price
</div></b></td>
<td width="5%"><div align="center"><b>Total
</div></b></td>

</tr>';
  
    	if($resultSet->num_rows>0){
		while($rows=$resultSet->fetch_assoc()){

echo "<tr>
<td width=\"10%\"><div align=\"center\">".$rows['dateSR']."
</div></td>
<td width=\"10%\"><div align=\"center\">".$rows['username']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['sku']."
</div></td>
<td width=\"25%\"><div align=\"center\">".$rows['productName']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtySR']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtyUnit']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['retailPrice']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['total']."
</div></td>

</tr>";
$inHand+=$rows['qtySR'];
$totalAmount+=$rows['total'];
	
		}

												if(empty($search3)){
													$resultSet=$mysqli->query("SELECT p.sku,p.productName,DATE(s.dateSR) AS dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
														JOIN sales s ON sr.receiptNum=s.receiptNum WHERE dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
=======
													if(empty($search3)){
														$resultSet=$mysqli->query("SELECT p.sku,p.productName,DATE(s.dateSR) AS dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
															JOIN sales s ON sr.receiptNum=s.receiptNum WHERE dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");


														if($resultSet->num_rows>0){
															while($rows=$resultSet->fetch_assoc()){

																echo "</tbody><tr>
																<td >".$rows['dateSR']."</td>
																<td >".$rows['username']."</td>
																<td >".$rows['sku']."</td>
																<td >".$rows['productName']."</td>
																<td >".$rows['qtySR']."<input type=hidden class='qtySR' name='qtySR' value=".$rows["qtySR"]."></td>
																<td >".$rows['qtyUnit']."</td>
																<td >".$rows['retailPrice']."</td>
																<td >".$rows['total']."<input type=hidden class='total' name='total' value=".$rows["total"]."></td>
															</tr></tbody>";
														}
		//if no data output 
													}else{

														echo"No results";
													}
>>>>>>> 34e69b819b590765a83d6b7272368ab64c3a1fe9

												}

												else{$resultSet=$mysqli->query("SELECT p.sku,p.productName,DATE(s.dateSR) AS dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
													JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='$search3' and dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
														//put here the session

	//check if there are any info gathered from db
													if($resultSet->num_rows>0){
														while($rows=$resultSet->fetch_assoc()){

															echo "<tbody><tr>
															<td >".$rows['dateSR']."</td>
															<td >".$rows['username']."</td>
															<td >".$rows['sku']."</td>
															<td >".$rows['productName']."</td>
															<td >".$rows['qtySR']."<input type=hidden class='qtySR' name='qtySR' value=".$rows["qtySR"]."></td>
															<td >".$rows['qtyUnit']."</td>
															<td >".$rows['retailPrice']."</td>
															<td >".$rows['total']."<input type=hidden class='total' name='total' value=".$rows["total"]."></td>

														</tr></tbody>";
													}
		//if no data output 
												}else{

													echo"No results";
												}
											}
										}
										?>
										<p></p>

										<p></p>

									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- content -->

		<script type="text/javascript">
			$(function(){
				$("#to").datepicker({ dateFormat: 'yy-mm-dd' });
				$("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
					var minValue = $(this).val();
					minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
					minValue.setDate(minValue.getDate()+1);
					$("#to").datepicker( "option", "minDate", minValue );
				})
			});
		</script>

	</div>
</div>
<!-- /content -->





</div>
<script>
	var tQty = 0;
	var tAmount=0;
	$('.qtySR').each(function(){
		tQty+=parseFloat(this.value);

	});

	$('.total').each(function(){
		tAmount += parseFloat(this.value);

	});


	var x = document.getElementById("totalQty");
	x.setAttribute("value", tQty);

	var y = document.getElementById("totalAmount");
	y.setAttribute("value", tAmount);

</script>



</body>

</script>
<script src="../sales/js/bootstrap-datepicker.js"></script>


</html>
