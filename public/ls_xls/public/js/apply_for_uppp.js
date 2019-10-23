$(function(){
function getParam(name) {  
				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
				var r = location.search.substr(1).match(reg);  
				if (r != null) return unescape(decodeURI(r[2])); 
				return null;  
			}
//	获取个人信息
	personal_data(2);
//	获取申请信息
function get_ApplyInfo(){
	var uid=getParam('user_id');
	$.ajax({
		type: "post",
		url: url + '/api.php/Up/getApplyInfo',
		data: {"token":token},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data;
//				是否可以申请
				if(data.apply_status != "2"){
					var html = '';
					var data1=result.data.up_list;
					for(var i in data1){
						if(data1[i]['apply_info']){
						if(uid==data1[i]['apply_info']['up_user']['user_id']){
					//html += '<div class="upg3"><div class="upg3t1">';
					//	html += '<p class="upg3t1s">姓名:<span class="level_name_1">'+data1[i].level_name_now+'</span></p>';
//						html += '<p class="upg3t1s2"><img src="images/upg3t1s2pic.png" alt="" class="upg3t1s2pic" />';
//						html += '<span class="level_name" style="display: inline-block;">'+data1[i].level_name+'</span></p>';
						html += '</div>';
						var is_apply=data1[i].is_apply;
						if(is_apply == 0){
							html += '<div><div class="upg3t2">';
							//html += '<div style="margin-bottom: 0.5rem;text-align:right;"><a class="upg3t2lr sq_btn" data="'+data1[i].up_type+'">立即申请</a></div>';
							// html += '<div style="margin-bottom: 0.5rem;text-align:right;"><a href="fukuan_info.html">去付款</a></div>';
//
						//	html += '<div class="upg3t2le"><p class="upg3t2lep1">您可申请升级的等级：<span class="level_name">'+data1[i].level_name+'</span></p>';
						//	html += '<p class="upg3t2lep1">您是否提交申请？</p></div></div>';
						}else{
							html += '<div><div class="payimg tc fs28 text_m2" style="margin-top:0.45rem;"><div class="upg3t3le">';
							html += '<p class="upg3t3lep" style="text-align: center;">';
							if(data1[i].apply_info.up_user.head_icon == ""){
							//	html += '<img src="images/tx.png?v=2019" alt=""/></p></div>';
								html += '<img src="'+data1[i].apply_info.up_user.shoukuan_pic+'" alt=""/></p></div>';

							}else{
								html += '<img src="'+data1[i].apply_info.up_user.shoukuan_pic+'" alt=""/></p></div>';
							}
						//	html += '<div class="upg3t3lr"><p class="upg3t3lrp"><img src="images/upg3t3lrpic1.png" alt="" class="upg3t3lrpic" />';
						//	html += '<button type="button" class="code_1 weixin_ip_1">'+data1[i].apply_info.up_user.code+'</button>';
						//	html += '</p><p class="upg3t3lrp"><img src="images/upg3t3lrpic2.png" alt="" class="upg3t3lrpic" />';
						//	html += '<button type="button" class="phone_1 weixin_ip" data-url="'+data1[i].apply_info.up_user.phone+'" data-clipboard-target="#foo" aria-label="复制成功！">'+data1[i].apply_info.up_user.phone+'</button>';
						//	html += '</p><p class="upg3t3lrp"><img src="images/upg3t3lrpic3.png" alt="" class="upg3t3lrpic" />';
						//	html += '<button type="button" class="wx_account_1 weixin_ip" data-url="'+data1[i].apply_info.up_user.wx_account+'" data-clipboard-target="#foo" aria-label="复制成功！">'+data1[i].apply_info.up_user.wx_account+'</button>';
						//	html += '</p></div>';
						//	if(is_apply == "1"){
						//		html += '<div class="upg3t3le" style="background:transparent;"><p class="upg3t3lep" style="text-align: center;">申请中</p></div></div></div>';
						//	}else{
						//		html += '<div class="upg3t3le" style="background:transparent;"><p class="upg3t3lep" style="text-align: center;">申请成功</p></div></div></div>';
						//	}
						}
						html += '</div>';
					}
					}
					}
				}else{
					$(".kkc").css("display","block");
				}
				$(".apply_list").html(html);
				//	申请升级接口
				$(".sq_btn").on("click",function(){
					if($(this).attr("data1") != "2"){
						var _that=$(this);
						$(_that).attr("data1","2");
						var up_type=$(this).attr("data");
						$.ajax({
							type: "post",
							url: url + '/api.php/Up/apply',
							data: {"token":token,"up_type":up_type},
							dataType: 'json',
							success: function(result) {
								if(result.code == '0000') {
									alert(result.msg);
									get_ApplyInfo();
								}else{
									isErr(result);
								}
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
								alert("请求失败：" + XMLHttpRequest.status);
							},
							complete:function(){
								$(_that).attr("data1","1");
							}
						});
					}
				})
				
				
				//	复制文本
					$(".weixin_ip").on("click",function(){
						if($(this).attr("data-url") != undefined){
							$("#foo").val($(this).attr("data-url"));
						}
					})
			}else{
				isErr(result);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("请求失败：" + XMLHttpRequest.status);
		}
	});
}
get_ApplyInfo();	
	
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
        $(document).on("click",".weixin_ip",function(){
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

