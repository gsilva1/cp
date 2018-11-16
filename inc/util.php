<?php
// define('DB_HOST', 'br386.hostgator.com.br');
// define('DB_USER', 'instit12');
// define('DB_PASSWORD', 'CjR*$t8h90');
// define('DB_DATABASE', 'instit12_wp462');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'instit12_wp462');
define('USER_TIMEOUT', 10);
error_reporting(E_ALL);

function alertThat($msg){
  echo "<script>alert('".$msg."')</script>";
}
function scriptThat($script){
  echo "<script>".$script."</script>";
}
function checkCredentials($user, $password){
  if(strlen($user) == 0 || strlen($password) == 0){
    return false;
  }
  if(preg_match('/\*\'\"  /', $user)){
    return false;
  }
  return true;
}
function checkConnection(){
  session_start();
  if($_SESSION['loginTime']+USER_TIMEOUT <= time()){
    $_SESSION['user_active'] = false;
    alertThat("O tempo de conexão expirou.");
    scriptThat("location.href='index.php'");
  }
}

function allowView(){
  session_start();
  if(!$_SESSION['user_active']){
    header("Location: ../index.php");
  }
}

?>
