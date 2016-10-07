<?php
session_start();

    if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
    
else{
    
    echo "WELCOME ".$_SESSION["username"]."!";
}
?>
<html>  
<head>
 <link rel="stylesheet" href="Library/bootstrap.min.css">
         <link rel="stylesheet" href="Library/jquery.dataTables.min.css">
        <script src="Library/jquery.min.js"></script>
  <script src="Library/bootstrap.min.js"></script>
         <script src="Library/jquery.dataTables.min.js"></script>
    
</head>

<style>
        
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 60%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
    <body>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
    <fieldset><legend> Receiving </legend>
        <p>Delivery Receipt Number : </p>
        <select name="sel_name">
            <?php
                require_once('../mysql_connect.php');
                $query="
                    SELECT distinct d.drNumber
                    FROM delivery d 
                    WHERE distributorName='{$_SESSION['username']}' and NOT exists
                    (SELECT distinct * FROM received r
                    WHERE r.drNumber = d.drNumber );";
                $result=mysqli_query($dbc,$query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["drNumber"].">".$row["drNumber"]."</option>";
                }
            ?>
</select>
         <br><div align="center"><input type="submit" name="submit" value="Search" /></div>
        </fieldset>
</form>
        
        

    
<?php
        // output what was listed in that drNumber
    if(isset($_POST['submit'])){
        echo "<table style=text-align: left; width: 791px; border=1 cellpadding=2 cellspacing=2 id=dataTable align=center>
  <thead>
  <tr>
    <th>SKU</th>
    <th>Product Name</th>
    <th>Retail Price</th>
    <th>Quantity Delivered</th>
    <th>Unit</th>
    <th>Expiry Date</th>
  </tr>
   </thead>";
        require_once('../mysql_connect.php');
        $drNumber=$_POST['sel_name'];
        $query2=" select drNumber, p.productID, p.productName, p.sku, p.qtyUnit, p.retailPrice, d.quantityDR, d.expiryDate from delivery d join products p on d.productID= p.productID where d.drNumber='{$drNumber}' order by p.sku";
        $result=mysqli_query($dbc,$query2);
        echo "<form action=searchDeliveryReceive.php method=post>";
        while($row = $result->fetch_assoc()) {
            echo"
   <tbody>
  <tr>
    <td>".$row["sku"]."</td>
    <td>".$row["productName"]."<input type=hidden name='drNumber' value=".$row["drNumber"]."></td> 
    <td>".$row["retailPrice"]."</td>
    <td><input type=number required onkeypress='return event.charCode >= 48 && event.charCode <= 57' min=0 name='qtyRec[]' value=".$row["quantityDR"]."></td>
    <td>".$row["qtyUnit"]." <input type=hidden name='productID[]' value=".$row["productID"]."></td>
    <td>".$row["expiryDate"]."<input type=hidden name='expiryDate' value=".$row["expiryDate"]."></td>
  </tr>
 </tbody>";
        }
        echo "   </table>";
        echo "<div align=center><input type=submit name=confirmR value=Confirm /></div>";
        echo "</form>";
    }

        
        
            if(isset($_POST['confirmR'])){
                
                 echo "<table style=text-align: left; width: 791px; border=1 cellpadding=2 cellspacing=2 id=dataTable align=center>
                      <thead>
                      <tr>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Retail Price</th>
                        <th>Quantity Received</th>
                        <th>Unit</th>
                        <th>Expiry Date</th>
                      </tr>
                       </thead>";
                
                $drNumber=$_POST['drNumber'];
                $qtyRec=$_POST['qtyRec'];
                $productID=$_POST['productID'];
                $expiryDate=$_POST['expiryDate'];
                
                $items= array_combine($productID,$qtyRec);
                $pairs = array();
                
                foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','.$drNumber.','."'{$_SESSION['username']}'".')';
                }
                //add to received table
                require_once('../mysql_connect.php');
                $query="INSERT INTO received (productID, quantityRC, drNumber, receivedBy) values".implode(',',$pairs);
                $result=mysqli_query($dbc,$query);
    
                //add to inventory
                    
                    //not yet exist inventory
                $searchNotExist="select r.productID, r.quantityRC, r.dateReceived
                                from received r 
                                where drNumber='{$drNumber}'";
                $nExist=mysqli_query($dbc,$searchNotExist);
                while($row = $nExist->fetch_assoc()) {
                    $insertIntoData="insert into perpetualinventory (productID, inventoryQty, dateInstance, username, expiryDate, active) values ('{$row["productID"]}','{$row["quantityRC"]}','{$row["dateReceived"]}','{$_SESSION['username']}','{$expiryDate}','1')";
                    $insertResult=mysqli_query($dbc,$insertIntoData);
                }
                
                
                //print what have received on that dr
                $query3="select distinct(p.sku), p.productName, p.retailPrice, r.quantityRC, p.qtyUnit, d.expiryDate  from received r join products p on r.productID=p.productID join delivery d on r.drNumber=d.drNumber where r.drNumber = '{$drNumber}'";
                $results=mysqli_query($dbc,$query3);
                while($row = $results->fetch_assoc()) {
                    echo"
                        <tbody>
                            <tr>
                                <td>".$row["sku"]."</td>
                                <td>".$row["productName"]."</td> 
                                <td>".$row["retailPrice"]."</td>
                                <td>".$row["quantityRC"]."</td>
                                <td>".$row["qtyUnit"]."</td>
                                <td>".$row["expiryDate"]."</td>
                            </tr>
                        </tbody>";
                }
                        echo "   </table>
                        received by:".$_SESSION['username'];
                        
            }
               ?> 
        
        <div align=center><p><a href="customer.php"> Main Menu</a></p>
        <p>
        <a href="logout.php"> logout</a></p></div>
        
    </body>
</html>