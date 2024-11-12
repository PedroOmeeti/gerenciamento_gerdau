<?php 
  session_destroy();
  unset($_COOKIE['token']);  
  unset($_COOKIE['nome_usuario']);
  unset($_COOKIE['email']);
  unset($_COOKIE['chapa']);
  header("location: index.php");

?>