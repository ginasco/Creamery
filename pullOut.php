<html>

<?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
?>
    <head>
    </head>
<style>
   table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
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
          <!--Shermaine trial-->
         <table style=text-align: left; width: 791px; border=1 cellpadding=2 cellspacing=2 id=dataTable align=center>
                <div align=center><h1>EXPIRED PRODUCTS</h1></div>
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            
            $time = date("Y/m/d");
            $date = strtotime($time);
            
            require_once('../mysql_connect.php');
            $query="SELECT i.expiryDate, i.productID, i.inventoryQty, p.productName from perpetualinventory i join products p
                    on i.productID=p.productID where i.active!=0";
            $result=mysqli_query($dbc,$query);
            while($row = $result->fetch_assoc()) {
                $expiryDate=strtotime($row["expiryDate"]);
                if($date>=$expiryDate){
                    
                        echo "<tbody><tr>
                                <td>".$row["productID"]."<input type=hidden name='productID[]' value=".$row["productID"]."></td>
                                <td>".$row["productName"]."<input type=hidden name='expiryDate[]' value=".$row["expiryDate"]."></td> 
                                <td>".$row["inventoryQty"]."<input type=hidden name='inventoryQty[]' value=".$row["inventoryQty"]."></td>
                            </tr></tbody>";
                    }
                }

            ?>
                Pull Out BY: <input type="text" required name="pullOutName">
                <p></p>
            
            <p></p>
            <p><div align=center><input type="submit" name="confirm" value="confirm"></div>
        </form>
        
        <?php
            if (isset($_POST['confirm'])){
                require_once('../mysql_connect.php');
                $productID=$_POST['productID'];
                $inventoryQty=$_POST['inventoryQty'];
                $pullOutName=$_POST['pullOutName'];
                $expiryDate=$_POST['expiryDate'];
                
                $query="insert into pullouts (distributorName, pullOutBy) values ('{$_SESSION['username']}','{$pullOutName}')";
                $result=mysqli_query($dbc,$query);
                
                $query2="select controlNum from pullouts order by controlNum DESC LIMIT 1";
                $result2=mysqli_query($dbc,$query2);
                while($row=$result2->fetch_assoc()) {
                    $controlNum=$row["controlNum"];
                }
                $controlNum;
                
                $items = array_combine($productID,$inventoryQty);
                $pairs = array();
                
                $remarks="n/a";
                
                foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','."'$controlNum'".','."'$remarks'".')';
                }
                
                $query3= "INSERT INTO pullouts2 (productID, pullOutQty, controlNum, remarks) values".implode(',',$pairs);
                $result3=mysqli_query($dbc,$query3);
                
                $query4= "DELETE FROM perpetualinventory WHERE productID IN ('".implode($productID,"', '")."') AND expiryDate IN ('".implode($expiryDate,"', '")."')";
                $result4=mysqli_query($dbc,$query4);
                
                echo "success!";

                $query5= "select pu.productID, p.productName, pu.pullOutQty from pullOuts2 pu join products p on pu.productID=p.productID where pu.controlNum='{$controlNum}'";
                $result5=mysqli_query($dbc,$query5);
                while($row=$result2->fetch_assoc()) {
                    echo "<tbody><tr>
                                <td>".$row["productID"]."</td>
                                <td>".$row["productName"]."</td> 
                                <td>".$row["pullOutQty"]."</td>
                            </tr></tbody>";
                }
                
            }
        
        
        ?>
        </table>
        <br><br>
			 <a href="customer.php"> Main Menu</a>
			 <br><br>
        
    </body>
</html>








