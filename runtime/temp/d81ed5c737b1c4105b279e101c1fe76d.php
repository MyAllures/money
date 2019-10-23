<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\wwwroot\YouQianHuan\public/../app/admin\view\user_profile\userprofile_list.html";i:1570886629;}*/ ?>
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
                    <th>会员名称(手机号)</th>
                    <th>微信二维码图片</th>
                    <th>微信号</th>
                    <th>头像</th>
                    <th>昵称</th>
                    <th>性别</th>
<!--                    <th>银行卡号</th>
                    <th>账户姓名</th>
                    <th>银行名称</th>
                    <th>支行名称</th>
                    <th>归属代理</th>                   
                    <th>创建时间</th>
                    <th>更新时间</th> -->
                    <th>操作</th>
                </tr>
            </thead>
            <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['username']; ?></td>
                    <td>
                      <img class="admin-list-img-size" src="<?php echo get_picture_url($vo['wx_picture_id']); ?>"/>
                    </td>
                    <td><?php echo $vo['wx_account']; ?></td>
                    <td>
                      <img class="admin-list-img-size" src="<?php echo get_picture_url($vo['head_icon']); ?>"/>
                    </td>
                    <td><?php echo $vo['nickname']; ?></td>
                    <td><?php echo $sex[$vo['sex']]; ?></td>
<!--                    <td><?php echo $vo['account_no']; ?></td>
                    <td><?php echo $vo['account_name']; ?></td>
                    <td><?php echo $vo['bank_name']; ?></td>
                    <td><?php echo $vo['branch_name']; ?></td>
                    <td><?php echo $vo['bnickname']; ?></td>
                    <td><?php echo $vo['create_time']; ?></td>
                    <td><?php echo $vo['update_time']; ?></td>-->
            <td class="text-center">
            <ob_link><a href="<?php echo url('userProfileEdit', array('id' => $vo['id'])); ?>" class="btn"><i class="fa"></i> 设 置</a></ob_link>
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