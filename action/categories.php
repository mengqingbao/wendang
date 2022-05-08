<?php
header("Content-Type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:http://wenda.404886.com');
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$pageNum=$_GET['pageNum'];
$news = array();
$sql = "select id,name from ask_categories where status='1' order by id desc limit ".($pageNum*20).",20"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 // 输出数据
    while($rows = $result->fetch_assoc()) {
		array_push($news,$rows);
	}
}
$resultList=array("newsList"=>$news);
header('Content-type: text/json');
echo json_encode($resultList,true);
$conn->close();
?>