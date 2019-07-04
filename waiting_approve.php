<?
  $user=$_GET['username'];
  $pass=$_GET['pass'];
  echo password_hash($pass, PASSWORD_DEFAULT);

?>
