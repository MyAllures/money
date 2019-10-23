<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\wwwroot\YouQianHuan\public/../app/admin\view\service\driver_install.html";i:1564540034;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
            <?php if(is_array($param) || $param instanceof \think\Collection || $param instanceof \think\Paginator): if( count($param)==0 ) : echo "" ;else: foreach($param as $k=>$v): ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo $v; ?></label>
                    <input class="form-control" name="param[<?php echo $k; ?>]" value="<?php echo $info['config'][$k]; ?>" placeholder="请输入<?php echo $v; ?>" type="text">
                  </div>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
        </div>
        
        <div class="box-footer">

            <input type="hidden" name="service_name" value="<?php echo input('service_class'); ?>"/>
            <input type="hidden" name="driver_name" value="<?php echo input('driver_class'); ?>"/>

            <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>
            
        </div>
        
      </div>
</form>