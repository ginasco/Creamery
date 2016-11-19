<!DOCTYPE html>
<html lang="en" class="">
<head>
<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<script src="js/jquery.min.js"></script>
<!-- star rating  -->
    
    

   
<script src="../../imports/libs/jquery/js/jquery.min.js"></script>
    <script src="../js/star-rating.js" type="text/javascript"></script>
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
            echo "<tr>
                    <td class=fullName>".$fullname."</td>
					<td class=rating><input id=star1 value=".$row["rating"]." type=number class=rating min=0 max=5 step=0.5 data-size=sm>
    <hr></td>
 
                    </tr>";
        }
       
        ?>
      </tbody>
    </table>
	<button type="submit" id="update"name="submit" class="btn btn-lg btn-info">UPDATE</button>		
	</form>
	<?php
	 if (isset($_POST['submit'])){
            $userID= $_POST['userID'];
            $rating=$_POST['rating'];
         
            
            $updateDealer="Update usersinfo
                           set rating='{$rating}'
                           where userID='{$userID}'";
            $result=mysqli_query($dbc,$updateDealer);
             header("location:dealerlist.php"); 
            exit;
        }
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

<!--
        <script>
           $(document).on('click', "#openModal", function(){
             $(".modal-body").empty();
            $("#myModal").modal("show");
            
            var fullName =  $(this).closest ('tr').find(".fullName").text();
            var contactNumber =  $(this).closest ('tr').find(".contactNumber").text();
            var status =  $(this).closest ('tr').find(".status").text();
            var emailAddress =  $(this).closest ('tr').find(".emailAddress").text();
            var cities =  $(this).closest ('tr').find(".cities").text();
            var userID =  $(this).closest ('tr').find(".userID").text();
            var address =  $(this).closest ('tr').find(".address").text();
            var tinNumber =  $(this).closest ('tr').find(".tinNumber").text();

             $(".modal-body").append('<input name="fullName" id="fullName" type="text" style=border:none;font-weight:bold;font-size:16px readOnly value="'+fullName+'"/><br>');
             $(".modal-body").append('Tin Number: <input name="tinNumber" required type="text" required value="'+tinNumber+'"/><br>');
             $(".modal-body").append('Contact Number: <input name="contactNumber" required type="text" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'+contactNumber+'"/><br>');
             $(".modal-body").append('Email Address: <input name="emailAddress" required type="text" value="'+emailAddress+'"/><input name="userID" required type="text" style=display:none value="'+userID+'"/><br>');
             $(".modal-body").append('Address: <input name="address" required type="text" required value="'+address+'"/><br>');
             
            
            if(cities===cities){
              $(".modal-body").append('City:  <select name="philCity" required id="philCity"> <option value="'+cities+'">'+cities+'</option><option value="Caloocan">Caloocan</option><option value="Las Piñas">Las Piñas</option><option value="Makati">Makati</option><option value="Malabon">Malabon</option><option value="Mandaluyong">Mandaluyong</option><option value="Manila">Manila</option><option value="Marikina">Marikina</option><option value="Muntinlupa">Muntinlupa</option><option value="Navotas">Navotas</option><option value="Paranaque">Paranaque</option><option value="Pasay">Pasay</option><option value="Pasig">Pasig</option><option value="Quezon City">Quezon City</option><option value="San Juan">San Juan</option><option value="Taguig">Taguig</option><option value="Valenzuela">Valenzuela</option></select><br>');
            }

            if(status==="102"){
              $(".modal-body").append('Status:  <select name="userStatus" required id="userStatus"> <option value="'+status+'">'+status+'-Active</option> <option value=103>103-Inactive</option></select><br>');
            }else if (status==="103"){
              $(".modal-body").append('Status:  <select name="userStatus" required id="userStatus"> <option value="'+status+'">'+status+'-Inactive</option> <option value=102>102-Active</option></select><br>');
            }              
});
        </script>
-->
<script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled: !$('#rating-input').attr('disabled')
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>

<script>
$('#input-id').rating({'update': 3,
                       'showCaption':false,
                       'showClear':false
                     });
</script>
 
    <script src="../accounts/js/star-rating.js" type="text/javascript"></script>

</body>
</html>
