<?php
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$id=$_GET["id"];
$name=$_GET["name"];
session_start();
$userId=$_SESSION["userId"];
if($userId!=''){
}else{
echo "failed";
return;
}
if($id==0){
	$sql_insert = "insert into ask_categories (name,status) values ('".$name."','1')";
	echo $sql_insert;
	$conn->query($sql_insert);
}else{
	$sql_update = "update ask_categories set name = '".$name."' where id='".$id."'";
	$conn->query($sql_update);
}
echo "success";
?>