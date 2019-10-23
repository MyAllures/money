<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\wwwroot\YouQianHuan\public/../app/admin\view\user_profile\userprofile_edit.html";i:1564540034;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
        <div class="box-body">

            <div class="row">                                
                
                
                <div class="col-md-6">
                    <div class="form-group">
                      <label>微信号</label>
                      <span class="">（微信号）</span>
                      <input class="form-control" name="wx_account" placeholder="请输入微信号" value="<?php echo (isset($info['wx_account']) && ($info['wx_account'] !== '')?$info['wx_account']:''); ?>" type="text">
                    </div>
                  </div>
                
                  
            </div>

            <div class="box-footer">

                <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:'0'); ?>"/>

                <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>

            </div>

        </div>
    </div>
</form>
<!--<script type="text/javascript">
    ob.setValue("status", <?php echo (isset($info['status'] ) && ($info['status']  !== '')?$info['status'] : 0); ?>
    );
</script>-->
