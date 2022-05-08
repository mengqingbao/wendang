<?php
header("Content-Type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:http://wenda.404886.com');
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$id=$_GET['id'];
$news = array();
$sql = "update ask_categories set status='0' where id='".$id."'"; 
echo $sql;
$result = $conn->query($sql);
$conn->close();
echo "<script>window.location='/category';</script>";
?>