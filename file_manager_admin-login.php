<?php require_once('file_manager_admin-inc-main.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if ((@$_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = "file_manager_admin.php?dir=$fileFolder";
}


if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "type";
  $MM_redirectLoginSuccess = "file_manager_admin.php?dir=$fileFolder";
  $MM_redirectLoginFailed = "file_manager_admin-login.php?login=failed";
  $MM_redirecttoReferrer = true;
   
  if ($loginUsername == $AdminUserName && $password==$AdminPassWord) {
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginUsername;	      


    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Easy File Explorer</title>
<link rel="shortcut icon" href="icon.png" type="image/png" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>

  <body>

    
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
      <div class="middle-box text-center animated fadeInDown">
  <h2>File Manager Admin</h2>
  <span>Login</span>
</div>
<!-- Form Module-->
      <div class="middle-box text-center animated fadeInDown">
  
  <div class="form">
    <h2><i class="fa fa-lock fa-5x"></i></h2>
    <form id="formElem" name="formElem" action="<?php echo $loginFormAction; ?>" method="POST" onSubmit="document.getElementById('registerButton').value='Please Wait...'; document.getElementById('registerButton').disabled=true;">
    <label>Username</label>
      <input name="username" type="text" id="username" placeholder="Username" value="administrator" class=" form-control" />
     <label>Password</label>
     <input name="password" type="password" id="password" placeholder="Password" value="admin"  class=" form-control"/>
     <label>&nbsp;</label>
      <button id="registerButton"  class=" form-control btn-primary">Login</button>
    </form>
  </div>
  
  
</div>

    
    
    
  </body>
</html>
