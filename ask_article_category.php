<!doctype html>
<html lang="en">
<?php
$cateId = $_GET['cateId'];
?>
<head>
	<title>分类管理</title>
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
					<button type="button" class="btn btn-default" onclick="openDialog(0,'')" style="margin-right: 20px;float: right;margin-top: -55px;"><i class="fa fa-plus-square"></i> 添加 </button>
					<?php
						}
					 ?>
					<div class="row">
						<div class="col-md-12" id="newsList_">
							<table class="table">
										<thead>
											<tr>
												<th></th>
												<th>名称</th>
												<th>管理</th>
											</tr>
										</thead>
										<tbody id="tbody">
							
										</tbody>
									</table>
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
	<script src="assets/vendor/bootstrap/js/bootstrap-dialog.min.js"></script>
	<script type="text/javascript">
  window.pageNum_=1;
 window.currentPosition=0;
 window.scrollH=0;
//滚动条到页面底部加载更多案例 
$(window).scroll(function(){
 var scrollTop = $(this).scrollTop();    //滚动条距离顶部的高度
 var scrollHeight = $(document).height();   //当前页面的总高度
 var clientHeight = $(this).height();    //当前可视的页面高度
 
 console.log(scrollTop+":crollTop/"+scrollHeight+":scrollHeight/clientHeight:"+clientHeight);
 // console.log("top:"+scrollTop+",doc:"+scrollHeight+",client:"+clientHeight);
 if(scrollTop + clientHeight >= scrollHeight){   //距离顶部+当前高度 >=文档总高度 即代表滑动到底部 
    load(pageNum_);
     pageNum_++;
 }else if(scrollTop<=0){
	
 }
  
});

function load(num){
	console.log(num+"ddddd");
	 $.ajax({
               type: "GET",
               url: "/action/categories.php?pageNum="+num,
               success: function(data){
					   var rs=data;
                       $.each(rs.newsList,function(index,item){

                       	 $("#tbody").append("<tr><td>"+(index+1)+"</td><td>"+item.name+"</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"openDialog('"+item.id+"','"+item.name+"')\" ><i class=\"fa fa-refresh\"></i> 编辑 </button> &nbsp; <button type=\"button\" class=\"btn btn-danger\" onclick=\"del('"+item.id+"')\" ><i class=\"fa fa-trash-o\"></i> 删除 </button></td></tr>");
                           
					   });


					   
					  
                  }
            });
	
}
load(0);

function openDialog(id,name){
	BootstrapDialog.show({
			title: "分类编辑",
            message: $('<div></div>').load('dialog.php?type=category&id='+id+'&name='+name),
            buttons: [{
                label: '保存',
                cssClass: 'btn-primary',
                action: function(){
                   saveCata();
                }
            },  {
                label: '取消',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
}
function del(id){
	var msg = "您真的确定要删除吗？\n\n请确认！"; 
 if (confirm(msg)==true){ 
  window.location.href="action/category_del.php?id="+id;
 }else{ 
  return false; 
 } 
	
}
function saveCata(){

	 $.ajax({
               type: "GET",
               url: "/action/category_save.php?id="+$("#id").val()+"&name="+$("#name").val(),
               success: function(data){
               		console.log("ddd"+data);
					window.location.reload();
                  }
            });
}
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
