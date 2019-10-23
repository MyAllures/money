<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"C:\wwwroot\YouQianHuan\public/../app/admin\view\config\setting.html";i:1564540034;s:74:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<!--
case value
0:数字
1:字符
2:文本
3:数组
4:枚举
5:图片
6:文件
7:富文本
8:单选
9:多选
10:日期
11:时间
12:颜色
-->
<link rel="stylesheet" href="__STATIC__/module/admin/ext/datetimepicker/css/datetimepicker.css" type="text/css">
<link rel="stylesheet" href="__STATIC__/module/admin/ext/datetimepicker/css/dropdown.css" type="text/css">

<form action="<?php echo url(); ?>" method="post" class="form_single">
    
    <div class="box">
        
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <?php if(is_array($config_group_list) || $config_group_list instanceof \think\Collection || $config_group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $config_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($group != $key): ?>
                     <li><a href="<?php echo url('setting',array('group' => $key)); ?>"><?php echo $vo; ?></a></li>
                         <?php else: ?>
                     <li class="active"><a><?php echo $vo; ?></a></li>
                  <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane">

                  
                <div class="box-body">
                  <div class="row">
                      
                    <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label><?php echo $vo['title']; ?></label>

                                    <?php if(!(empty($vo['describe']) || (($vo['describe'] instanceof \think\Collection || $vo['describe'] instanceof \think\Paginator ) && $vo['describe']->isEmpty()))): ?>
                                        <span>（<?php echo $vo['describe']; ?>）</span>
                                    <?php endif; switch($vo['type']): case "0": ?>

                                            <input class="form-control" name="<?php echo $vo['name']; ?>" placeholder="请输入设置值" value="<?php echo $vo['value']; ?>" type="text">

                                        <?php break; case "1": ?>

                                            <input class="form-control" name="<?php echo $vo['name']; ?>" placeholder="请输入设置值" value="<?php echo $vo['value']; ?>" type="text">

                                        <?php break; case "2": ?>

                                            <textarea class="form-control" name="<?php echo $vo['name']; ?>" rows="3" placeholder="请输入设置值"><?php echo $vo['value']; ?></textarea>

                                        <?php break; case "3": ?>

                                            <textarea class="form-control" name="<?php echo $vo['name']; ?>" rows="3" placeholder="请输入设置值"><?php echo $vo['value']; ?></textarea>

                                        <?php break; case "4": ?>

                                            <select name="<?php echo $vo['name']; ?>" class="form-control">
                                                <?php $_result=parse_config_attr($vo['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo $key; ?>" <?php if($vo['value'] == $key): ?> selected <?php endif; ?> ><?php echo $vv; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>

                                        <?php break; case "5": $case_img_var = (isset($vo['value']) && ($vo['value'] !== '')?$vo['value']:'0'); ?>

                                            <?php echo widget('file/index', ['name' => $vo['name'], 'value' => $case_img_var, 'type' => 'img']); if(!(empty($case_img_var) || (($case_img_var instanceof \think\Collection || $case_img_var instanceof \think\Paginator ) && $case_img_var->isEmpty()))): ?>
                                                <div class="upload-pre-item">
                                                    <?php $case_img_var_url = get_picture_url($case_img_var); ?>
                                                    <a target="_blank" href="<?php echo $case_img_var_url; ?>">
                                                        <img style="max-width: 150px;" src="<?php echo $case_img_var_url; ?>"/>
                                                    </a>
                                                </div>
                                            <?php endif; break; case "6": $case_file_var = (isset($vo['value']) && ($vo['value'] !== '')?$vo['value']:'0'); ?>

                                            <?php echo widget('file/index', ['name' => $vo['name'], 'value' => $case_file_var, 'type' => 'file']); if(!(empty($case_file_var) || (($case_file_var instanceof \think\Collection || $case_file_var instanceof \think\Paginator ) && $case_file_var->isEmpty()))): ?>
                                                <div class="upload-pre-file">
                                                    <?php $case_file_var_url = get_file_url($case_file_var); ?>
                                                    <a target="_blank" href="<?php echo $case_file_var_url; ?>">
                                                        <?php echo $case_file_var_url; ?>
                                                    </a>
                                                </div>
                                            <?php endif; break; case "7": ?>
                                            
                                            <textarea class="form-control textarea_editor" name="<?php echo $vo['name']; ?>" placeholder="请输入富文本内容"><?php echo html_entity_decode($vo['value']); ?></textarea>
                                            
                                            <?php echo widget('editor/index', array('name'=> $vo['name'],'value'=> '')); break; case "8": $_result=parse_config_attr($vo['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                                                <div class="radio">
                                                  <label>
                                                    <input name="<?php echo $vo['name']; ?>" id="<?php echo $vo['name']; ?>" value="<?php echo $key; ?>" <?php if($vo['value'] == $key): ?> checked="" <?php endif; ?>   type="radio">
                                                    <?php echo $vv; ?>
                                                  </label>
                                                </div>
                                            <?php endforeach; endif; else: echo "" ;endif; break; case "9": ?>
                                        
                                            <input type="hidden" name="<?php echo $vo['name']; ?>" id="<?php echo $vo['name']; ?>" value="<?php echo $vo['value']; ?>"/>
                                        
                                            <div>
                                                <?php $_result=parse_config_attr($vo['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>

                                                    <div class="checkbox">
                                                        <label>
                                                          <input <?php if(in_array(($key), is_array($vo['value'])?$vo['value']:explode(',',$vo['value']))): ?> checked="checked" <?php endif; ?>  type="checkbox" value="<?php echo $key; ?>" onclick="selectCheckbox(this)">
                                                          <?php echo $vv; ?>
                                                        </label>
                                                    </div>

                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </div>
                                        <?php break; case "10": ?>

                                            <input class="form-control date" name="<?php echo $vo['name']; ?>" placeholder="请选择或输入日期" value="<?php echo $vo['value']; ?>" type="text">

                                        <?php break; case "11": ?>

                                            <input class="form-control time" name="<?php echo $vo['name']; ?>" placeholder="请选择或输入时间" value="<?php echo $vo['value']; ?>" type="text">

                                        <?php break; case "12": ?>

                                            <input class="form-control" name="<?php echo $vo['name']; ?>" placeholder="请选择或输入颜色值" value="<?php echo $vo['value']; ?>" type="color">

                                        <?php break; endswitch; ?>
                               </div>
                            </div>

                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                            
                            <div class="col-md-6">
                                <tr class="odd"><td colspan="6" class="text-center" valign="top"><?php echo config('empty_list_describe'); ?></td></tr>
                            </div>
                    <?php endif; ?>
                    
                  </div>
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

<script type="text/javascript">

    var arr = [
        static_root + 'module/admin/ext/datetimepicker/js/bootstrap-datetimepicker.min.js', 
        static_root + 'module/admin/ext/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js', 
    ];
    ob.loadMultiScripts(arr).done(function() {
        $('.date').datetimepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });

        $('.time').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:0,
            autoclose:true
        });
    });

    function selectCheckbox(obj)
    {
        
        var checkbox_obj = $(obj).parent().parent().parent().prev();
        
        var checkbox_obj_ids = checkbox_obj.val();
        
        var add_id = $(obj).val();
            
        // 选中
        if ($(obj).is(':checked'))
        {
            
            if (checkbox_obj_ids == '') {
                
                checkbox_obj_ids = add_id;
            } else {
                checkbox_obj_ids = checkbox_obj_ids + ',' + add_id;
            }
            
            checkbox_obj.val(checkbox_obj_ids);
            
        } else {
            
            
            if(checkbox_obj_ids.indexOf(",") > 0)
            {
                
                checkbox_obj_ids.indexOf(add_id) == 0 ? checkbox_obj_ids = checkbox_obj_ids.replace(add_id + ',', '') : checkbox_obj_ids = checkbox_obj_ids.replace(',' + add_id, '');
                
                checkbox_obj.val(checkbox_obj_ids);
            } else {
                
                checkbox_obj.val('');
            }
        }
    }

</script>