<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\database\data_restore.html";i:1564540034;}*/ ?>
<div class="box">
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>备份名称</th>
          <th>压缩</th>
          <th>数据大小</th>
          <th>备份时间</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo date('Ymd-His',$vo['time']); ?></td>
                  <td><?php echo $vo['compress']; ?></td>
                  <td><?php echo format_bytes($vo['size']); ?></td>
                  <td><?php echo $key; ?></td>
                  <td style="width: 200px;">
                      <ob_link><a class="btn confirm ajax-get" href="<?php echo url('dataRestoreHandle?time='.$vo['time']); ?>" class="btn"><i class="fa fa-exchange"></i> 还 原</a></ob_link>
                      &nbsp;
                      <ob_link><a class="btn confirm ajax-get" href="<?php echo url('backupDel?time='.$vo['time']); ?>"><i class="fa fa-trash-o"></i> 删 除</a></ob_link>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="5" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>
</div>