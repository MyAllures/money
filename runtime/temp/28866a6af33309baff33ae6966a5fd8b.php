<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\wwwroot\YouQianHuan\public/../app/admin\view\level\level_edit.html";i:1564540032;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
        <div class="box-body">

            <div class="row">                                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>名称</label>
                        <span>(名称)</span>
                        <input class="form-control" name="name" placeholder="请输入名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">                            
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>金额</label>
                        <span>(金额)</span>
                        <input class="form-control" name="money" placeholder="请输入金额" value="<?php echo (isset($info['money']) && ($info['money'] !== '')?$info['money']:''); ?>" type="text">                          
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>下级达标人数</label>
                        <span>(下级达标人数)</span>
                        <input class="form-control" name="need_num" placeholder="请输入下级达标人数" value="<?php echo (isset($info['need_num']) && ($info['need_num'] !== '')?$info['need_num']:''); ?>" type="text">                          
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>向上查找层数</label>
                        <span>(向上查找层数)</span>
                        <input class="form-control" name="up_num" placeholder="请输入向上查找层数" value="<?php echo (isset($info['up_num']) && ($info['up_num'] !== '')?$info['up_num']:''); ?>" type="text">                          
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>向上查找等级</label>
                        <span>(向上查找等级)</span>
                        <input class="form-control" name="up_level" placeholder="请输入向上查找等级" value="<?php echo (isset($info['up_level']) && ($info['up_level'] !== '')?$info['up_level']:''); ?>" type="text">                          
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>等级上限</label>
                        <span>（	是否等级上限）</span>
                        <select name="is_end" class="form-control">
                            <?php if(is_array($is_end) || $is_end instanceof \think\Collection || $is_end instanceof \think\Paginator): $i = 0; $__LIST__ = $is_end;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$is_end): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($is_end) && ($is_end !== '')?$is_end:''); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                            
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>注册下级</label>
                        <span>（	是否能注册下级）</span>
                        <select name="can_reg" class="form-control">
                            <?php if(is_array($can_reg) || $can_reg instanceof \think\Collection || $can_reg instanceof \think\Paginator): $i = 0; $__LIST__ = $can_reg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$can_reg): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>"><?php echo (isset($can_reg) && ($can_reg !== '')?$can_reg:''); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                            
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>赠送积分额度</label>
                        <span>(赠送积分额度)</span>
                        <input class="form-control" name="score" placeholder="请输入赠送积分额度" value="<?php echo (isset($info['score']) && ($info['score'] !== '')?$info['score']:''); ?>" type="text">                          
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>备注</label>
                        <span>(备注)</span>
                        <input class="form-control" name="note" placeholder="请输入备注" value="<?php echo (isset($info['note']) && ($info['note'] !== '')?$info['note']:''); ?>" type="text">                          
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
    </div>
</form>
<script type="text/javascript">
    ob.setValue("is_end", <?php echo (isset($info['is_end'] ) && ($info['is_end']  !== '')?$info['is_end'] : 0); ?>
    );
    ob.setValue("can_reg", <?php echo (isset($info['can_reg'] ) && ($info['can_reg']  !== '')?$info['can_reg'] : 0); ?>
    );
</script>
