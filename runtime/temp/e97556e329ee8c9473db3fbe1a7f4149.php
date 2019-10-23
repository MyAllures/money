<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wwwroot\YouQianHuan\public/../app/admin\view\config\config_edit.html";i:1564540034;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>名称</label>
              <span>（用于config函数调用，只能使用英文且不能重复）</span>
              <input class="form-control" name="name" placeholder="请输入配置名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>配置标题</label>
              <span>（用于后台显示的配置标题）</span>
              <input class="form-control" name="title" placeholder="请输入配置标题" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>配置类型</label>
                <span>（系统会根据不同类型解析配置值）</span>
                <select name="type" class="form-control">
                    <?php if(is_array($config_type_list) || $config_type_list instanceof \think\Collection || $config_type_list instanceof \think\Paginator): $i = 0; $__LIST__ = $config_type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>配置分组</label>
                <span>（配置分组，不分组则不会显示在系统设置中）</span>
                <select name="group" class="form-control">
                    <option value="0">不分组</option>
                    <?php if(is_array($config_group_list) || $config_group_list instanceof \think\Collection || $config_group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $config_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $group; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>配置值</label>
                <span>（配置取值）</span>
                <textarea class="form-control" name="value" rows="3" placeholder="请输入配置取值"><?php echo (isset($info['value']) && ($info['value'] !== '')?$info['value']:''); ?></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>配置项</label>
                <span>（如果是枚举型 需要配置该项）</span>
                <textarea class="form-control" name="extra" rows="3" placeholder="请输入配置项"><?php echo (isset($info['extra']) && ($info['extra'] !== '')?$info['extra']:''); ?></textarea>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>描述信息</label>
                <span>（描述信息/备注）</span>
                <textarea class="form-control" name="describe" rows="3" placeholder="请输入描述信息"><?php echo (isset($info['describe']) && ($info['describe'] !== '')?$info['describe']:''); ?></textarea>
            </div>
          </div>
            

          <div class="col-md-6">
            <div class="form-group">
              <label>排序值</label>
              <span>（用于分组显示的顺序，默认为 0）</span>
              <input class="form-control" name="sort" placeholder="请输入菜单排序值" value="<?php echo (isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'0'); ?>" type="text">
            </div>
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
</form>

<script type="text/javascript">
    
   ob.setValue("group", <?php echo (isset($info['group']) && ($info['group'] !== '')?$info['group']:0); ?>);
   ob.setValue("type", <?php echo (isset($info['type']) && ($info['type'] !== '')?$info['type']:0); ?>);
       
</script>