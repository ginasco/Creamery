<!DOCTYPE html>

<html lang="en" class="">
<head>
<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


<!-- star rating  -->
    
      <script src="../../imports/libs/jquery/js/jquery.min.js"></script>

    <link rel="stylesheet" href="../accounts/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
  
  
   

   
<!--  star rating-->
</head>
<body>
<div class="app app-header-fixed ">


<!-- nav -->
<?php include '../session/levelOfAccess.php';?>
<!-- / nav -->

<?php
if ($_SESSION['usertype']!=101){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
?>

<!-- content -->


<div id="content" class="app-content" role="main">
	<div class="app-content-body ">
    

<div class="bg-light lter b-b wrapper-md">
<h1 class="m-n font-thin h3">Dealer List</h1>
</div>
<div class="wrapper-md">
<div class="panel panel-default">
  <div class="panel-heading">
    Dealers
  </div>
  <div class="table-responsive">
  <form>
    <table ui-jq="dataTable" ui-options="{
        sAjaxSource: 'api/datatable.json',
        aoColumns: [
          { mData: 'engine' },
          { mData: 'browser' },
          { mData: 'platform' },
          { mData: 'version' },
          { mData: 'grade' }
        ]
      }" class="table table-striped b-t b-b">
      <thead>
        <tr>
          <th  style="width:25%">Dealer Name</th>
          <th  style="width:25%">Rating</th>
         
        </tr>
      </thead>
      <tbody>
	  
        <?php
          require_once('../../mysqlConnector/mysql_connect.php');
          $query1="SELECT ui.userID,ui.fName,ui.lName,ui.rating FROM USERSINFO ui WHERE ui.rating <=5;";
          $result=mysqli_query($dbc,$query1);
          while($row = $result->fetch_assoc()){ 
        
        
			$fullname = $row["fName"] .' '.$row["lName"];
			$userID = $row["userID"];
			$rating = $row["rating"];
			
            echo "<tr>
                    <td class=fullName>".$fullname." <input type= text name=userid[] value=".$row["userID"]." style=display:none></td>
				<td class=rating><input id=rating value=".$row["rating"]." type=number class=rating min=0 max=5 step=0.2 data-size=sm>
    <hr></td>
									
 
                    </tr>"
					;
			
			
        }
       
        ?>
      </tbody>
    </table>
	<button type="submit" id="update" name="submit" class="btn btn-lg btn-info">UPDATE</button>		
	</form>
<!--	<input id=rating value=".$row["rating"]." type=number class=rating min=0 max=5 step=0.2 data-size=sm>-->
	  
	<?php
	// if (isset($_POST['submit'])){
        //    $userID= $_POST['userID'];
        //    $rating=$_POST['rating'];
         
 
		//	echo $userID;
		//	echo $rating;
				
				//require_once('../mysql_connect.php');
        //   $query3= "INSERT INTO purchase (productID, purchaseQty, username, totalAmount, remarks) values".implode(',',$pairs);
          //  $result3=mysqli_query($dbc,$query3);
			//$query="UPDATE USERSINFO SET rating('".implode($rating,"','")."') WHERE userID IN ('".implode($userID,"','")."')";
			
		//  echo $userID;
		 // echo $rating;
		  
             //header("location:dealerlist.php"); 
            //exit;
       // }
		?>
  </div>
</div>
</div>



</div>
</div>

<!-- modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dealer's Info</h4>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">

            
            <!--PRINT INFO-->
            <input type="text" value="text">
        </div>
                          
        <div class="modal-footer">
            <input type="submit" class="btn btn-sm btn-primary" name="submit" value="Save" id="submit" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      </div>
   
        </div>
        <!-- /modal -->
<!-- /content -->

                 <form>

</div>
<script>
    jQuery(document).ready(function () {
        $("#rating").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
        
            hoverOnClear: false
        });
   
        $('#rating').rating('update',3);
        
        
     
    });
</script>



</body>
</html>
