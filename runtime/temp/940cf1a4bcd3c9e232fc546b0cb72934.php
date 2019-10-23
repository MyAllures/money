<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\wwwroot\YouQianHuan\public/../app/admin\view\debt\debt_list.html";i:1570866293;}*/ ?>
<div class="box">
    <div class="box-header ">

        <!--<ob_link><a class="btn" href="<?php echo url('qrcodeAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>-->
        &nbsp;
        <div class="box-tools ">
            <div class="input-group input-group-sm search-form">
                <input name="search_data" class="pull-right search-input" value="<?php echo input('search_data'); ?>" placeholder="账号" type="text">
                <div class="input-group-btn">
                    <button type="button" id="search" url="<?php echo url('withdrawList'); ?>" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table  class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>债务编号</th>
                    <th>用户名称</th>
                    <th>申请金额</th>
                    <th>申请类型</th>
                    <th>申请凭证</th>
                    <th>申请时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($debtInfo) || (($debtInfo instanceof \think\Collection || $debtInfo instanceof \think\Paginator ) && $debtInfo->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($debtInfo) || $debtInfo instanceof \think\Collection || $debtInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $debtInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['Id']; ?></td>
                    <td><?php echo $vo['user_name']; ?></td>
                    <td><?php echo $vo['account']; ?></td>
                    <td><?php echo $vo['name']; ?></td>
                    <td><img src="<?php echo $vo['imgurl']; ?>" width="42" class="pimg"></td>
                    <td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
                    <td>
                        <?php if($vo['status']==0): ?>
                            未审核
                        <?php endif; if($vo['status']==1): ?>
                            已审核
                        <?php endif; if($vo['status']==2): ?>
                            已驳回
                        <?php endif; ?>
                    </td>
            <td class="text-center">
                <ob_link><a class="btn confirm ajax-get" href="<?php echo url('editDebt', array('ids' => $vo['Id'])); ?>">审核</a></ob_link>
                <ob_link><a class="btn confirm ajax-get" href="<?php echo url('refuse', array('ids' => $vo['Id'])); ?>">驳回</a></ob_link>
            &nbsp;
            </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <?php else: ?>
                <tbody><tr class="odd"><td colspan="13" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
            <?php endif; ?>
        </table>
    </div>

    <div class="box-footer clearfix text-center">

    </div>

</div>
<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;">
    <div id="innerdiv" style="position:absolute;">
        <img id="bigimg" style="border:5px solid #fff;" src="" />
    </div>
 </div>

<script type="text/javascript">
$(function(){  
        $(".pimg").click(function(){  
            var _this = $(this);//将当前的pimg元素作为_this传入函数  
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);  
        });  
    });  
 
    function imgShow(outerdiv, innerdiv, bigimg, _this){  
        var src = _this.attr("src");//获取当前点击的pimg元素中的src属性  
        $(bigimg).attr("src", src);//设置#bigimg元素的src属性  
      
            /*获取当前点击图片的真实大小，并显示弹出层及大图*/  
        $("<img/>").attr("src", src).load(function(){  
            var windowW = $(window).width();//获取当前窗口宽度  
            var windowH = $(window).height();//获取当前窗口高度  
            var realWidth = this.width;//获取图片真实宽度  
            var realHeight = this.height;//获取图片真实高度  
            var imgWidth, imgHeight;  
            var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放  
              
            if(realHeight>windowH*scale){ 
                imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放  
                imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度  
                if(imgWidth>windowW*scale) { 
                    imgWidth = windowW*scale;//再对宽度进行缩放  
                }  
            } else if(realWidth>windowW*scale){  
                imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放  
                            imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度  
            } else {
                imgWidth = realWidth;  
                imgHeight = realHeight;  
            }  
                    $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放  
              
            var w = (windowW-imgWidth)/2;//计算图片与窗口左边距  
            var h = (windowH-imgHeight)/2;//计算图片与窗口上边距  
            $(innerdiv).css({"top":h, "left":w});//设置#innerdiv的top和left属性  
            $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg  
        });  
          
        $(outerdiv).click(function(){
            $(this).fadeOut("fast");  
        });  
    }
</script>