<?php
include "common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$regFlag=$_POST["regFlag"];
$name = $_POST["username"];
$pass = $_POST["password"];
$code = $_POST["code"];
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
//session_start();
//$sessionCode=$_SESSION["authnum"];
if($sessionCode==$code){
	$sql = "select * from users where user = '".$name."' limit 0,1";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

	if(empty($row)){
  		
		$sql_up = "insert into users (user,pass,regtime) values ('".$name."','".md5($pass)."','".time()."')";
		$conn->query($sql_up);
		echo "<script>alert('注册成功，点击确定登陆');window.location='/page-login.html';</script>";
	}else{
		echo "<script>alert('账号已被注册。');window.location='/page-reg.html';</script>";
	}
}else if($code!=""){
	echo "<script>alert('验证码错误');window.location='/page-reg.html';</script>";
}
//}
?>





