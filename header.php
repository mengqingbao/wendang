<!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="brand">
        <a href="index.html" style="font-size:18px;font-weight: 700;">全知问答</a>
      </div>
      <div class="container-fluid">
        <div class="navbar-btn">
          <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <!--form class="navbar-form navbar-left">
          <div class="input-group">
            <input type="text" value="" class="form-control" placeholder="Search dashboard...">
            <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
          </div>
        </form -->
        <!--div class="navbar-btn navbar-btn-right">
          <a class="btn btn-success update-pro" href="#downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>退出</span></a>
        </div-->
        <div id="navbar-menu">
          <ul class="nav navbar-nav navbar-right">
           
            <!--li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="#">Basic Use</a></li>
                <li><a href="#">Working With Data</a></li>
                <li><a href="#">Security</a></li>
                <li><a href="#">Troubleshooting</a></li>
              </ul>
            </li-->
            <?php
              session_start();
              header("Content-Type: text/html; charset=utf-8");
              $username=$_SESSION['adminuser'];
              if($username==""){
              ?>
            <li>
            <div class="navbar-btn navbar-btn-right">
              <a class="btn " href="page-login.html" title="" target="_blank"><span>登录</span></a> &nbsp;
              <a class="btn " href="page-reg.html" title="Upgrade to Pro" target="_blank"><span>注册</span></a>
            </div>
          </li>
           <?php
              
              }else{

            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                <i class="lnr lnr-alarm"></i>
                <span class="badge bg-danger">0</span>
              </a>
              <ul class="dropdown-menu notifications">
                <!--li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                <li><a href="#" class="more">See all notifications</a></li -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user"></i><span> <?php echo $username; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="lnr lnr-user"></i> <span>用户设置</span></a></li>
                <li><a href="category"><i class="lnr lnr-bookmark"></i> <span>分类管理</span></a></li>
                <!--li><a href="#"><i class="lnr lnr-cog"></i> <span>订阅</span></a></li-->
                <li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>登出</span></a></li>
              </ul>
            </li>

            <?php
             }
              ?>
            <!-- <li>
              <a class="update-pro" href="#downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="index.htm" class="active"><i class="lnr lnr-home"></i> <span>首页</span></a></li>
            <?php 
            include "action/common/db.php";
            $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql_seo = "select id,name from ask_categories where status='1' ";

                    $result=$conn->query($sql_seo);
                    while ($row=mysqli_fetch_assoc($result)){
                    ?>
                     <li><a href="list-<?php echo $row['id'] ?>"><i class="lnr lnr-code"></i> <span><?php echo $row['name'];?></span></a></li>
                      
                    <?php
                        }
                      ?>
                    

            <!--li><a href="index.htm" class=""><i class="lnr lnr-code"></i> <span>文章</span></a></li>
            <li><a href="index.htm" class=""><i class="lnr lnr-chart-bars"></i> <span>问答</span></a></li>
            <li><a href="index.htm" class=""><i class="lnr lnr-cog"></i> <span>关注</span></a></li>
            <li><a href="index.htm" class=""><i class="lnr lnr-alarm"></i> <span>好友</span></a></li>
            <li>
              <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>收藏</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages" class="collapse ">
                <ul class="nav">
                  <li><a href="page-profile.html" class="">Profile</a></li>
                  <li><a href="page-login.html" class="">Login</a></li>
                  <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
                </ul>
              </div>
            </li>
            <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>话题</span></a></li>
            <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>新闻</span></a></li>
            <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>我的</span></a></li-->
          </ul>
        </nav>
      </div>
    </div>
    <!-- END LEFT SIDEBAR -->