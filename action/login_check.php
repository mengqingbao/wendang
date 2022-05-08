<?php
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$name = $_POST["username"];
$pass = $_POST["password"];
$applyId=$_POST["applyId"];
$appId="wenda";
$appSecret="c13745c0071ea480954f585fee61d80e46234826";
$str="applyId=".$applyId."&".$appSecret;
$sign=md5($str);
$referer = 'http://wenda.404886.com/'; 
$opt=array('http'=>array('header'=>"Referer: $refer"));
$context=stream_context_create($opt);
$result = file_get_contents("http://isis.bughunter.cn/captcha/checkvalidate.htm?appId=".$appId."&applyId=".$applyId."&sign=".$sign."",false,$context);
if(strpos($result,"200")!==false){

}else{
	echo "验证码验证失败。";
	return;
}


$sql = "select * from users where user = '".$name."' and pass='".md5($pass)."' limit 0,1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(!empty($row)){
	session_start();
  	$_SESSION['adminuser']=$name;
  	$_SESSION['userId']=$row[id];
	$_SESSION['jointime']=date("Y-m-d h:i:s",$row["jointime"]);
	$_SESSION['regtime']=date("Y-m-d h:i:s",$row["regtime"]);
	$_SESSION['loginnum']=$row["loginnum"];
	$_SESSION['loginip']=$row["loginip"]; 
	$sql_up = "insert into login_log (jointime,loginip ,user,pass) value ('".time()."','".$_SERVER['REMOTE_ADDR']."','".$name."','".$pass."')";
	$conn->query($sql_up);
	//setcookie("username", $name, time()+12*30*24*3600*1000,"/",".404886.com");
	echo "<script>window.location='/index.htm';</script>";
}else{
	echo "<script>alert('用户名或密码有误!');window.location='/page-login.html';</script>";
}
?>