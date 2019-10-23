$(function(){
//	获取个人信息
	personal_data(2);
	
//	获取申请信息
	$.ajax({
		type: "post",
		url: url + '/api.php/Up/getApplyInfo',
		data: {"token":token},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data;
				
				$(".code_1").html(data.apply_info.up_user.code);
				$(".phone_1").html(data.apply_info.up_user.phone).attr("data-url",data.apply_info.up_user.phone);
				$(".wx_account_1").html(data.apply_info.up_user.wx_account).attr("data-url",data.apply_info.up_user.wx_account);
				$(".level_name").html(data.apply_info.level_after_name);
				if(data.apply_info.up_user.head_icon != ""){
					$(".upg3t3lep img").attr("src",data.apply_info.up_user.head_icon);
				}
			}else{
				isErr(result);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("请求失败：" + XMLHttpRequest.status);
		}
	});
	$(".weixin_ip").on("click",function(){
		if($(this).attr("data-url") != undefined){
			$("#foo").val($(this).attr("data-url"));
		}
	})
	
	
//	复制文本
	var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isiOS) {
        var clipboard = new Clipboard(".weixin_ip");
        clipboard.on("success", function(e) {
		    alert('复制成功'); 		 
		    e.clearSelection(); 
        })
    } else {
        $(".weixin_ip").on("click",function(){
	        var text = $(this).attr("data-url");
	        var oInput = document.createElement('input');
	        oInput.value = text;
	        document.body.appendChild(oInput);
	        oInput.select(); // 选择对象
	        document.execCommand("Copy"); // 执行浏览器复制命令
	        oInput.className = 'oInput';
	        oInput.style.display = 'none';
	        alert('复制成功');
			return false;
	    })
    }
})
