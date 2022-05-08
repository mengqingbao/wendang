<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$_SESSION['adminuser']="";
$_SESSION['name']=""; 
$_SESSION['jointime']="";
$_SESSION['regtime']="";
$_SESSION['loginnum']="";
$_SESSION['loginip']=""; 
header("Location: index.htm");
?>