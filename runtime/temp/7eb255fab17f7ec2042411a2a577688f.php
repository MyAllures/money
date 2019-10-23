<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"C:\wwwroot\YouQianHuan\public/../app/admin\view\level\sign_setting.html";i:1564540032;s:74:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
        <div class="box-body">

            <div class="row">                                


                <div class="col-md-6">
                    <div class="form-group">
                        <label>赠送糖果开关</label>
                        <span></span>
                        <select name="is_send" class="form-control">
                            <?php if(is_array($is_send_arr) || $is_send_arr instanceof \think\Collection || $is_send_arr instanceof \think\Paginator): $i = 0; $__LIST__ = $is_send_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($vo) && ($vo !== '')?$vo:''); ?></option>
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
    ob.setValue("is_send", <?php echo (isset($is_send) && ($is_send !== '')?$is_send: 0); ?> );
</script>
