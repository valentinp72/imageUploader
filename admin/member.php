<?php session_start();

if(!isset($_SESSION['login']) or !isset($_SESSION['password'])){
  header('location: auth.php');
}

?>
