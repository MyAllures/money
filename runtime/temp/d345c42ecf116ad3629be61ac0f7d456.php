<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"C:\wwwroot\YouQianHuan\public/../app/admin\view\article\article_list.html";i:1564540032;s:75:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\batch_btn_group.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
      
    <div class="row">
        <div class="col-sm-4">
            <ob_link><a class="btn" href="<?php echo url('articleAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>
        </div>
        
        <div class="col-sm-8">
            <div class="box-tools search-form pull-right">
                <div class="input-group input-group-sm">
                    
                    <input type="text" name="search_data" style="width: 200px;" class="form-control pull-right" value="<?php echo input('search_data'); ?>" placeholder="支持标题|描述">

                    <div class="input-group-btn">
                      <button type="button" id="search"  url="<?php echo url('articlelist'); ?>" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                    </div>

                </div>
           </div>
        </div>
    </div>

  </div>
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th class="checkbox-select-all">
              <label>
                <input class="flat-grey js-checkbox-all" type="checkbox">
              </label>
          </th>
          <th>标题</th>
          <th>分类</th>
          <th>封面</th>
          <th>发布会员</th>
          <th>发布时间</th>
          <th class="status-th">状态</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td>
                    <label>
                        <input class="flat-grey" type="checkbox" name="ids" value="<?php echo $vo['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $vo['name']; ?></td>
                  <td><?php echo $vo['category_name']; ?></td>
                  <td>
                      <img class="admin-list-img-size" src="<?php echo get_picture_url($vo['cover_id']); ?>"/>
                  </td>
                  <td><?php echo $vo['nickname']; ?></td>
                  <td><?php echo $vo['create_time']; ?></td>
                  <td><ob_link><a class="ajax-get" href="<?php echo url('setStatus', array('ids' => $vo['id'], 'status' => (int)!$vo['status'])); ?>"><?php echo $vo['status_text']; ?></a></ob_link></td>
                  <td class="col-md-2 text-center">
                      <ob_link><a href="<?php echo url('articleEdit', array('id' => $vo['id'])); ?>" class="btn "><i class="fa fa-edit"></i> 编辑</a></ob_link>
                      <ob_link><a class="btn confirm ajax-get" href="<?php echo url('setStatus', array('ids' => $vo['id'], 'status' => DATA_DELETE)); ?>"><i class="fa fa-trash-o"></i> 删 除</a></ob_link>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="8" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
      
    <div class="lockscreen-footer">
    <ob_link><a class="btn batch_btn confirm ajax-post" value="<?php echo DATA_NORMAL; ?>"  href="<?php echo url('setStatus'); ?>"><i class="fa fa-check-circle"></i> 启 用</a></ob_link>
    <ob_link><a class="btn batch_btn confirm ajax-post" value="<?php echo DATA_DISABLE; ?>" href="<?php echo url('setStatus'); ?>"><i class="fa fa-times-circle"></i> 禁 用</a></ob_link>
    <ob_link><a class="btn batch_btn confirm ajax-post" value="<?php echo DATA_DELETE; ?>"  href="<?php echo url('setStatus'); ?>"><i class="fa fa-trash"></i> 删 除</a></ob_link>
</div>
  </div>
  <div class="box-footer clearfix text-center">
      <?php echo $list->render(); ?>
  </div>
</div>