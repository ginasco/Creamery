    <html>
        <?php
    session_start();
    if ($_SESSION['usertype']!=102){
            header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
        }
    ?>
        <head>
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

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
    <div class="hidden-print">

            <table style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable" align="right">
      
            
                <div align=center><h1>HOLLY'S MILK</h1></div>

    <?php 
     //print_r($_POST);           
                require_once('mysqlConnector/mysql_connect.php');
                $query="SELECT i.productID, p.productName, p.retailPrice, i.inventoryQty, expiryDate
                        FROM perpetualinventory i JOIN products p ON i.productID = p.productID where inventoryQty>0";
                $result=mysqli_query($dbc,$query);
                
                echo "<thead>
      <tr>
        <th></th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Retail Price</th>
        <th>Quantity</th>
        <th>Expiry Date</th>
      </tr>
                </thead> <tbody>";
                while($row = $result->fetch_assoc()) {
                         echo"
                         
                                <tr>
                                    <td><button type=submit name=add  class=btn btn-info btn-lg id=add>Add</button></td>
                                    <td class=pR>".$row["productID"]."</td>
                                    <td class=pN>".$row["productName"]."</td> 
                                    <td class=rP>".$row["retailPrice"]."</td>
                                    <td class=qty>".$row["inventoryQty"]."</td>
                                    <td class=qty>".$row["expiryDate"]."</td>
                                </tr>";
                    }
                
                echo "</tbody>";
                
    ?>
            </table>

        <div id="printableArea">
         <form action="POS.php" method="post">   
            <table id="receipt" style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable2" align="left">
            
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Retail Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>         
                  </tr>
                </thead> 
                   <tbody id="tableList">    
                    
                   </tbody>
                    
            </table>
                    
                    Total: <input id="total" value="0" readonly type="number" name="total" class="totalClass"/>
                    Received: <input  value="0"  type="number" min=1 onkeypress="return event.charCode >= 48 &&   event.charCode <= 57" name="received" id="received" class="receivedClass"/>
                    Change: <input id="change" value="0"  readonly type="number" min=1 onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="change" class="changeClass"/>
              <P><input type="submit" id="confirmBtn" name="confirm" value="Confirm" onclick="print_div()"></P>
                   
            </form>
                    
        </div>

            <?php
            if (isset($_POST['confirm'])){
                $productID=$_POST['productID'];
                $qtySold=$_POST['qtySold'];
                $productName=$_POST['productName'];
                $total=$_POST['total'];
                $received=$_POST['received'];
                $change=$_POST['change'];
    /**
                
                //PDF
                require("fpdf/fpdf.php");
                $pdf=new FPDF();
                $pdf->AddPage();
                $pdf->output();
    **/
                $items = array_combine($productID,$qtySold);
                $pairs = array();
                
                require_once('mysqlConnector/mysql_connect.php');
                
                $query="insert into sales(sold) values(1)";
                $result=mysqli_query($dbc,$query);
                
                $query2="select receiptNum from sales order by dateSR DESC LIMIT 1";
                $result2=mysqli_query($dbc,$query2);
                
                while($row = $result2->fetch_assoc()) {
                        $receiptNum=$row["receiptNum"];
                    }
                $receiptNum;
                foreach($items as $key=>$value){
                        $pairs[] = '('.intval($key).','.intval($value).','."'{$_SESSION['username']}'".','."'$receiptNum'".','."'$total'".')';
                    }
                $query3= "INSERT INTO salessr (productID, qtySR, username, receiptNum, totalSold) values".implode(',',$pairs);
                $result3=mysqli_query($dbc,$query3);
                
                
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
                  header("location: POS.php");
        exit;
            }
            
            ?>
             <br><br>
                 <a href="customer.php"> Home Page</a>
                 <br><br>
    </div>

              <div class="visible-print" >

                <div style="margin-bottom: 6%;" align="center">
                <!--logo-->
                    <img src="" alt="Creamery"/><br>
                    <h3>Title</h3>
                    <p style="font-size: medium; ">Title<br></p>
                    <p>Prepared By: <?php echo $_SESSION['username']; ?> </p>
                    <p id="DateHere"></p>
                </div>
                
                <p style="margin-left: 5%;">Receipt <?php 
                 $query2="select receiptNum from sales order by dateSR DESC LIMIT 1";
                $result2=mysqli_query($dbc,$query2);
                
                while($row = $result2->fetch_assoc()) {
                        $receiptNum=$row["receiptNum"];
                    }
                $receiptNum;
                echo $receiptNum;?></p>

                <div id="printTable" style="width: 90%; margin-left: auto; margin-right: auto;">

                </div>
            </div>

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
                 $(".trList").append('<td><input name="productID[]" id="productID" type="text" readOnly value="'+pR+'" /></td>');
                 $(".trList").append('<td><input name="productName" id="productName" type="text" readOnly value="'+pN+'"/></td>');
                 $(".trList").append('<td><input type="hidden" class="currQty" value="'+qty+'"/> <input name="retailPrice" class="retailPrice" type="number" readOnly value="'+rP+'"/></td>');
                 $(".trList").append('<td>  <input type="number" class="num" id="orderValue" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="qtySold[]"></td> <td><input readOnly type="number" class="eachQty" /></td>');
                    para.setAttribute("class", "trListSaved");
                });
                        
                
                 $(document).unbind('keyUp').on('keyup', "#orderValue", function(){
                     var x =  parseInt($(this).val(), 10);               
                     var y = parseInt( $(this).closest('tr').find('.currQty').val(), 10);
                    
                      $(this).attr("value", x);
                      
                    
                    if(x<=y){
                         var currEnter =  $(this).val();
                         var rp = $(this).closest('tr').find('.retailPrice').val();
                         console.log("Current ENTERED IF " + currEnter);
                        
                         var sumEach = rp * currEnter;
                        $(this).closest('tr').find('.eachQty').attr("value", sumEach);

                         $(this).closest('tr').find('.eachQty').val(sumEach);
                          var sumTotal = 0;
                        $('#receipt tbody tr').each(function() {
                           
                           
                            var $row = $(this);
                            var rp = parseInt($row.find('.eachQty').val(),10);
                         
                             console.log(rp);
                             sumTotal +=rp;
                         $("#total").attr("value", sumTotal);
                                });
                        
                        
                   } else{
                         alert("ERROR PLEASE ENTER EQUALS TO OR LESS THAN" + y);
                   } 
                     
                         
                 });
                
                
                $(document).unbind('keyUp').on('keyup', "#received", function(){
                      x =  $(this).val();
                     $(this).attr("value", x);

                      y = $("#total").val();
                      change=x-y;
                         console.log("change:" + change);
                         $("#change").attr("value", change);
                 }); 
                
                //Printing - Receipt
                  function print_div() {
                    //change table layout

                    var m_names = new Array("January", "February", "March",
                            "April", "May", "June", "July", "August", "September",
                            "October", "November", "December");
                    var d = new Date();
                    var curr_date = d.getDate();
                    var curr_month = d.getMonth();
                    var curr_year = d.getFullYear();
                    var today = m_names[curr_month] + " " + curr_date
                            + ", " + curr_year;
                    
                    $("#DateHere").html(today);
                    jQuery('#printTable').html(jQuery("#printableArea").html());
                    window.print();
                    document.body.onfocus = doneyet();
                }
                
            </script>
            </body>
        </html>