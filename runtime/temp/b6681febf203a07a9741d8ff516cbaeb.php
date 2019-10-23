<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\trash\trash_data_list.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
    <ob_link><a class="btn confirm ajax-get" href="<?php echo url('trashDataDel', array('model_name' => $model_name)); ?>"><i class="fa fa-close"></i> 全部删除</a></ob_link>
    <ob_link><a class="btn confirm ajax-get" href="<?php echo url('restoreData', array('model_name' => $model_name)); ?>"><i class="fa fa-reply"></i> 全部恢复</a></ob_link>
  </div>
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>ID</th>
          <th>名称</th>
          <th>创建时间</th>
          <th>删除时间</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['id']; ?></td>
                  <td><?php echo $vo[$dynamic_field]; ?></td>
                  <td><?php echo $vo['create_time']; ?></td>
                  <td><?php echo $vo['update_time']; ?></td>
                  <td class="col-md-2 text-center">
                      <ob_link><a href="<?php echo url('trashDataDel', array('model_name' => $model_name, 'id' => $vo['id'])); ?>" class="btn confirm ajax-get"><i class="fa fa-close"></i> 删除</a></ob_link>
                      &nbsp;
                      <ob_link><a href="<?php echo url('restoreData', array('model_name' => $model_name, 'id' => $vo['id'])); ?>" class="btn confirm ajax-get"><i class="fa fa-reply"></i> 恢复</a></ob_link>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="5" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>
  <div class="box-footer clearfix text-center">
      <?php echo $list->render(); ?>
  </div>
</div>