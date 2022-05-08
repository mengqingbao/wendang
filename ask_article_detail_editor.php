<!doctype html>
<html lang="en">
<?php
include "action/common/db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];

$sql_seo = "select title,summary,category_id,content from ask_articles where id='".$id."' ";

$result=$conn->query($sql_seo);
 while ($row=mysqli_fetch_assoc($result)){
        
        $title = $row['title'];
        $summary = $row['summary'];
        $content = $row['content'];
        $category_id = $row['category_id'];
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
	<link rel="stylesheet" href="assets/captchas/css/captcha.css">
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
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">内容编辑</h3>
								</div>
								<div class="panel-body">
									<form name="form1" id="form1" action="/action/article_save.php" method="post">
										<input type="text" class="form-control" name="title" placeholder="标题" value="<?php echo $title;?>">
									<br>
								
									
									<select class="form-control" name="category_id">
										<option value="cheese">选择分类</option>
										<?php 
										$sql_seo = "select id,name from ask_categories where status='1' ";

										$result=$conn->query($sql_seo);
 										while ($row=mysqli_fetch_assoc($result)){
        						?>
 										       <option value="<?php echo $row['id'] ?>" <?php if($category_id==$row['id']){ echo "selected";}?>><?php echo $row['name'];?></option>
 										<?php
  										  }
  										?>
										
									</select>
									<br>
									<textarea class="form-control" name="summary" placeholder="描述" rows="4"><?php echo $summary;?></textarea>
									<br>

									  <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
									  <code id="contentHtml" style="display:none;">
									  	<?php echo $content;?>
									  </code>
									
										<input type="hidden"  name="id" id="id" value="<?php echo $id; ?>"/>
										<input type="hidden"  name="content" id="content" value=""/>
										
									<br/>
									
									<div id="captha1"></div>
									<br/>
									<div class="row">
										<div class="col-md-6">
											<button type="button" onclick="submitForm()" class="btn btn-primary btn-block">保存</button>
										</div>
										<div class="col-md-6">
											<button type="button" onclick="javascript:window.location.href='/index.htm'" class="btn btn-warning btn-block">取消</button>
										</div>
									</div>
								</div>
								</form>
								<!--body-end-->
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
	<script type="text/javascript" charset="utf-8" src="http://rs.404886.com/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="http://rs.404886.com/ueditor/ueditor.all.min.js"> </script>
  <script type="text/javascript" charset="utf-8" src="http://rs.404886.com/ueditor/lang/zh-cn/zh-cn.js"></script>
  <script src="assets/captchas/js/captcha.js"></script>
  
  <script>
	var content=$('#contentHtml').html();
		var ue = UE.getEditor('editor');
		
		function gotoIndex(){
			window.location.href='index.html';

		}

		$(function(){
			//setContent();

			ue.ready(function() {	
        ue.setContent(content);

    });
			//window.setTimeout(setContent(),1000);

		});
		
		
function callback(isSuccess){
	
}
var obj=$("#captha1").sliderVerification("",{successCallback:callback});
function submitForm(){
	var content = ue.getContent();
	jQuery("#content").val(content);
	if(!window.isSuccess){
		alert("您还没有进行验证");
		
		return false;
	}
	$("#form1").submit();
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
