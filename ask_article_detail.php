<!doctype html>
<html lang="en">
<?php
include "action/common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];

$sql = "update ask_articles set views=views+1 where id='$id'";
$conn->query($sql);

$sql_seo = "select title,created_at,content,user_id from ask_articles where id='$id' ";

$result=$conn->query($sql_seo);
 while ($row=mysqli_fetch_assoc($result)){
        //$id=$row['id'];
        $title = $row['title'];
        $createdAt = $row['created_at'];
        $content = $row['content'];
        $userId= $row['user_id'];
    }
?>
<head>
	<title><?php echo $title; ?></title>
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
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
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
					<h3 class="page-title"><a href="index.htm">首页</a> 》内容</h3>
					<?php
						 if($userId==$_SESSION["userId"]){
					 ?>
					<button type="button" class="btn btn-default" onclick="window.location.href='editor-<?php echo $id; ?>'" style="margin-right: 20px;float: right;margin-top: -55px;"><i class="fa fa-refresh"></i> 编辑 </button>
					<button type="button" class="btn btn-danger" onclick="if(del()) window.location.href='del-<?php echo $id; ?>'" style="margin-right: 120px;float: right;margin-top: -55px;"><i class="fa fa-trash-o"></i> 删除 </button>
					<?php
						}
					 ?>
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title"><?php echo $title; ?></h3>
									<p class="panel-subtitle"><?php echo $createdAt; ?></p>
								</div>
								<div class="panel-body">
									<p><?php echo $content; ?></p>
								</div>
							</div>
							<!-- END PANEL HEADLINE -->
						</div>
						
					</div>
					
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
        <?php $conn->close(); ?>
		<?php include("footer.php"); ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<script>
		function del() { 
			var msg = "您真的确定要删除吗？\n\n请确认！"; 
			if (confirm(msg)==true){ 
						return true; 
			}else{ 
						return false; 
			} 
} 


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
