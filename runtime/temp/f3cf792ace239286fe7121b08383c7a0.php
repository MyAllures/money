<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"C:\wwwroot\YouQianHuan\public/../app/admin\view\api\api_edit.html";i:1564540032;s:74:"C:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<link rel="stylesheet" href="__STATIC__/module/admin/ext/edittable/jquery.edittable.min.css">

<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>名称</label>
              <span>（API接口名称）</span>
              <input class="form-control" name="name" placeholder="请输入API接口名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label>排序</label>
              <span>（API接口排序值）</span>
              <input class="form-control" name="sort" placeholder="请输入API接口排序值" value="<?php echo (isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'0'); ?>" type="text">
            </div>
          </div>
            
            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求地址</label>
              <span>（控制器/方法名）</span>
              <input class="form-control" name="api_url" placeholder="请输入请求地址" value="<?php echo (isset($info['api_url']) && ($info['api_url'] !== '')?$info['api_url']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求类型</label>
              <span>（POST | GET）</span>
                <select name="request_type" class="form-control">
                    <option value="0">POST</option>
                    <option value="1">GET</option>
                </select>
            </div>
          </div>
            
            
        <div class="col-md-6">
          <div class="form-group">
            <label>是否为分页接口</label>
            <span>（若为分页接口则需传递分页相关参数）</span>
              <div>
                  <label class="margin-r-5"><input type="radio" checked="checked" name="is_page"  value="0"> 否</label>
                  <label><input type="radio" name="is_page" value="1"> 是</label>
              </div>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>研发者</label>
                <select name="developer" class="form-control">
                    <?php $_result=parse_config_array('team_developer');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>

            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求数据</label>
              <span>（若为否则无需添加请求字段）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" checked="checked" name="is_request_data"  value="0"> 否</label>
                    <label><input type="radio" name="is_request_data" value="1"> 是</label>
                </div>
              <table id="request_data_table" style="display : none;"></table>
            </div>
          </div>
            
          <div class="col-md-6">
              
            <div class="form-group">
              <label>响应数据</label>
              <span>（若为否则无需添加响应字段）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" checked="checked" name="is_response_data"  value="0"> 否</label>
                    <label><input type="radio" name="is_response_data" value="1"> 是</label>
                </div>
              <table id="response_data_table" style="display : none;"></table>
            </div>
          </div>
        </div>
          <div class="row">

              
          <div class="col-md-6">
            <div class="form-group">
              <label>分组</label>
                <select name="group_id" class="form-control">
                    <option value="0">---请选择分组---</option>
                    <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
              
            
          <div class="col-md-6">
            <div class="form-group">
              <label>接口状态</label>
                <select name="api_status" class="form-control">
                    <?php $_result=parse_config_array('api_status_option');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
              
          <div class="col-md-6">
            <div class="form-group">
                <label>接口响应示例</label>
                <textarea class="form-control" name="response_examples" rows="3" placeholder="请输入接口响应示例"><?php echo (isset($info['response_examples']) && ($info['response_examples'] !== '')?$info['response_examples']:''); ?></textarea>
            </div>
          </div>
              
          <div class="col-md-6">
            <div class="form-group">
                <label>接口简介</label>
                <textarea class="form-control" name="describe" rows="3" placeholder="请输入接口简介"><?php echo (isset($info['describe']) && ($info['describe'] !== '')?$info['describe']:''); ?></textarea>
            </div>
          </div>

              
              
              
              
            <div class="col-md-6">

              <div class="form-group">
                <label>是否验证用户令牌：user_token</label>
                <span>（若为否则为无需验证身份的接口，若为是则需要登录后获取 user_token）</span>
                  <div>
                      <label class="margin-r-5"><input type="radio" checked="checked" name="is_user_token"  value="0"> 否</label>
                      <label><input type="radio" name="is_user_token" value="1"> 是</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label>是否响应数据签名：data_sign</label>
                <span>（若为否则无需验证数据签名，若为是则会返回 data_sign 用于验证数据是否安全）</span>
                  <div>
                      <label  class="margin-r-5"><input type="radio" checked="checked" name="is_response_sign"  value="0"> 否</label>
                      <label><input type="radio" name="is_response_sign" value="1"> 是</label>
                  </div>
              </div>
            </div>
              

            <div class="col-md-6">

              <div class="form-group">
                <label>是否验证请求数据签名：data_sign</label>
                <span>（若为否则无需验证数据签名，若为是则需要请求中带 data_sign 字段 用于验证数据安全）</span>
                  <div>
                      <label  class="margin-r-5"><input type="radio" checked="checked" name="is_request_sign"  value="0"> 否</label>
                      <label><input type="radio" name="is_request_sign" value="1"> 是</label>
                  </div>
              </div>
            </div>
              
              
          <div class="col-md-12">
            <div class="form-group">
                <label>接口文本描述</label>
                <textarea class="form-control textarea_editor" name="describe_text" placeholder="请输入接口文本描述"><?php echo (isset($info['describe_text']) && ($info['describe_text'] !== '')?$info['describe_text']:''); ?></textarea>
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

<?php echo widget('editor/index', array('name'=> 'describe_text','value'=> '')); ?>

