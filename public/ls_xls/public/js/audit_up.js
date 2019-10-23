$(function(){
//	获取个人信息
	personal_data(2);
	
	
	$(".renav .renavlink").click(function(){
		$(this).addClass('on').siblings(".renavlink").removeClass("on");
		var i = $(this).index();
		$(".revilistd .revilist").eq(i).show().siblings(".revilist").hide();
		$('.notMore').css("display","none");
		$(document).scrollTop(0);
		$(".revilist").html("");
		p=1;
		audit();
	})
	var p=1;
	var pagesize=10;	
	function audit(){
		if($(".renav .on").attr("data") == "0"){
			var url1="/api.php/Up/applyList";
		}else{
			var url1="/api.php/Up/verifyList";
		}
		var d={};
		d.token=token;
		d.pagesize=pagesize;
		d.p=p;
		d.state="all";
		$.ajax({
			type: "post",
			url: url + url1,
			data: d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					var data=result.data.list;
					var html ='';
					if($(".renav .on").attr("data") == "0"){
						for(var i in data){
							html += '<div class="upg3"><div class="upg3t3 revi"><div class="upg3t3le">';
//							设置默认头像
							if(data[i].up_user.head_icon != ""){
								html += '<p class="upg3t3lep"><img src="'+data[i].up_user.head_icon+'" alt=""/></p>';
							}else{
								html += '<p class="upg3t3lep"><img src="images/my_header@2x.png?v=2019" alt=""/></p>';
							}
							html += '</div><div class="upg3t3lr">';
							html += '<p class="upg3t3lrp"><img src="images/upg3t3lrpic1.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip_1">姓名：'+data[i].up_user.account_name+'</button></p>';
							html += '<p class="upg3t3lrp"><img src="images/upg3t3lrpic1.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip_1">ID：'+data[i].up_user.code+'</button>';
							html += '</p><p class="upg3t3lrp">';
							html += '<img src="images/upg3t3lrpic2.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip" data-url="'+data[i].up_user.phone+'" data-clipboard-target="#foo" aria-label="复制成功！">手机：'+data[i].up_user.phone+'</button>';
							html += '</p><p class="upg3t3lrp">';
							html += '<img src="images/upg3t3lrpic3.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip" data-url="'+data[i].up_user.wx_account+'" data-clipboard-target="#foo" aria-label="复制成功！">微信：'+data[i].up_user.wx_account+'</button>';
							html += '</p></div><div class="upg3t3lr2">';
							 html += '<a class="upg3t3lr2link ts_btn" data="0" data1="'+data[i].id+'">投诉</a>';

//							if(data[i].status_complain == "0"){
//								html += '<a class="upg3t3lr2link ts_btn" data="0" data1="'+data[i].id+'">投诉</a>';
//								html += '<a class="upg3t3lr2link cs_btn" data="0">撤诉</a>';
//							}else if(data[i].status_complain == "1"){
//								html += '<a class="upg3t3lr2link ts_btn" data="1" data1="'+data[i].id+'">已投诉</a>';
//								html += '<a class="upg3t3lr2link cs_btn" data="1" data1="'+data[i].id+'">撤诉</a>';
//							}else if(data[i].status_complain == "2"){
//								html += '<a class="upg3t3lr2link ts_btn" data="2" data1="'+data[i].id+'">已投诉</a>';
//								html += '<a class="upg3t3lr2link cs_btn" data="2" data1="'+data[i].id+'">已撤诉</a>';
//							}
							html += '</div></div></div>';
						}
					}else{
						for(var i in data){
							html += '<div class="upg3"><div class="upg3t3 revi"><div class="upg3t3le">';
//							设置默认头像
							if(data[i].apply_user.head_icon != ""){
								html += '<p class="upg3t3lep"><img src="'+data[i].apply_user.head_icon+'" alt=""/></p>';
							}else{
								html += '<p class="upg3t3lep"><img src="images/my_header@2x.png?v=2019" alt=""/></p>';
							}
							
							html += '</div><div class="upg3t3lr">';
							html += '<p class="upg3t3lrp"><img src="images/upg3t3lrpic1.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip_1">姓名：'+data[i].apply_user.account_name+'</button></p>';
							html += '<p class="upg3t3lrp"><img src="images/upg3t3lrpic1.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip_1">ID：'+data[i].apply_user.code+'</button></p>';
							html += '<p class="upg3t3lrp">';
							html += '<img src="images/upg3t3lrpic2.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip" data-url="'+data[i].apply_user.phone+'" data-clipboard-target="#foo" aria-label="复制成功！">手机：'+data[i].apply_user.phone+'</button>';
							html += '</p><p class="upg3t3lrp">';
							html += '<img src="images/upg3t3lrpic3.png" alt="" class="upg3t3lrpic" /><button type="button" class="weixin_ip" data-url="'+data[i].apply_user.wx_account+'" data-clipboard-target="#foo" aria-label="复制成功！">微信：'+data[i].apply_user.wx_account+'</button>';
							html += '</p></div><div class="upg3t3lr2">';
							if(data[i].status == "0"){
								html += '<a class="upg3t3lr2link audit_btn" data="1" data1="'+data[i].id+'">确认</a>';
								html += '<a class="upg3t3lr2link audit_btn" data="2" data1="'+data[i].id+'">取消</a>';
							}else if(data[i].status == "1"){
								html += '<span style="color:#fff">已成功</span>';
							}else{
								html += '<span>已失败</span>';
							}
							
							html += '</div></div></div>';
						}
					}
					
					if (html == "" || data.length < pagesize) {
						$('.notMore').css('display',"block")
					}
					$(".revilist").append(html);
					
//					投诉
					$(".ts_btn").on("click",function(){
						if($(this).attr("data") == "0"){
							location.href="My_complaint.html?ts_type=0&apply_id="+$(this).attr("data1");
						}else if($(this).attr("data") == "1"){
							location.href="My_complaint.html?ts_type=1&apply_id="+$(this).attr("data1");
						}else{
							location.href="My_complaint.html?ts_type=2&apply_id="+$(this).attr("data1");
						}
					})
					
//					撤诉
					$(".cs_btn").on("click",function(){
						if($(this).attr("data") == "1"){
							location.href="My_complaint.html?ts_type=1&apply_id="+$(this).attr("data1");
						}else if($(this).attr("data") == "2"){
							location.href="My_complaint.html?ts_type=2&apply_id="+$(this).attr("data1");
						}
					})	
					
//					审核
					$(".audit_btn").on("click",function(){
						$(".qr_btn").attr("data",$(this).attr("data")).attr("data1",$(this).attr("data1"));
						if($(this).attr("data") == "1"){
							$(".jianshan").html("是否确定审核成功?");
							dialog('#d3');
						}else{
							$(".jianshan").html("是否确定审核失败?");
							dialog('#d3');
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
	audit(p);
	//	下拉加载更多
	$(window).scroll(function() {
		if ($(document).scrollTop() >= $(document).height() - $(window).height() - 70) {			
		// console.log('我到底了');
			if ($('.notMore').css('display') != "block") {
				p++;
				audit(p);
			}
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
	
//	审核
	$(".qr_btn").on("click",function(){
		var verify_status=$(this).attr("data");
		var apply_id=$(this).attr("data1");
		var d={};
		d.verify_status=verify_status;
		d.apply_id=apply_id;
		d.token = token;
		$.ajax({
			type: "post",
			url: url + '/api.php/Up/verify',
			data: d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					alert(result.msg);
					location.reload();
				} else {
					isErr(result);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("请求失败：" + XMLHttpRequest.status);
			}
		});
	})
})
