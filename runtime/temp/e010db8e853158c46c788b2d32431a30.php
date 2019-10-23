<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"C:\wwwroot\YouQianHuan\public/../app/admin\view\service\driver_list.html";i:1564540034;}*/ ?>
<div class="box">
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>名称</th>
          <th>驱动</th>
          <th>描述</th>
          <th>版本</th>
          <th>作者</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['driver_name']; ?></td>
                  <td><?php echo $vo['driver_class']; ?></td>
                  <td><?php echo $vo['driver_describe']; ?></td>
                  <td><?php echo $vo['version']; ?></td>
                  <td><?php echo $vo['author']; ?></td>
                  <td class="col-md-2 text-center">
                      <?php if($vo['is_install'] == '1'): ?>
                        <ob_link><a href="<?php echo url('driverInstall', array('service_class' => input('service_name'), 'driver_class' => $vo['driver_class'])); ?>" class="btn"><i class="fa fa-edit"></i> 设 置</a></ob_link>
                        <ob_link><a class="btn confirm ajax-get" href="<?php echo url('driverUninstall', array('service_class' => input('service_name'), 'driver_class' => $vo['driver_class'])); ?>"><i class="fa fa-remove"></i> 卸 载</a></ob_link>
                        <?php else: ?>
                        <ob_link><a href="<?php echo url('driverInstall', array('service_class' => input('service_name'), 'driver_class' => $vo['driver_class'])); ?>" class="btn"><i class="fa fa-refresh"></i> 安 装</a></ob_link>
                      <?php endif; ?>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="6" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>

</div>