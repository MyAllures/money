<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"C:\wwwroot\YouQianHuan\public/../app/admin\view\user\register.html";i:1564540032;s:74:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>用户名</label>
              <span>（用户名会作为默认的昵称）</span>
              <input class="form-control" name="username" placeholder="请输入用户名" type="text">
            </div>
          </div>
 
          <div class="col-md-6">
            <div class="form-group">
              <label>密码</label>
              <span>（用户密码不能少于6位）</span>
              <input class="form-control" name="password" placeholder="请输入密码" type="password">
            </div>
          </div>
 
          <div class="col-md-6">
            <div class="form-group">
              <label>微信号</label>
              <span>（微信号）</span>
              <input class="form-control" name="wx_account" placeholder="微信号" type="text">
            </div>
          </div>
 
          <div class="col-md-6">
            <div class="form-group">
              <label>姓名</label>
              <span>（姓名）</span>
              <input class="form-control" name="account_name" placeholder="姓名" type="text">
            </div>
          </div>
            
            <div class="col-md-6">
                    <div class="form-group">
                        <label>等级</label>
                        <span>（等级)</span>  
                        <select name="level" class="form-control">
                            <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): $i = 0; $__LIST__ = $level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($level) && ($level !== '')?$level:''); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            
              <div class="col-md-6">
            <div class="form-group">
              <label>上级会员手机</label>
              <span>（没有就不填）</span>
              <input class="form-control" name="invite_user" placeholder="上级会员手机" type="text">
            </div>
          </div>
        
            
        </div>
      </div>
      <div class="box-footer">
        
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>
      </div>
    </div>
</form>
