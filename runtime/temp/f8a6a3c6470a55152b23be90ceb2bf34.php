<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\wwwroot\YouQianHuan\public/../app/admin\view\suggestion\suggestion_list.html";i:1564540032;}*/ ?>
<div class="box">
    <div class="box-header ">

        <!--<ob_link><a class="btn" href="<?php echo url('qrcodeAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>-->
        &nbsp;
        <div class="box-tools ">
            <div class="input-group input-group-sm search-form">
                <input name="search_data" class="pull-right search-input" value="<?php echo input('search_data'); ?>" placeholder="账号" type="text">
                <select class="pull-right search-input" name="search_type" style="width: 150px;padding: 3px 12px;" >
                        <option value="" <?php if($search_type == ''): ?>selected<?php endif; ?>>请选择类型</option>
                        <option value="1" <?php if($search_type == 1): ?>selected<?php endif; ?>>建议</option>
                        <option value="2" <?php if($search_type == 2): ?>selected<?php endif; ?>>投诉</option>
                </select>
                <div class="input-group-btn">
                    <button type="button" id="search" url="<?php echo url('suggestionList'); ?>" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table  class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>会员</th>
                    <th>标题</th>
                    <th>投诉状态</th>
                    <th>状态</th>
                    <th>备注</th>
                    <th>添加时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['username']; ?></td>
                    <td><?php echo $vo['title']; ?></td> 
                    <td><?php echo $type[$vo['type']]; ?></td> 
                    <td><?php echo $status[$vo['status']]; ?></td>
                    <td><?php echo $vo['note']; ?></td>
                    <td><?php echo $vo['create_time']; ?></td>
                    <td><?php echo $vo['update_time']; ?></td>              
            <td class="text-center">
            <ob_link><a href="<?php echo url('suggestionEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa"></i> 审 核</a></ob_link>
            &nbsp;
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