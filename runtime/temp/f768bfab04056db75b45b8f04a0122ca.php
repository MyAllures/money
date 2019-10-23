<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\wwwroot\YouQianHuan\public/../app/admin\view\database\data_backup.html";i:1564540034;}*/ ?>
<div class="box">
  <div class="box-header">
    
    <ob_link><a id="data_backup" class="btn" url="<?php echo url('dataBackup'); ?>"><i class="fa fa-download"></i> 备份数据</a></ob_link>
    <ob_link><a id='optimize' class="btn" url="<?php echo url('optimize'); ?>"><i class="fa fa-shield"></i> 优 化</a></ob_link>
    <ob_link><a id='repair' class="btn" url="<?php echo url('repair'); ?>"><i class="fa fa-wrench"></i> 修 复</a></ob_link>
    
  </div>
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
      <tr>
          <th>表名</th>
          <th>引擎</th>
          <th>注释</th>
          <th>数据量</th>
          <th>数据大小</th>
          <th>创建时间</th>
      </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['name']; ?></td>
                  <td><?php echo $vo['engine']; ?></td>
                  <td><?php echo $vo['comment']; ?></td>
                  <td><?php echo $vo['rows']; ?></td>
                  <td><?php echo format_bytes($vo['data_length']); ?></td>
                  <td><?php echo $vo['create_time']; ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="6" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
      <?php endif; ?>
    </table>
  </div>

</div>



<script type="text/javascript">

    function sendUrlRequest(id)
    {
        $('.fakeloader').show();

            $.post( $("#" + id).attr("url"),{}, function(data){

                $('.fakeloader').hide();

                obalert(data);

            },"json"
        );
    }

    $("#data_backup").click(function(){ sendUrlRequest('data_backup'); });
    $("#optimize").click(function(){ sendUrlRequest('optimize'); });
    $("#repair").click(function(){ sendUrlRequest('repair'); });
    
</script>