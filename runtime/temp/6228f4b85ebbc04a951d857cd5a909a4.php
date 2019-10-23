<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\wwwroot\YouQianHuan\public/../app/admin\view\blogroll\blogroll_list.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
    
    <ob_link><a class="btn" href="<?php echo url('blogrollAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>
    
  </div>
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>名称</th>
          <th>图片</th>
          <th>URL</th>
          <th>排序</th>
          <th>创建时间</th>
          <th>状态</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['name']; ?></td>
                  <td><img class="admin-list-img-size" src="<?php echo get_picture_url($vo['img_id']); ?>"/></td>
                  <td><?php echo $vo['url']; ?></td>
                  <td><?php echo $vo['sort']; ?></td>
                  <td><?php echo $vo['create_time']; ?></td>
                  <td><?php echo $vo['status_text']; ?></td>
                  <td class="col-md-2 text-center">
                      <ob_link><a href="<?php echo url('blogrollEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa fa-edit"></i> 编 辑</a></ob_link>
                      &nbsp;
                      <ob_link><a class="btn confirm ajax-get"  href="<?php echo url('blogrollDel', array('id' => $vo['id'])); ?>"><i class="fa fa-trash-o"></i> 删 除</a></ob_link>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="7" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>

  <div class="box-footer clearfix text-center">
      <?php echo $list->render(); ?>
  </div>

</div>