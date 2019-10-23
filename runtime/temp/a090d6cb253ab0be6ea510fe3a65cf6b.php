<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\wwwroot\YouQianHuan\public/../app/admin\view\menu\menu_edit.html";i:1564540034;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>名称</label>
              <span>（系统后台显示菜单名称）</span>
              <input class="form-control" name="name" placeholder="请输入菜单名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>排序值</label>
              <span>（用户菜单的排序，默认为 0）</span>
              <input class="form-control" name="sort" placeholder="请输入菜单排序值" value="<?php echo (isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'0'); ?>" type="text">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>链接</label>
              <span>（url函数解析的URL或者外链）</span>
              <input class="form-control" name="url" placeholder="请输入菜单链接" value="<?php echo (isset($info['url']) && ($info['url'] !== '')?$info['url']:''); ?>" type="text">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
                <label>上级菜单</label>
                <span>（所属的上级菜单）</span>
                <select name="pid" class="form-control">
                    <option value="0">顶级菜单</option>
                    <?php if(is_array($menu_select) || $menu_select instanceof \think\Collection || $menu_select instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>图标</label>
              <span>（菜单小图标，为空则显示系统默认图标）</span>
                    <?php $icon = (isset($info['icon']) && ($info['icon'] !== '')?$info['icon']:''); ?>
                    <?php echo widget('icon/index', ['name' => 'icon', 'value' => $icon]); ?>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>是否隐藏</label>
                <span>（若隐藏则在菜单中不显示）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" name="is_hide" value="1"> 是</label>
                    <label><input type="radio" name="is_hide"  value="0"> 否</label>
                </div>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>快捷操作</label>
                <span>（若为快捷操作则会出现在后台上方顶部菜单栏）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" name="is_shortcut" value="1"> 是</label>
                    <label><input type="radio" name="is_shortcut"  value="0"> 否</label>
                </div>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer">
          
        <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:'0'); ?>"/>
        
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
            <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
        </button>

        <a class="btn" href="<?php echo url('menuList'); ?>"><i class="fa fa-history"></i> 返 回</a>
        
      </div>
    </div>
</form>

<script type="text/javascript">
    
   ob.setValue("is_hide", <?php echo (isset($info['is_hide']) && ($info['is_hide'] !== '')?$info['is_hide']:0); ?>);
   ob.setValue("is_shortcut", <?php echo (isset($info['is_shortcut']) && ($info['is_shortcut'] !== '')?$info['is_shortcut']:0); ?>);
   ob.setValue("pid", <?php echo (isset($info['pid']) && ($info['pid'] !== '')?$info['pid']:0); ?>);
       
</script>