<?php

header("Content-type:text/html;charset=utf-8");

//php生成百度站点地图sitemap.xml

//http://www.baidu.com/search/sitemaptools_help.html

include "action/common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

//echo date("Y-m-d");

//查询并获取数据  and a.create_time>='".date("Y-m-d")." 00:00:00'
$news = array();
$sql="";

$sql = "select a.id,a.title,a.created_at from ask_articles a  where status='1'  order by a.id desc limit 0,5000";
//echo $sql;
$data_array=array();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 // 输出数据
	 $m=0;
    while($rows = $result->fetch_assoc()) {
		$data_array[$m]['loc']="http://wenda.404886.com/article-".$rows['id'];

		$data_array[$m]['lastmod']=$rows['created_at'];

		$data_array[$m]['changefreq']='daily';

		$data_array[$m]['priority']='0.8';
		
		$m++;
	}
	//$resultList=array("newsList"=>$data_array);
	echo json_encode($data_array,true);
	
}
 
function makeXML($array){
   $content='<?xml version="1.0" encoding="UTF-8"?>
   <urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
   ';
  
  for($i=0;$i<count($array);$i++){
    //echo "///".$array[$i]['loc'] ; 
    $content.=create_item($array[$i]);
   }
   $content.='</urlset>';
   $fp=fopen('sitemap.xml','w+');
   fwrite($fp,$content);
   fclose($fp);
   echo "生成总条数：".count($array);
 }

function create_item($data){
	echo $data['loc'];
    $item="<url>\n";
    $item.="<loc>".$data['loc']."</loc>\n";
    $item.="<priority>".$data['priority']."</priority>\n";
    $item.="<lastmod>".$data['lastmod']."</lastmod>\n";
    $item.="<changefreq>".$data['changefreq']."</changefreq>\n";
    $item.="</url>\n";
    return $item;
 }
 makeXML($data_array);
?>