<script type="text/javascript">

    ob.setValue("request_type", <?php echo (isset($info['request_type']) && ($info['request_type'] !== '')?$info['request_type']:0); ?>);
    ob.setValue("is_page", <?php echo (isset($info['is_page']) && ($info['is_page'] !== '')?$info['is_page']:0); ?>);
    ob.setValue("developer", <?php echo (isset($info['developer']) && ($info['developer'] !== '')?$info['developer']:0); ?>);
    ob.setValue("is_request_data", <?php echo (isset($info['is_request_data']) && ($info['is_request_data'] !== '')?$info['is_request_data']:0); ?>);
    ob.setValue("is_response_data", <?php echo (isset($info['is_response_data']) && ($info['is_response_data'] !== '')?$info['is_response_data']:0); ?>);
    ob.setValue("is_user_token", <?php echo (isset($info['is_user_token']) && ($info['is_user_token'] !== '')?$info['is_user_token']:0); ?>);
    ob.setValue("is_response_sign", <?php echo (isset($info['is_response_sign']) && ($info['is_response_sign'] !== '')?$info['is_response_sign']:0); ?>);
    ob.setValue("is_request_sign", <?php echo (isset($info['is_request_sign']) && ($info['is_request_sign'] !== '')?$info['is_request_sign']:0); ?>);
    ob.setValue("group_id", <?php echo (isset($info['group_id']) && ($info['group_id'] !== '')?$info['group_id']:0); ?>);
    ob.setValue("api_status", <?php echo (isset($info['api_status']) && ($info['api_status'] !== '')?$info['api_status']:0); ?>);
    ob.setValue("request_type", <?php echo (isset($info['request_type']) && ($info['request_type'] !== '')?$info['request_type']:0); ?>);

    showOrHideFieldData(<?php echo (isset($info['is_request_data']) && ($info['is_request_data'] !== '')?$info['is_request_data']:0); ?>, 'request_data_table'); 
    showOrHideFieldData(<?php echo (isset($info['is_response_data']) && ($info['is_response_data'] !== '')?$info['is_response_data']:0); ?>, 'response_data_table'); 

    $(function(){

        $("input[name=is_request_data]").click(function(){ showOrHideFieldData($(this).val(), 'request_data_table'); });
        $("input[name=is_response_data]").click(function(){ showOrHideFieldData($(this).val(), 'response_data_table'); });
    });


    function showOrHideFieldData(handle, mark)
    {
        if (1 == handle) { $('#' + mark).show(); } else { $('#' + mark).hide(); }
    }
    
    var default_text_name = 'request_data[field_name][]';
    var api_data_type_option = "<?php echo $api_data_type_option; ?>";
    
</script>

<script type="text/javascript">

var arr = [
    static_root + 'module/admin/ext/edittable/jquery.edittable.js', 
];

ob.loadMultiScripts(arr).done(function() {

    var request_data_table = $('#request_data_table').editTable({
        field_templates: {
            'request_data_field_describe' : {
                
                html: "<textarea name='request_data[field_describe][]'/>",
                getValue: function (input) {
                    return $(input).val();
                },
                setValue: function (input, value) {
                    return $(input).text(value);
                }
            },
            'request_data_is_require' : {
                html: "<select name='request_data[is_require][]' style='margin: 5px;'><option value='1'>是</option><option  value='0'>否</option></select>",
                getValue: function (input) {
                    return $(input).val();
                },
                setValue: function (input, value) {
                    var select = $(input);
                    select.find('option').filter(function() {
                        return $(this).val() == value; 
                    }).attr('selected', true);
                    return select;
                }
            },
            'request_data_type' : {
                html: "<select name='request_data[data_type][]' style='margin: 5px;'>"+api_data_type_option+"</select>",
                getValue: function (input) {
                    return $(input).val();
                },
                setValue: function (input, value) {
                    var select = $(input);
                    select.find('option').filter(function() {
                        return $(this).val() == value; 
                    }).attr('selected', true);
                    return select;
                }
            }
        },
        row_template: ['text', 'request_data_type', 'request_data_is_require', 'request_data_field_describe'],
        headerCols: ['字段名称', '数据类型', '&nbsp;&nbsp;是否必填&nbsp;&nbsp;' , '字段描述'],
        first_row: false,
        data: [],
        tableClass: 'inputtable custom'
    });

    request_data_table.loadData(<?php echo $info['request_data_json']; ?>);

    default_text_name = 'response_data[field_name][]';

    var response_data_table = $('#response_data_table').editTable({
        field_templates: {
            'response_data_field_describe' : {
                html: "<textarea name='response_data[field_describe][]'/>",
                getValue: function (input) {
                    return $(input).val();
                },
                setValue: function (input, value) {
                    return $(input).text(value);
                }
            },
            'response_data_type' : {
                html: "<select name='response_data[data_type][]' style='margin: 5px;'>"+api_data_type_option+"</select>",
                getValue: function (input) {
                    return $(input).val();
                },
                setValue: function (input, value) {
                    var select = $(input);
                    select.find('option').filter(function() {
                        return $(this).val() == value; 
                    }).attr('selected', true);
                    return select;
                }
            }
        },
        row_template: ['text', 'response_data_type', 'response_data_field_describe'],
        headerCols: ['字段名称', '数据类型', '字段描述'],
        first_row: false,
        data: [],
        tableClass: 'inputtable custom'
    });

    response_data_table.loadData(<?php echo $info['response_data_json']; ?>);

});

</script>