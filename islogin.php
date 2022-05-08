<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
if($_SESSION['adminuser']==""){
	echo "<script>alert('请登陆!');parent.parent.location.href='login.php';</script>";
}
?>