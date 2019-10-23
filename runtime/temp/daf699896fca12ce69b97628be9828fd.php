<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"D:\wwwroot\YouQianHuan\public/../app/admin\view\auth\menu_auth.html";i:1564540034;s:74:"D:\wwwroot\YouQianHuan\public/../app/admin\view\layout\edit_btn_group.html";i:1564540032;}*/ ?>
<form action="<?php echo url(); ?>" method="post" class="form_single">
    
    <div class="box">
        
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a>菜单授权</a></li>
                <!--<li><a>会员授权</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane">
                <div class="box-body">
                    <?php echo $list; ?>
                </div>
              </div>
            </div>
          </div>

      <div class="box-footer">
          
          
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
         
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
    <span class="ladda-label"><i class="fa fa-send"></i> 确 定</span>
</button>

<a class="btn" onclick="javascript:history.back(-1);return false;"><i class="fa fa-history"></i> 返 回</a>
        
      </div>
    </div>
</form>



<script type="text/javascript" charset="utf-8">
    
    +function($){

        //全选节点
        $('.rules_all').on('change',function(){
            
           $(this).parent().parent().parent().parent().closest('div').find('input').prop('checked',this.checked);
        });

        //当前节点选中后触发选中所有父级
        $('input').on('click',function(){ selectParentElement(this); });

    }(jQuery);
    
    
    function selectParentElement(obj)
    {
        
        var tag = false;
        
        var rules_all = $(obj).parent().parent().parent().parent().parent().prev();
        var rules = $(obj).parent().parent().prev();

        if (typeof (rules_all.html()) !== "undefined") { obj = rules_all; tag = true; }

        if (typeof (rules.html()) !== "undefined") { obj = rules; tag = true; }

        if (false === tag) {  return false; } 
            
        selectParentElement(obj);

        obj.find("input").prop("checked", 'checked');
    }
    
</script>