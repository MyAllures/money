<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wwwroot\YouQianHuan\public/../app/admin\view\member\member_auth.html";i:1564540032;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    
    <div class="box">
        
          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="active tab-pane">
                <div class="box-body">
                    
                    
                  <div class='box box-header admin-node-header'>

                            <div class='box-header'>
                                <div class='checkbox'>
                                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    
                                        <label class='admin-node-label'>
                                            
                                            <input class='rules_all' type='checkbox' name="group_id[]" value="<?php echo $vo['id']; ?>" <?php if($vo['tag'] == 'active'): ?> checked='checked' <?php endif; ?> > <?php echo $vo['name']; ?>
                                        </label>
                                    
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                  </div>
                    
                </div>
              </div>
            </div>
          </div>

      <div class="box-footer">
          
          
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
         
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>
      </div>
    </div>
</form>