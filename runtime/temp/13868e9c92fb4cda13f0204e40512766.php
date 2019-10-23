<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wwwroot\YouQianHuan\public/../app/admin\view\member\member_edit.html";i:1564540032;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>用户名</label>
              <span>（用户名，主要用于登录）</span>
              <input class="form-control" name="username" placeholder="请输入用户名" value="<?php echo $info['username']; ?>" type="text">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>昵称</label>
              <span>（会员昵称，主要用于显示）</span>
              <input class="form-control" name="nickname" placeholder="请输入昵称" value="<?php echo $info['nickname']; ?>" type="text">
            </div>
          </div>
 
          <div class="col-md-6">
            <div class="form-group">
              <label>邮箱</label>
              <span>（用户邮箱，用于找回密码等安全操作）</span>
              <input class="form-control" name="email" placeholder="请输入邮箱" value="<?php echo $info['email']; ?>" type="text">
            </div>
          </div>
 
          <div class="col-md-6">
            <div class="form-group">
              <label>手机</label>
              <span>（手机号码，用于找回密码等安全操作）</span>
              <input class="form-control" name="mobile" placeholder="请输入手机号码" value="<?php echo $info['mobile']; ?>" type="text">
            </div>
          </div>
    
        </div>
      </div>
      <div class="box-footer">
        
        <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:'0'); ?>"/>
          
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>
        
      </div>
    </div>
</form>
