<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\wwwroot\YouQianHuan\public/../app/admin\view\fileclean\file_clear.html";i:1564540032;}*/ ?>
<div class="box">
  <div class="box-header">
    
    <ob_link><a id="file_clear" class="btn" url="<?php echo url('cleanList'); ?>"><i class="fa fa-close"></i> 开始清理</a></ob_link>
    
  </div>
    
  <div class="box-body table-responsive">
    <table  class="table table-bordered table-hover">
      <thead>
        <tr>
            <th>文件路径</th>
            <th>文件大小</th>
            <th>创建时间</th>
        </tr>
      </thead>
      
      <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['file_path']; ?>\<?php echo $vo['file_name']; ?></td>
                    <td><?php echo $vo['file_size']; ?></td>
                    <td><?php echo $vo['file_ctime']; ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <?php else: ?>
        <tbody><tr class="odd"><td colspan="3" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>
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
    
    $("#file_clear").click(function(){ sendUrlRequest('file_clear'); });
</script>