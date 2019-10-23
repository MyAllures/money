<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"C:\wwwroot\YouQianHuan\public/../app/admin\view\user\user_edit.html";i:1564540032;s:74:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
        <div class="box-body">

            <div class="row">                                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>会员名称(手机号)</label>
                        <span>会员名称(手机号)</span>
                        <input class="form-control" name="username" placeholder="请输入会员名称(手机号)" value="<?php echo (isset($info['username']) && ($info['username'] !== '')?$info['username']:''); ?>" type="text">                            
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>密码</label>
                        <span>(修改密码)</span>
                        <input class="form-control" name="pwd" placeholder="请输入要修改的密码" value="" type="text">                            
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>等级编号</label>
                        <span>（等级管理查看)</span>  
                        <select name="level" class="form-control">
                            <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): $i = 0; $__LIST__ = $level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($level) && ($level !== '')?$level:''); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>状态</label>
                        <span>（状态信息）</span>
                        <select name="status" class="form-control">
                            <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$status): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($status) && ($status !== '')?$status:''); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                            
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
<script type="text/javascript">
    ob.setValue("status", <?php echo (isset($info['status'] ) && ($info['status']  !== '')?$info['status'] : 0); ?>
    );
    ob.setValue("level", <?php echo (isset($info['level'] ) && ($info['level']  !== '')?$info['level'] : 0); ?>
    );
</script>
