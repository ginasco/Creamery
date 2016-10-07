<h1>Sales Report(YY-MM-DD)</h1>
<form method="POST">
<p> From </p> <br>
<input type="TEXT" required name="search2" />
<p> To </p> <br>
<input type="TEXT" required name="search" />
<br> <br>
    
    <p>Search by username</p>
<input type='TEXT' name='search3' />
<br> <br>

<input type="SUBMIT" name="submit" value="search"/>
<br><br>
 
</form>


<?php
session_start();
if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
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

    if(empty($search3)){
    $resultSet=$mysqli->query("SELECT *,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
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
<td width="5%"><div align="center"><b>Retail Price
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
       
	else{$resultSet=$mysqli->query("SELECT *,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
	JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='{$search3}' AND dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
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



<?php echo $output; ?>


			  <br><br>
			 <a href="admin.php"> Main Menu</a>
			 <br><br>
<a href="logout.php">Logout</a>