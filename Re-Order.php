 <html lang="en">
     <?php
session_start();
if ($_SESSION['usertype']!=102){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    }
?>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <form method="post" action="Re-Order.php">
            <h1>Re-Order the following items:</h1>
            <?php
            require_once('../mysql_connect.php');

                $sql = "select p.productName,p.wholesalePrice, pi.inventoryQty, p.productID from products p join perpetualinventory pi on p.productID = pi.productID;";
                $result =mysqli_query($dbc,$sql);
                while($row = $result->fetch_assoc()){
                    if("{$row['inventoryQty']}" <= 10){
                        echo $row['productName']."<input type=number onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name='quantity[]' min=0  required value=30> <input type=hidden name='productID[]' value=".$row['productID']."><br>";
                    }
                }
                echo '<input type="submit" name="reordered" value="Re-Order"><br>';
            
            ?>
            </form>
        <?php
                if(isset($_POST['reordered'])){
                    $quantity = $_POST['quantity'];
                    $productID= $_POST['productID'];
                    
                    $remarks = "n/a";
                    
                    $items= array_combine($productID,$quantity);
                    $pairs = array();

                    foreach($items as $key=>$value){
                        $query="select wholesalePrice from products where productID='{$key}'";
                        $result =mysqli_query($dbc,$query);
                        while($row = $result->fetch_assoc()){
                            $wholesalePrice=$row['wholesalePrice']*$value;
                        }
                        $remarks = "n/a";
                        $pairs[] = '('.intval($key).','.intval($value).','."'$remarks'".','.$wholesalePrice.','."'{$_SESSION['username']}'".')';
                    }
                    
                    
                    
                    $sql = "INSERT INTO purchase (productID, purchaseQty, remarks, totalAmount, username) values".implode(',',$pairs);
                    $result = mysqli_query($dbc,$sql);
                    echo "success!";
                    
                    
                    }
                
            ?>

        
        <a href="customer.php"> Main Menu</a>
			 <br><br>
    </body>
</html>
