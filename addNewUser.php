<?php
session_start();
if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
    } 
    
$flag=0;
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['username'])){
  $username=FALSE;
  $message.='<p>You forgot to enter the username!';
 }else
  $username=$_POST['username'];

 if (empty($_POST['password'])){
  $password=NULL;
 }else
  $password=$_POST['password'];

 if (empty($_POST['retypepassword'])){
  $retypepassword=NULL;
 }else
  $retypepassword=$_POST['retypepassword'];


 if (empty($_POST['usertype'])){
  $usertype=NULL;
 }else
  $usertype=$_POST['usertype'];


if(!isset($message)){
if($retypepassword==$password){
require_once('mysqlConnector/mysql_connect.php');
$query="Insert into USERS (username,password,usertype) values ('{$username}',PASSWORD('$password'),'{$usertype}')";
$result=mysqli_query($dbc,$query);
$flag=1;
    echo "success!";
}
else{
	echo "password do not match! retype password!";
	
}
}
 

}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add New User: </legend>

<p>username: <input type="text" required name="username" size="20" maxlength="30" value="<?php if (isset($_POST['username']) && !$flag) echo $_POST['username']; ?>"/>
<p>password: <input type="password"  required name="password" size="20" maxlength="30" value="<?php if (isset($_POST['password']) && !$flag) echo $_POST['password']; ?>"/>
<p>re-type password: <input type="password" required name="retypepassword" size="20" maxlength="30" value="<?php if (isset($_POST['retypepassword']) && !$flag) echo $_POST['retypepassword']; ?>"/>

<br><br>

               
		<p>Usertype:</p> <br>
               <select name="usertype">
						
                        <option value=101>101</option>
                        <option value=102>102</option>
                        <option value=103>103</option>
                    </select>
           <br><br>
               
 
			  <br><br>
			 <a href="admin.php"> Main Menu</a>
			 <br><br>
    <a href="logout.php">Logout</a>
	
<div align="center"><input type="submit" name="submit" value="Add!" /></div>
</fieldset>
</form>
<p>


