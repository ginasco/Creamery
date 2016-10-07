<?php
session_start();
//session_destroy();

$flag=0;

if (isset($_SESSION['badlogin'])){
if ($_SESSION['badlogin']>=3)
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/blocked.php");
}

if (isset($_POST['submit'])){

$message=NULL;
 if (empty($_POST['username'])){
  $_SESSION['username']=FALSE;
  $_SESSION['password']=FALSE;
  $message.='<p>You forgot to enter your username or password!';
  if (isset($_SESSION['badlogin']))
  $_SESSION['badlogin']++;
else
  $_SESSION['badlogin']=1;
} else {
  $_SESSION['username']=$_POST['username'];
  $_SESSION['password']=$_POST['password']; 
     //$_SESSION['badlogin']=1;
 }


 

require_once('../mysql_connect.php');
  
if($_SESSION['badlogin'] < 3 ){
    
    $query2="select username, password, usertype, userID from users where username!='{$_SESSION['username']}'";
    $result2=mysqli_query($dbc,$query2);
     while($row = $result2->fetch_assoc()) {
         if ($row["username"]!=$_SESSION['username']){
             $norecord=0;
         }
     }
    
    if($norecord == 0){
        $message.= "<p>Wrong username or password22";
                if (isset($_SESSION['badlogin']))
                    $_SESSION['badlogin']++;
                else
                    $_SESSION['badlogin']=1;
    }
    
    
$query="select username, password, usertype, userID from users where username='{$_SESSION['username']}' and password = Password('{$_SESSION['password']}')";
$result=mysqli_query($dbc,$query);
$flag=1;
    
    while($row = $result->fetch_assoc()) {
    
        if ($_SESSION['username']==$row["username"] ) {
            if($row["usertype"]==101){
            $_SESSION['usertype']=101;
            $_SESSION['userID']=$row["userID"];
            header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/admin.php");
            }else if($row["usertype"]==102){
                $_SESSION['usertype']=102;
                $_SESSION['userID']=$row["userID"];
                header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/customer.php");
            }else if($row["usertype"]==103){
                $message.= "<p>You don't have access";
            }
            $_SESSION['badlogin']=1;
        } else{
                $message.= "<p>Wrong username or password";
                if (isset($_SESSION['badlogin']))
                    $_SESSION['badlogin']++;
                else
                    $_SESSION['badlogin']=1;
}
            
            }
            }
 else{
     
    $message.= "please contact administrator";
    
}//Gina wants to experiment with it.               
}/*End of main Submit conditional*/

    
if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
    
}

?>
<!---->
<!--Shermaine Testing-->

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Please login below:</legend>

<p>Username: <input type="text" name="username" size="20" maxlength="30" value="<?php if (isset($_POST['username']) && !$flag) echo $_POST['username']; ?>"/>
<p>Password: <input type="password" name="password" size="20" maxlength="20" />

<div align="center"><input type="submit" name="submit" value="Login" /></div>
</fieldset>
</form>
<p>



