<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\wwwroot\YouQianHuan\public/../app/admin\view\trash\trash_list.html";i:1564540032;}*/ ?>
<div class="box">
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>名称</th>
          <th>路径</th>
          <th>数量</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['name']; ?></td>
                  <td><?php echo $vo['model_path']; ?></td>
                  <td><?php echo $vo['number']; ?></td>
                  <td class="col-md-1 text-center">
                      <a href="<?php echo url('trashDataList', array('name' => $vo['name'])); ?>" class="btn"><i class="fa fa-database"></i> 数 据</a>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="4" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>

</div>