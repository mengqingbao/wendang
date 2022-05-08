<!doctype html>
<html lang="en">
<?php
$cateId = $_GET['cateId'];
?>
<head>
	<title>分享文章</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php include("header.php"); ?>
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">首页</h3>
					<?php
					 session_start();
              
              		$username=$_SESSION['adminuser'];
						 if($username!=""){
						 	
					 ?>
					<button type="button" class="btn btn-default" onclick="window.location.href='editor-0'" style="margin-right: 20px;float: right;margin-top: -55px;"><i class="fa fa-plus-square"></i> 文章分享 </button>
					<?php
						}
					 ?>
					<div class="row">
						<div class="col-md-12" id="newsList_">
							
						</div>
						
						</div>
					</div>
					
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<?php include("footer.php"); ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<script type="text/javascript">
		window.pageNum=1;
 window.currentPosition=0;
 window.scrollH=0;
 function resetGuid2Position(h,clientHeight){
    var topHight=$(".comRightGuid2").height();
   
    var maxTop=topHight-clientHeight;
    
    if(h>currentPosition){
        scrollH=h;
        if(h>maxTop){
            scrollH=maxTop;
        }
        $(".comRightGuid2").css("top",-scrollH);
    }
    if(h<currentPosition){
        var dif=currentPosition-h;
 
        scrollH=scrollH-dif;
        if(scrollH<0){
            scrollH=0;
        }
         console.log("dif"+dif+"scrollH"+scrollH);
        $(".comRightGuid2").css("top",-scrollH);
    }

    window.currentPosition=h;
 }

 
//滚动条到页面底部加载更多案例 
$(window).scroll(function(){
	
 var scrollTop = $(this).scrollTop();    //滚动条距离顶部的高度
 var scrollHeight = $(document).height();   //当前页面的总高度
 var clientHeight = $(this).height();    //当前可视的页面高度
 
 console.log(scrollTop+":crollTop/"+scrollHeight+":scrollHeight/clientHeight:"+clientHeight);
 // console.log("top:"+scrollTop+",doc:"+scrollHeight+",client:"+clientHeight);
 if(scrollTop + clientHeight+300 >= scrollHeight){   //距离顶部+当前高度 >=文档总高度 即代表滑动到底部 
    load('<?php echo $cateId;?>',pageNum);
     pageNum++;
 }else if(scrollTop<=0){
	
 }
    resetGuid2Position(scrollTop,clientHeight);
});

function load(cateId,pageNum){

	 $.ajax({
               type: "POST",
               url: "http://wenda.404886.com/action/news_more_json.php?cateId="+cateId+"&pageNum="+pageNum,
               success: function(data){
					   var rs=data;
                       $.each(rs.newsList,function(index,item){

                       	 $("#newsList_").append("<div class=\"panel panel-headline\"><div class=\"panel-heading\"><h3 class=\"panel-title\"><a href=\"article-"+item.id+"\" target=\"_blank\">"+item.title+"</a></h3><p class=\"panel-subtitle\">发布时间："+item.created_at+"</p></div><div class=\"panel-body\"><p>"+item.summary+"</p></div></div>");
                           
					   });


					   
					  
                  }
            });
	
}
load('<?php echo $cateId;?>',0);

	</script>
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?77f0689ee71ae4147f0963553eb4dc4b";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>

</html>
