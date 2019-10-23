<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\wwwroot\YouQianHuan\public/../app/admin\view\article\article_category_list.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
        <ob_link><a href="<?php echo url('articleCategoryAdd'); ?>" class="btn"><i class="fa fa-plus"></i> 新 增</a></ob_link>
        <br/>
  </div>
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>名称</th>
          <th>描述</th>
          <th>图标</th>
          <th>操作</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['name']; ?></td>
                  <td><?php echo $vo['describe']; ?></td>
                  <td><i class="fa <?php echo $vo['icon']; ?>"></i></td>
                  <td class="col-md-2 text-center">
                      <ob_link><a href="<?php echo url('articleCategoryEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa fa-edit"></i> 编辑</a></ob_link>
                      <ob_link><a class="btn confirm ajax-get"  href="<?php echo url('articleCategoryDel', array('id' => $vo['id'])); ?>"><i class="fa fa-trash-o"></i> 删除</a></ob_link>
                  </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="4" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>
  <div class="box-footer clearfix text-center">
      <?php echo $list->render(); ?>
  </div>
</div>