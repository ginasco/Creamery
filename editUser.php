
<?php $userID = $_POST['change'];

session_start();

    if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
    
else{
    
    echo "WELCOME ".$_SESSION["username"]."!";
}
//print_r($_POST);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div align=center><input type=submit name=cUsertype value="Change User Type" />
       
    <input type=submit name=cPassword value="Change Password" />
         
        <input type=hidden readonly name=change value="<?php echo $userID; ?>"/>
    </div>
    


<?php

if (isset($_POST['cUsertype'])){
 $userID = $_POST['change'];
     require_once('../mysql_connect.php');
    $check="select usertype from users where userID='{$userID}'";
    $check2=mysqli_query($dbc,$check);
    while($row = $check2->fetch_assoc()) {
        if($row["usertype"]==101){
            echo "you can't change this User's usertype";
        }else{
            echo "<form action=editUser.php method=post>
                 <fieldset><legend> Change Usertype to <input type=hidden name=change value=".$userID."/></legend>
                 
                    <select name=selectType>
                        <option value=102>102</option>
                        <option value=103>103</option>
                    </select>
                    <div align=center><input type=submit name=changeUT value=change /></div>
                 </fieldset>
                    </form>";
        }
    }
    
    
    
}if(isset($_POST['changeUT'])){
    $userID = $_POST['change'];
    $usertype=$_POST['selectType'];
    
    
    $query="update users set usertype = '{$usertype}' where userID= '{$userID}'";
    $result=mysqli_query($dbc,$query);
    echo "Succes!";
   
    }
    
if(isset($_POST['cPassword'])){
    $userID = $_POST['change'];
    
    echo "<form action=editUser.php method=post>
    <fieldset><legend> Change Password to <input type=hidden name=change value=".$userID."/></legend>
        New Password: <input type=password required name=nPassword><br>
        Re-enter new Password <input type=password required name=renPassword>
        <div align=center><input type=submit name=changeP value=change /></div>
    </fieldset>
    </form>";
}

if(isset($_POST['changeP'])){
    $userID = $_POST['change'];
    $nPassword =$_POST['nPassword'];
    $renPassword =$_POST['renPassword'];
    
    if($nPassword == $renPassword){
        require_once('../mysql_connect.php');
        $query1="update users set password=PASSWORD('$nPassword') where userID='{$userID}'";
        $result=mysqli_query($dbc,$query1);
        echo "success";
    }else{
        echo "DOES NOT MATCH";
    }    
}
    

?>




<p>
    
    <div align=center><a href="admin.php"> Main Menu </a></div>
    
        
