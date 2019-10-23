<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\wwwroot\YouQianHuan\public/../app/admin\view\article\article_edit.html";i:1564540032;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>标题</label>
              <span class="">（文章标题名称）</span>
              <input class="form-control" name="name" placeholder="请输入文章标题名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label>分类</label>
              <span class="">（文章分类）</span>
                <select name="category_id" class="form-control">
                    <?php if(is_array($article_category_list) || $article_category_list instanceof \think\Collection || $article_category_list instanceof \think\Paginator): $i = 0; $__LIST__ = $article_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if(!(empty($info['category_id']) || (($info['category_id'] instanceof \think\Collection || $info['category_id'] instanceof \think\Paginator ) && $info['category_id']->isEmpty()))): if($info['category_id'] == $vo['id']): ?> selected="selected" <?php endif; endif; ?> ><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>描述</label>
                <span class="">（文章描述信息/简介）</span>
                <textarea class="form-control" name="describe" rows="3" placeholder="请输入文章描述信息/简介"><?php echo (isset($info['describe']) && ($info['describe'] !== '')?$info['describe']:''); ?></textarea>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>封面图片</label>
                <span class="">（请上传单张封面图片）</span>
                <br/>
                <?php $cover_id = (isset($info['cover_id']) && ($info['cover_id'] !== '')?$info['cover_id']:'0'); ?>
                <?php echo widget('file/index', ['name' => 'cover_id', 'value' => $cover_id, 'type' => 'img']); ?>
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
                <label>多图片</label>
                <span class="">（请上传多图片）</span>
                <br/>
                
                <?php $img_ids = (isset($info['img_ids']) && ($info['img_ids'] !== '')?$info['img_ids']:''); ?>
                <?php echo widget('file/index', ['name' => 'img_ids', 'value' => $img_ids, 'type' => 'imgs']); ?>
                
            </div>
          </div>
            
            
          <div class="col-md-6">
            <div class="form-group">
                <label>附件</label>
                <span class="">（文章可下载附件）</span>
                <br/>
                <?php $file_id = (isset($info['file_id']) && ($info['file_id'] !== '')?$info['file_id']:'0'); ?>
                <?php echo widget('file/index', ['name' => 'file_id', 'value' => $file_id, 'type' => 'file']); ?>
            </div>
          </div>
            
          </div>
        <div class="row">
           
            
          <div class="col-md-12">
            <div class="form-group">
                <label>文章内容</label>
                <textarea class="form-control textarea_editor" name="content" placeholder="请输入文章内容"><?php echo (isset($info['content']) && ($info['content'] !== '')?$info['content']:''); ?></textarea>
                <?php echo widget('editor/index', array('name'=> 'content','value'=> '')); ?>
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