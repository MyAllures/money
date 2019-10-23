<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wwwroot\YouQianHuan\public/../app/admin\view\addon\hook_list.html";i:1564540032;}*/ ?>
<div class="box">
    <div class="box-body">
        <table  class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>名称</th>
                    <th>描述</th>
                    <th>挂载插件</th>
                </tr>
            </thead>
          <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
                <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['name']; ?></td>
                            <td><?php echo $vo['describe']; ?></td>
                            <td><?php echo $vo['addon_list']; ?></td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            <?php else: ?>
                <tbody><tr class="odd"><td colspan="3" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
          <?php endif; ?>
        </table>
    </div>
    
    <div class="box-footer clearfix text-center">
        <?php echo $list->render(); ?>
    </div>
</div>