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
		<script src="js/jquery.min.js"></script>
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
        <table style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable" align="right">
            <div align=center><h1>PURCHASE ORDER</h1></div>
        
        <?php
            
             echo "<thead>
                      <tr>
                        <th></th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Wholesale Price</th>
                      </tr>
                                </thead> <tbody>";
            
            require_once('mysqlConnector/mysql_connect.php');
            $query="select productID, productName, wholesalePrice, qtyUnit from products where productType=101";
            $result=mysqli_query($dbc,$query);
            while($row = $result->fetch_assoc()) {
                echo"
                            <tr>
                                <td><button type=submit name=add  class=btn btn-info btn-lg id=add>Add</button></td>
                                <td class=pR>".$row["productID"]."</td>
                                <td class=pN>".$row["productName"]."</td> 
                                <td class=wP>".$row["wholesalePrice"]."</td>
                            </tr>";
                }
            
            echo "</tbody>";
            
            ?>
        </table>
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">   
        <table id="receipt" style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable2" align="left">
        
            <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Wholesale Price</th>
                    <th>Order Quantity</th>
                    <th>Subtotal</th>

                  </tr>
            </thead> 
            
               <tbody id="tableList">           
           
                   
               </tbody>
            <P><input type="submit" name="confirm" id="confirm"  disabled value="Confirm"></P>
         </table>
            
            Total: <input id="total" readonly type="number" name="total" class="total"/>
               </form>
        
        <?php
        if (isset($_POST['confirm'])){
            $productID=$_POST['productID'];
            $qtyOrder=$_POST['qtyOrder'];
            $total=$_POST['total'];
            
            $items = array_combine($productID,$qtyOrder);
            $pairs = array();
            
            $remarks="n/a";
            
            foreach($items as $key=>$value){
                    $pairs[] = '('.intval($key).','.intval($value).','."'{$_SESSION['username']}'".','."'$total'".','."'$remarks'".')';
                }
            
            require_once('mysqlConnector/mysql_connect.php');
            $query3= "INSERT INTO purchase (productID, purchaseQty, username, totalAmount, remarks) values".implode(',',$pairs);
            $result3=mysqli_query($dbc,$query3);
        }
        
        ?>
        
        
        
        <script>
        $(document).on('click', "#add", function(){
            $(this).prop('disabled', true);  
        $('#confirm').prop('disabled', false);   
            var pR =  $(this).closest('tr').find(".pR").text();
            var pN =  $(this).closest('tr').find(".pN").text();
            var wP =  $(this).closest('tr').find(".wP").text();
               
               var para = document.createElement("tr");
               var element = document.getElementById("tableList");
               para.setAttribute("class", "trList");
                element.appendChild(para);
             $(".trList").append('<td><input name="productID[]" id="productID" type="text" readOnly value="'+pR+'" /></td>');
             $(".trList").append('<td><input name="productName" id="productName" type="text" readOnly value="'+pN+'"/></td>');
             $(".trList").append('<td><input name="wholesalePrice" id="wholesalePrice" class="wholesalePrice" type="number" readOnly value="'+wP+'"/></td>');
             $(".trList").append('<td><input type="number" class="num" id="orderValue" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="qtyOrder[]"></td> <td><input readOnly type="number" class="eachQty" /></td>');
                para.setAttribute("class", "trListSaved");
            });
            
            $(document).unbind('keyUp').on('keyup', "#orderValue", function(){
                var y = parseInt($(this).closest('tr').find('.wholesalePrice').val(), 10);
                console.log("PRICE "+ y);
                var x =  parseInt($(this).val(), 10); 
                console.log("ENTERED "+ x);
                var wP =  $(this).closest('tr').find(".wP").text();
                console.log("PRICE "+ wP);
                
                var subtotal = x*y;
                $(this).closest('tr').find('.eachQty').val(subtotal);
                
                var sumTotal = 0;
                $('#receipt tbody tr').each(function() {
                       
                    
                        var $row = $(this);
                        var wp = parseInt($row.find(".eachQty").val(),10);
                     
                         console.log(wp);
                          sumTotal +=wp;
                     $("#total").val(sumTotal);
                            });
                
            });
        
        </script>
        
        <br><br>
			 <a href="customer.php"> Home Page</a>
			 <br><br>
    </body>
</html>
