<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"D:\wwwroot\YouQianHuan\public/../app/admin\view\login\login.html";i:1570886164;s:63:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\top.html";i:1570886334;s:66:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\bottom.html";i:1564540032;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>有钱还 <?php if(!(empty($ob_title) || (($ob_title instanceof \think\Collection || $ob_title instanceof \think\Paginator ) && $ob_title->isEmpty()))): ?> | <?php echo $ob_title; endif; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="__STATIC__/module/admin/ext/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/adminlte/dist/css/skins/_all-skins.css">
    <link rel="stylesheet" href="__STATIC__/module/common/toastr/toastr.min.css">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/btnloading/dist/ladda-themeless.min.css">
    <link rel="stylesheet" href="__STATIC__/module/admin/css/onebase.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/module/admin/ext/remodal/remodal.css" media="all">
    <link rel="stylesheet" type="text/css" href="__STATIC__/module/admin/ext/remodal/remodal-default-theme.css" media="all">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/adminlte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/adminlte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="__STATIC__/module/admin/ext/adminlte/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="__STATIC__/module/layui/css/layui.css">
       
    <script type="text/javascript" src="__STATIC__/module/common/jquery/jquery-2.2.3.min.js"></script>
    <script src="__STATIC__/module/admin/ext/jquerypjax/jquery.pjax.js"></script>
    <script src="__STATIC__/module/admin/ext/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <script src="__STATIC__/module/admin/js/init.js"></script>
    <script src="__STATIC__/module/layer/layer.js"></script>
    <script src="__STATIC__/module/layui/layui.all.js"></script>
    <style>
        .bg-1{
            background-color:#00a65a!important;
            
        }
        .bg-0{
            background-color:#dd4b39!important;
            
        }
    </style>
</head>
<body class="hold-transition login-page admin-login-body-background">
    <img src="/adminbg.jpg" style="width:100%;height:1000px;"/>
<!-- <script src="__STATIC__/module/admin/ext/background/login_background.js"></script> -->

<canvas></canvas>

<div class="admin-login-box">
  <div class="login-logo">
      <a href="" class="login-logo-a"><b>有钱还管理</b>系统</a>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">请输入您的登录信息</p>

    <form action="<?php echo url('loginHandle'); ?>" method="post" class="admin-login-form">
      <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="请输入您的用户名">
           <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
           <input type="password" name="password" class="form-control" placeholder="请输入您的密码">
           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        
        <div>
            <img src="<?php echo captcha_src(); ?>" alt="captcha" class="admin-login-captcha-img captcha_change" id="captcha_img"/>
        </div>
        <br/>
      <div class="row">
        <div class="col-xs-8">
          <input type="text" name="verify" class="form-control verify" placeholder="请输入您的验证码">
          <span class="glyphicon glyphicon-open form-control-feedback admin-login-captcha-input-icon"></span>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat captcha_change">换一张</button>
        </div>
        <!-- /.col -->
      </div>

        <div class="social-auth-links text-center">
            
          <button  type="submit" class="btn btn-block btn-facebook ladda-button login-submit-button" data-style="slide-up">
              <span class="ladda-label">登 录</span>
          </button>
            
          <!--<button  type="button" class="btn btn-block btn-google btn-flat">忘记密码</button>-->
        </div>
    </form>

    <!-- /.social-auth-links -->
    <!--<a href="#">找回密码</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="__STATIC__/module/admin/ext/adminlte/dist/js/app.min.js"></script>
<script src="__STATIC__/module/admin/ext/adminlte/dist/js/init.js"></script>
<script src="__STATIC__/module/common/toastr/toastr.min.js"></script>
<script src="__STATIC__/module/admin/ext/btnloading/dist/spin.min.js"></script>
<script src="__STATIC__/module/admin/ext/btnloading/dist/ladda.min.js"></script>
<script src="__STATIC__/module/admin/ext/remodal/remodal.min.js"></script>
<script src="__STATIC__/module/admin/ext/adminlte/plugins/iCheck/icheck.min.js"></script>
<script src="__STATIC__/module/admin/js/onebase.js"></script>
<link rel="stylesheet" href="__STATIC__/module/admin/css/ob_skin.css">
<?php echo hook('hook_view_admin'); ?>
</body>
</html>