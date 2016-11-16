
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
    if(empty($search3)){
    $resultSet=$mysqli->query("SELECT p.sku,p.productName,s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
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

	
		}
		//if no data output 
	}else{
			
			echo"No results";
		}
    
}
       
	else{$resultSet=$mysqli->query("SELECT p.sku,p.productName,s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
	JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='$search3' and dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
														//put here the session
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
<td width="5%"><div align="center"><b>retailPrice
</div></b></td>
<td width="5%"><div align="center"><b>Total
</div></b></td>

</tr>';
	
	
	
	
	
	
	//check if there are any info gathered from db
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

	
		}
		//if no data output 
	}else{
			
			echo"No results";
		}
	
	
        }
	

}

?>



<?php

?>
<form method="POST">
  <!-- content -->
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
 
           
<!--          <div class="col-sm-8">
            <b>Date Range</b><br><input ui-jq="daterangepicker" ui-options="{
                format: 'YYYY-MM-DD',
                startDate: '2013-01-01',
                endDate: '2013-12-31'
              }" class="form-control w-md" />
          </div>
          -->
		<div class="col-sm-8">  

    <div class="container">
        <div class="hero-unit">
		
		<p> Starting Date:
         <input type="text"  name="search2" data-date-format='yyyy-mm-dd' id="from" > 
		<?php //$date=0;	$from_date = date("Y-m-d", strtotime($date)); echo $from_date; ?>
		<p> End Date </p>
			 <input type="text" name="search"  data-date-format='yyyy-mm-dd' id="to" > 
			 <?php //  $to_date= date("Y-m-d", strtotime($date));  echo $to_date;?>
			 
        </div>
    </div>
</div>
		  </div>
		  
		
		
		  <div class="col-sm-4 form-group">
				  <p>Search by username</p>
<input type='TEXT' name='search3' />
<br> <br>
					<input type="SUBMIT" name="submit" value="search"/>
							</div>	
		

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




</body>

<script>
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

</script>
<script src="../sales/js/bootstrap-datepicker.js"></script>


</html>
