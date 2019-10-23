<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\wwwroot\YouQianHuan\public/../app/admin\view\log\log_list.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
    <ob_link><a class="btn confirm ajax-get" href="<?php echo url('logClean'); ?>"><i class="fa fa-trash-o"></i> 清空日志</a></ob_link>
  </div>
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>名称</th>
          <th>描述</th>
          <th>执行者</th>
          <th>执行IP</th>
          <th>执行URL</th>
          <th>执行时间</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['name']; ?></td>
                  <td><?php echo $vo['describe']; ?></td>
                  <td><?php echo $vo['username']; ?></td>
                  <td><?php echo $vo['ip']; ?></td>
                  <td><?php echo $vo['url']; ?></td>
                  <td><?php echo $vo['create_time']; ?></td>
                  <td class="col-md-2 text-center">
                      <ob_link><a class="btn confirm ajax-get"  href="<?php echo url('logDel', array('id' => $vo['id'])); ?>"><i class="fa fa-trash-o"></i> 删 除</a></ob_link>
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