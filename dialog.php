<?php
header("Content-Type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:http://wenda.404886.com');

$type = $_GET['type'];
$id = $_GET['id'];
$name = $_GET['name'];
if($type=='category'){
  ?>
  <div class="panel">
   <div class="panel-heading">
      <h3 class="panel-title"></h3>
   </div>
   <div class="panel-body">
         <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
         <input type="text" name="name" id="name" value="<?php echo $name ;?>" class="form-control" placeholder="类名">

</div>
</div>
  <?php
}

?>