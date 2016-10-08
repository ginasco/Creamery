<?php
    session_start();

    if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
    
else{
    
    echo "WELCOME ".$_SESSION["username"]."!";
}
    ?>

<html>
    <head>
 <link rel="stylesheet" href="css/bootstrap.min.css">
         <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
         <script src="js/jquery.dataTables.min.js"></script>
        <script>
            $( document ).ready(function() {
          $("#dataTable").DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                "language": {
                    "emptyTable": "No Data"
                }
              })
        });</script> 
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
    <table style="text-align: left; width: 791px;" border="1" cellpadding="2" cellspacing="2" id="dataTable" align="center">
  <thead>
  <tr>
    <th>SKU</th>
    <th>Product Name</th>
    <th>Product Type</th>
    <th>Wholesale Price</th> 
    <th>Retail Price</th>
    <th>Unit</th>
    <th></th>
    <th></th>
  </tr>
   </thead> <tbody>

<?php

require_once('mysqlConnector/mysql_connect.php');
$query="select * from products";
        

  if (isset($_POST['action'])){
    $action=$_POST['action'];
    if($action=="activate"){
        
    $productId = $_POST['change'];
    $addProduct="update products set productType=101  where productID='{$productId}' ";
    $result=mysqli_query($dbc,$addProduct);
     header("location: editProduct.php");
    exit;
    }else {
    $productId=$_POST['change'];
    $addProduct="update products set productType=102  where productID='{$productId}'";
    $result=mysqli_query($dbc,$addProduct);
     header("location: editProduct.php");
    exit; 
    }
      
      
      
  }   
        
if (isset($_POST['submit'])){
    $sku= $_POST['sku'];
    $productName=$_POST['productName'];
    $productType=$_POST['productType'];
    $wholesalePrice=$_POST['wholesalePrice'];
    $retailPrice=$_POST['retailPrice'];
     $qtyUnit=$_POST['qtyUnit'];
    
    $addProduct="insert into products (sku, productName, productType, wholesalePrice, retailPrice, qtyUnit) values ('{$sku}','{$productName}','{$productType}','{$wholesalePrice}','{$retailPrice}', '{$qtyUnit}')";
    $result=mysqli_query($dbc,$addProduct);
     header("location: editProduct.php");
    exit;
    
}       
    
$result=mysqli_query($dbc,$query);
   while($row = $result->fetch_assoc()) {
      
       if($row["productType"]==101 ){
           echo"
  
  <tr>
  
    <td class=sku>".$row["sku"]."</td>
    <td class=pN>".$row["productName"]."</td> 
    <td class=pT>".$row["productType"]."</td>
    <td class=wP>".$row["wholesalePrice"]."</td>
    <td class=rP>".$row["retailPrice"]."</td>
    <td class=qtyU>".$row["qtyUnit"]."</td>
 <td><input type=hidden value=".$row["productID"]." class=productID>
 <button type=button class=btn btn-info btn-lg id=openModal>Edit</button> </td>
 <td><input type=button name=invalid id=invalid value=deactivate /></td>
  </tr>
";
       }
       
       if($row["productType"]==102 ){
           echo"


  <tr>
  
    <td class=sku>".$row["sku"]."</td>
    <td class=pN>".$row["productName"]."</td> 
    <td class=pT>".$row["productType"]."</td>
    <td class=wP>".$row["wholesalePrice"]."</td>
    <td class=rP>".$row["retailPrice"]."</td>
    <td class=qtyU>".$row["qtyUnit"]."</td>
 <td> <input type=hidden value=".$row["productID"]." class=productID> 
 <button type=button class=btn btn-info btn-lg id=openModal>Edit</button> </td>
 <td><input type=button name=invalid id=activate value=activate /></td>
  </tr>
 ";
       }
       
 }

?>

</tbody>
</table>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">

            
            <!--PRINT INFO-->
            <input type="text" value="text">
        </div>
                          
        <div class="modal-footer">
            <input type="submit" name="submit" value="Save" id="submit" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      </div>
   
        </div>
        <form id="form" action="editProduct.php"  method=Post>
            <input type="hidden" id="action" name="action"   />  
           <input type="hidden" id="change" name="change" />    
        </form> 

        
        <div align="center">
        <p>
        <a href="admin.php"> Main Menu</a></p>
        <p>
        <a href="logout.php"> Logout</a></p></div>
</body>
    
    <script>
    
        
        $(document).on('click', "#openModal", function(){
             $(".modal-body").empty();
            $("#myModal").modal("show");
            
            var SKU =  $(this).closest ('tr').find(".sku").text();
            var pN =  $(this).closest ('tr').find(".pN").text();
            var pT =  $(this).closest ('tr').find(".pT").text();
            var wP =  $(this).closest ('tr').find(".wP").text();
            var rP =  $(this).closest ('tr').find(".rP").text();
            var qtyU = $(this).closest ('tr').find(".qtyU").text();

             $(".modal-body").append('SKU: <input name="sku" id="sku" type="text" readOnly value="'+SKU+'"/><br>');
             $(".modal-body").append('Product Type: <input name="productType" type="text" readOnly value="'+pT+'"/><br>');
             $(".modal-body").append('Product Name: <input name="productName" required type="text" value="'+pN+'"/><br>');
             $(".modal-body").append('Wholesale Price: <input name="wholesalePrice" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'+wP+'"/><br>');
             $(".modal-body").append('Retail Price: <input name="retailPrice" required type="number" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'+rP+'"/><br>');
            
            
            if(qtyU==="bottle"){
                 $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option> <option value="tub">tub</option><option value="pcs">pcs</option> </select><br>');
            }else if(qtyU==="tub"){
                $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option>  <option value="bottle">bottle</option><option value="pcs">pcs</option> </select><br>');
            }else if(qtyU==="pcs"){
                $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option> <option value="tub">tub</option> <option value="bottle">bottle</option></select><br>');
            }
            
              
});
        
        //INVALID
         $(document).on('click', "#invalid", function(e){
              e.preventDefault();
         var producID =  $(this).closest ('tr').find(".productID").val();
         document.getElementById('change').setAttribute('value',producID);
         document.getElementById('action').setAttribute('value', "invalid");
         $("#form").submit();
      });    
        
       // VALID
         $(document).on('click', "#activate", function(e){
              e.preventDefault();
             var producID =  $(this).closest ('tr').find(".productID").val();
              document.getElementById('change').setAttribute('value', producID);
             document.getElementById('action').setAttribute('value',"activate");  
             $("#form").submit();

      });    
        
        
    </script>
</html>