<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\wwwroot\YouQianHuan\public/../app/admin\view\level\level_list.html";i:1564540032;}*/ ?>
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
                    <th>等级编号</th>
                    <th>名称</th>
                    <!--<th>类型</th>-->
                    <th>金额</th>
                    <th>下级达标人数</th>
                    <th>向上查找层数</th>
                    <th>向上查找等级</th>
                    <th>是否等级上限</th>      
                    <th>是否能注册下级</th>
                    <th>赠送积分额度</th>
                    <th>备注</th>
                    <th>创建时间</th>
                    <th>更新时间</th>                   
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['level']; ?></td>
                    <td><?php echo $vo['name']; ?></td>
                    <!--<td><?php echo $type[$vo['type']]; ?></td>-->
                    <td><?php echo $vo['money']; ?></td>
                    <td><?php echo $vo['need_num']; ?></td>
                    <td><?php echo $vo['up_num']; ?></td>
                    <td><?php echo $level[$vo['up_level']]; ?></td>
                    <td><?php echo $is_end[$vo['is_end']]; ?></td>
                    <td><?php echo $can_reg[$vo['can_reg']]; ?></td>
                    <td><?php echo $vo['score']; ?></td>
                    <td><?php echo $vo['note']; ?></td>
                    <td><?php echo $vo['create_time']; ?></td>
                    <td><?php echo $vo['update_time']; ?></td>
            <td class="text-center">
            <ob_link><a href="<?php echo url('levelEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa"></i> 设 置</a></ob_link>
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