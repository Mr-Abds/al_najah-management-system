<?php

session_start();
// $_SESSION['user']="";
session_unset();
session_destroy();
$_COOKIE['PHPSESSID']='';
header("location:login.php");

?>