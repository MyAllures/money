<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"D:\wwwroot\YouQianHuan\public/../app/index\view\upload\index.html";i:1564540032;s:59:"D:\wwwroot\YouQianHuan\public/../app/index\view\layout.html";i:1564540032;s:63:"D:\wwwroot\YouQianHuan\public/../app/index\view\layout\top.html";i:1565264315;s:66:"D:\wwwroot\YouQianHuan\public/../app/index\view\layout\header.html";i:1565263916;s:66:"D:\wwwroot\YouQianHuan\public/../app/index\view\layout\footer.html";i:1565264079;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>人人还开源架构|PHP开源系统</title>
    <meta name="keywords" content="人人还,PHP开源系统,ThinkPHP5,TP5,PHP框架,PHP源码"/>
    <meta name="description" content="一款基于ThinkPHP5研发的开源免费基础架构，基于人人还可以快速的研发各类应用。" />
    <link href="__STATIC__/module/common/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="__STATIC__/module/common/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="__STATIC__/module/index/css/docs.css" rel="stylesheet">
    <link href="__STATIC__/module/index/css/onebase.css" rel="stylesheet">
    
    <script type="text/javascript" src="__STATIC__/module/common/jquery/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="__STATIC__/module/common/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="__STATIC__/module/index/js/common.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo url('index/index'); ?>">人人还</a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                        <li>
                            <a href="<?php echo url('index/index'); ?>">首页</a>
                        </li>
                        <li>
                            <a target="_blank" href="<?php echo ; ?>/api.php">接口文档</a>
                        </li>
                        <li>
                            <a target="_blank" href="http://document.onebase.org">开发文档</a>
                            <!--<a target="_blank" href="https://www.kancloud.cn/onebase/ob/484179">开发文档</a>-->
                        </li>
                        <li>
                            <a target="_blank" href="<?php echo ; ?>/admin.php">后台管理</a>
                        </li>
                        <li>
                            <a target="_blank" href="https://gitee.com/Bigotry/OneBase">源码下载</a>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<header class="jumbotron subhead" id="overview">
    <div class="container">
        <h2>源自相同起点，演绎不同精彩！</h2>
        <p class="lead"></p>
    </div>
</header>

<div id="main-container" class="container">
    <div class="row">
        
        <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                <?php if(!(empty($category_list) || (($category_list instanceof \think\Collection || $category_list instanceof \think\Paginator ) && $category_list->isEmpty()))): if(is_array($category_list) || $category_list instanceof \think\Collection || $category_list instanceof \think\Paginator): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li <?php if(input('cid') == $vo['id']): ?> class="active" <?php endif; ?> ><a href="<?php echo url('index/index',array('cid' => $vo['id'])); ?>"/><i class='icon-chevron-right'></i><?php echo $vo['name']; ?></a></li> 
                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                    <div><?php echo config('empty_list_describe'); ?></div>
                <?php endif; ?>
            </ul>
        </div>

        <div class="span9">
            <section>
                <?php if(!(empty($article_list) || (($article_list instanceof \think\Collection || $article_list instanceof \think\Paginator ) && $article_list->isEmpty()))): if(is_array($article_list) || $article_list instanceof \think\Collection || $article_list instanceof \think\Paginator): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div>
                                <div class="">
                                    <h3><a href="<?php echo url('index/details',array('id' => $vo['id'], 'cid' => $vo['category_id'])); ?>"><?php echo $vo['name']; ?></a></h3>
                                </div>
                                <div>
                                    <p class="lead"><?php echo $vo['describe']; ?></p>
                                </div>
                                <div>
                                    <span><a href="<?php echo url('index/details',array('id' => $vo['id'], 'cid' => $vo['category_id'])); ?>">查看全文</a></span>
                                    <span class="pull-right">
                                    <span>发布时间：<?php echo $vo['create_time']; ?></span>
                                    </span>
                                </div>
                                <hr/>
                            </div>
                      <?php endforeach; endif; else: echo "" ;endif; else: ?>
                    <div><?php echo config('empty_list_describe'); ?></div>
                <?php endif; ?>
                
                
            </section>
            <?php echo $article_list->render(); ?>
        </div>
        
    </div>
</div>
<footer class="footer">
  <div class="container">
      <p> 本站由 <strong><a href="http://www.onebase.org" target="_blank">人人还</a></strong> 强力驱动</p>
  </div>
</footer>

<script type="text/javascript" src="__STATIC__/module/index/js/footer.js"></script>

<?php echo hook('hook_view_index'); ?>

</body>
</html>
