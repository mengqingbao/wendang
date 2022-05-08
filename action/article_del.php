<?php
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$id=$_GET["id"];

//if($regFlag=="true"){
session_start();
$userId=$_SESSION["userId"];
//$sessionCode=$_SESSION["authnum"];

 $sql_update = "update ask_articles set status='0' where id='".$id."' and user_id='".$userId."'";
 echo $sql_update;
$conn->query($sql_update);
echo "<script>window.location='/index.htm';</script>";


//}
?>





