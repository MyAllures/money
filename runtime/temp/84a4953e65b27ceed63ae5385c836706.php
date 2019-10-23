<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"C:\wwwroot\YouQianHuan\public/../app/admin\view\user\user_list.html";i:1571539051;}*/ ?>
<div class="box">
    <div class="box-header ">

        <!--<ob_link><a class="btn" href="<?php echo url('qrcodeAdd'); ?>"><i class="fa fa-plus"></i> 新 增</a></ob_link>-->
        &nbsp;
        <div class="box-tools ">
            <div class="input-group input-group-sm search-form">
                <input name="search_data" class="pull-right search-input" value="<?php echo input('search_data'); ?>" placeholder="推荐人" type="text">
                <input name="search_name" class="pull-right search-input" value="<?php echo input('search_name'); ?>" placeholder="会员名称（手机号）" type="text">
                <div class="input-group-btn">
                    <button type="button" id="search" url="<?php echo url('userList'); ?>" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table  class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>会员名称(手机号)</th>
                    <th>邀请码</th>
                    <th>阶段</th>
                    <th>推荐人</th>
                    <th>金额</th>
                    <th>糖果</th>
                    <th>积分</th>
                    <th>最后登陆时间</th>
                    <th>最后登陆ip</th>
                    <th>添加时间</th>
                    <th>更新时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['username']; ?></td>
                    <td><?php echo $vo['code']; ?></td>
                    <td><?php echo $level[$vo['level']]; ?></td>
                    <td><?php echo $vo['rusername']; ?></td>
                    <td><?php echo $vo['money']; ?></td>
                    <td><?php echo $vo['score']; ?></td>
                    <td><?php echo $vo['score_amount']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$vo['login_time']); ?></td>
                    <td><?php echo long2ip($vo['login_ip']); ?></td>
                    <td><?php echo $vo['create_time']; ?></td>
                    <td><?php echo $vo['update_time']; ?></td>
                    <td><?php echo $status[$vo['status']]; ?></td>
            <td class="text-center">
            <ob_link><a href="<?php echo url('userEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa"></i> 编辑</a></ob_link>
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