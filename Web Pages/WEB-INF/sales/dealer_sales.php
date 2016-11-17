
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
<?php include '../session/levelOfAccess.php';
	$totalAmount= 0;
	$inHand=0;
	$totalAmount1= 0;
	$inHand1=0;
	$outputAm=0;
	$outputHand=0;
	
	;?>
<?php
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
    } 

if(isset($_POST['submit'])){
	//connect to db

	$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
	$search = $mysqli->real_escape_string($_POST['search']);
	$search2 = $mysqli->real_escape_string($_POST['search2']);
	$search3 = $mysqli->real_escape_string($_POST['search3']);
	//query db
 if($search3==0){
  
    $resultSet=$mysqli->query("SELECT p.sku,p.productName,s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
    JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='{$_SESSION['username']}' and dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");

														//put here the session
									
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Date
</div></b></td>
<td width="5%"><div align="center"><b>SKU
</div></b></td>
<td width="25%"><div align="center"><b>Product Name
</div></b></td>
<td width="5%"><div align="center"><b>quantity
</div></b></td>
<td width="5%"><div align="center"><b>Retail Price
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
<td width=\"5%\"><div align=\"center\">".$rows['sku']."
</div></td>
<td width=\"25%\"><div align=\"center\">".$rows['productName']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtySR']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['retailPrice']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['total']."
</div></td>

</tr>";
$inHand+=$rows['qtySR'];
$totalAmount+=$rows['total'];
	
	
		}
		//if no data output 
	}else{
			
			echo"No results";
		}
	
	
        }
		
		 else if($search3!=0){
  
    $resultSet=$mysqli->query("SELECT p.sku,p.productName,s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
    JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='{$_SESSION['username']}' and sr.productID='$search3' and dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");

														//put here the session
									
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Date
</div></b></td>
<td width="5%"><div align="center"><b>SKU
</div></b></td>
<td width="25%"><div align="center"><b>Product Name
</div></b></td>
<td width="5%"><div align="center"><b>quantity
</div></b></td>
<td width="5%"><div align="center"><b>Retail Price
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
<td width=\"5%\"><div align=\"center\">".$rows['sku']."
</div></td>
<td width=\"25%\"><div align=\"center\">".$rows['productName']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['qtySR']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['retailPrice']."
</div></td>
<td width=\"5%\"><div align=\"center\">".$rows['total']."
</div></td>

</tr>";
$inHand1+=$rows['qtySR'];
$totalAmount1+=$rows['total'];
	
		}
		//if no data output 
	}else{
			
			echo"No results";
		}
	
	
        }







}
?>






 <div class="wrapper-md bg-white-only b-b">
      <div class="row text-center">
        <div class="col-sm-3 col-xs-6">
          <div>Total Quantity<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm"><?php
		  if($inHand1==0){
	$outputHand=$inHand;
	echo $outputHand;
}
else if($inHand==0){
	$outputHand=$inHand1;
	echo $outputHand;
}
						?></div>
        </div>
        
        <div class="col-sm-3 col-xs-6">
          <div>Total Amount <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
          <div class="h2 m-b-sm"><?php
					if($totalAmount1==0){
	$outputAm=$totalAmount;
	echo $outputAm;
}
else if($totalAmount==0){
	$outputAm=$totalAmount1;
	echo $outputAm;
}
		  ?></div>
        </div>
       
      </div>
    </div>
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
		<p> End Date: </p>
			 <input type="text" name="search"  data-date-format='yyyy-mm-dd' id="to" > 
			 <?php //  $to_date= date("Y-m-d", strtotime($date));  echo $to_date;?>
			 
        </div>
    </div>
</div>
		  </div>
		  
		
		
		  <div class="col-sm-4 form-group">
							<p>Product:</p> <br>
               <select name="search3">
						<option value=0>---</option>
                        <option value=1>Milk</option>
                        <option value=2>Yogurt</option>
						<option value=3>Chocolate Milk</option>
                        <option value=4>Kesong Puti</option>
						<option value=5>Low Fat Milk</option>
                   
                       
                    </select>
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


<script src="../sales/js/bootstrap-datepicker.js"></script>


</html>
