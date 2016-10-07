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
         <script src="Library/jquery.min.js"></script>
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
        
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <fieldset><legend> Update User Information </legend>
       <p>
           User ID : <input type=number name="userID" size="20" min=0 onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="30" value="<?php if (isset($_POST['userID']) && !$flag) echo $_POST['userID']; ?>"/>
       </p>
       <div align="center"><input type="submit" name="submit" value="search user" /> 
           <input type="submit" name="all" value="show all"/>
           
       </div>
    </fieldset>
</form>
        
        
        <form id="form" action="editUser.php"  method="Post">
            <input type="hidden" id="change" name="change" />
            <?php  ?>
        </form>

        <table style="text-align: left; width: 791px;" border="1" cellpadding="2" cellspacing="2" id="dataTable" align="center">
            <tbody>

<?php

$flag=0;
if (isset($_POST['submit'])){
    $message=NULL;
    
    if (empty($_POST['userID'])){
        $userID=FALSE;
        $message.='<p>You forgot to enter the user ID!';
    }else{
        $userID=$_POST['userID'];
    }
    
    if(!isset($message)){
         echo "<thead><tr>
              <th>User ID</th>
              <th>Username</th>
              <th>user Type</th>
              <th></th>
              </tr></thead>";
        
        require_once('mysqlConnector/mysql_connect.php');
        $query="select username, userID, usertype from users where userID={$userID}";
        $result=mysqli_query($dbc,$query);
        $flag=1;
        
         while($row = $result->fetch_assoc()){
             if($row["usertype"]==101){
            echo "you don't have access.";
        } else if($row["userID"] == $userID){
                 $_SESSION['changeUsertypeID'] = $userID;
                 
                  echo "<tr>
                <td><input type=text readOnly value=".$row["userID"]." class=userID></td>
                <td>".$row["username"]."</td> 
                <td>".$row["usertype"]."</td>
                <td><input type=button name=edit id=happy value=edit /></td>
                </tr>";
                
             }
         }
    }
}

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

if (isset($_POST['all'])){
    echo "<thead><tr>
              <th>User ID</th>
              <th>Username</th>
              <th>user Type</th>
              <th></th>
              </tr></thead>";
    require_once('mysqlConnector/mysql_connect.php');
    $query1="select * from users where usertype!=101";
    $result=mysqli_query($dbc,$query1);
    while($row = $result->fetch_assoc()){ 
       
        
        echo "<tr>
                <td><input type=text readOnly value=".$row["userID"]." class=userID></td>
                <td>".$row["username"]."</td> 
                <td>".$row["usertype"]."</td>
                <td><input type=button name=edit id=happy value=edit /></td>
                </tr>";
                

    }
}


?>
            
            </tbody>
            </table>
        
        <script>
            $(document).on('click', '#happy', function(e){
              e.preventDefault();
         var userID =  $(this).closest ('tr').find(".userID").val();
         document.getElementById('change').setAttribute('value',userID);
         $("#form").submit();
                
      });
        </script>
 <div align="center">
<p>
        <a href="admin.php"> Main Menu</a></p></div>
        </body>
    </html>