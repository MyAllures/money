<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"C:\wwwroot\YouQianHuan\public/../app/admin\view\apply_record\apply_record_list.html";i:1564540032;}*/ ?>
<div class="box">
    <div class="box-header ">

        <!--<ob_link><a class="btn" href="<?php echo url('qrcodeAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>-->
        &nbsp;
        <div class="box-tools ">
            <div class="input-group input-group-sm search-form">
                <input name="search_data" class="pull-right search-input" value="<?php echo input('search_data'); ?>" placeholder="账号" type="text">
                <div class="input-group-btn">
                    <button type="button" id="search" url="<?php echo url('withdrawList'); ?>" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table  class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>记录编号</th>
                    <th>会员</th>
                    <th>升级之前等级</th>
                    <th>升级之后等级</th>
                    <th>申请人</th>
                    <th>升级缴纳金额</th>
                    <th>投诉状态</th>      
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>更新时间</th>                   
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['order_no']; ?></td>
                    <td><?php echo $vo['rusername']; ?></td>
                    <td><?php echo $level[$vo['level_before']]; ?></td>
                    <td><?php echo $level[$vo['level_after']]; ?></td>
                    <td><?php echo $vo['uusername']; ?></td>
                    <td><?php echo $vo['money']; ?></td>
                    <td><?php echo $status_complain[$vo['status_complain']]; ?></td>
                    <td><?php echo $status[$vo['status']]; ?></td>
                    <td><?php echo $vo['create_time']; ?></td>
                    <td><?php echo $vo['update_time']; ?></td>
            <td class="text-center">
            <ob_link><a href="<?php echo url('complainEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa"></i> 投诉记录</a></ob_link>
            &nbsp;
            </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <?php else: ?>
            <tbody><tr class="odd"><td colspan="13" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr></tbody>  
            <?php endif; ?>
        </table>
    </div>

    <div class="box-footer clearfix text-center">
        <?php echo $list->render(); ?>
    </div>

</div>