<?php
session_start();
$_SESSION['logged']="0";
$_SESSION['id']="0";
header("Location: login.php");
?>