
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

</head>
<body>
  <div class="app app-header-fixed ">


   <!-- nav -->
   <?php include '../session/levelOfAccess.php';
   $conNum=$_POST['conNum'];
   ?>
   
   <!-- / nav -->

   <?php
   if ($_SESSION['usertype']!=101){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
  }
  ?>


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">

      <form>
        <div class="bg-light lter b-b wrapper-md hidden-print">
          <a href class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
          <h1 class="m-n font-thin h3"> Spoilage Products /# <input type=text style="border:none;background:none" readonly name="conNum" value="<?php echo $conNum; ?>"/></h1>
        </div>
      </form>

      <div class="wrapper-md">
        <?php 
        $conNum=$_POST['conNum'];
        require_once('../../mysqlConnector/mysql_connect.php');

        echo"
        <p class=m-t m-b>Dealer: <strong>1 November 2016</strong><br>
         Address: <strong>1 November 2016</strong><br>
         Pullout Date: <strong>1 November 2016</strong><br>
         Control Number: <strong>PB-1000</strong><br>
       </p>";
       ?>
       <div>
        <div class="well m-t bg-light lt">
          <div class="row">


          </div>
        </div>
        <div class="line"></div>
        <table class="table table-striped bg-white b-a">
          <thead>
            <tr>
              <th style="width: 60px">QTY</th>
              <th style="width: 70px">SKU</th>
              <th style="width:400px">DESCRIPTION</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>51</td>
              <TD>CHMK500</TD>
              <td>500ml Chocolate Milk</td>

            </tr>
            <tr>
              <td>5</td>
              <TD>QSPT200</TD>
              <td>500G Quesong Puti</td>


            </tr>

          </tbody>
        </table> 

        <button class="btn m-b-xs w-xs btn-danger">Cancel P.B</button>
      </div>
    </div>


  </div>
</div>
<!-- /content -->





</div>



</body>
</html>
