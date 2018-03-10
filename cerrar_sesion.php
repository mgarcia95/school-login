<?php
session_start();
session_destroy();
setcookie("PHPSESSID",0,0,"/");
header('location:index.php');
?>