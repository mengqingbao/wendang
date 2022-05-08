<?php
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$id=$_POST["id"];
$title=$_POST["title"];
$summary = $_POST["summary"];
$categoryId = $_POST["category_id"];
$content = $_POST["content"];
$applyId=$_POST["applyId"];
$appId="wenda";
$appSecret="c13745c0071ea480954f585fee61d80e46234826";
$str="applyId=".$applyId."&".$appSecret;
$sign=md5($str);
$referer = 'http://wenda.404886.com/'; 
$opt=array('http'=>array('header'=>"Referer: $refer"));
$context=stream_context_create($opt);
$result = file_get_contents("http://isis.bughunter.cn/captcha/checkvalidate.htm?appId=".$appId."&applyId=".$applyId."&sign=".$sign."",false,$context);
$domain = strstr($result, '200');
if(strpos($result,"200")!==false){

}else{
	echo "验证码验证失败。";
	return;
}
//if($regFlag=="true"){
session_start();
//$sessionCode=$_SESSION["authnum"];
$userId=$_SESSION["userId"];
if($sessionCode==$code){
	$sql = "select * from ask_articles where id = '".$id."'";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

	if(empty($row)){
		$sql_insert = "insert into ask_articles (title,summary,category_id,content,user_id,status) values ('".$title."','".$summary."','".$categoryId."','".$content."','".$userId."','1')";
		echo $sql_insert;
		$conn->query($sql_insert);
	}else{
		$sql_update = "update ask_articles set title = '".$title."',summary='".$summary."',category_id='".$categoryId."',content='".$content."' where id='".$id."'";
		$conn->query($sql_update);
	}

}else if($code!=""){
	echo "<script>alert('验证码错误');window.location='/index.htm';</script>";
}
echo "<script>window.location='/index.htm';</script>";
//}
?>





