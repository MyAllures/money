$(function(){
	var token=localStorage.getItem("token");
	var p=1;
	var pagesize=10;	
	function financial_list(p){
		var d={};
		d.token=token;
		d.pagesize=pagesize;
		d.p=p;
		$.ajax({
			type: "post",
			url:url + '/api.php/User/getChildList',
			async: false,
			data:d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					var data=result.data.list;
					var count=result.data.count;
					var one_plus=result.data.one_plus;
					var html='';
					for(var i in data){
						if(data[i].head_icon == ""){
							html += '<div><div class="ldiv"><img src="images/tximg.png?v=2019" class="tktx"/></div>';
						}else{
							html += '<div><div class="ldiv"><img src="'+data[i].head_icon+'" class="tktx"/></div>';
						}
						html += '<div class="rdiv fl-l"><div class="h77 fs24"><img src="images/nic.png" class="nic"/>';
						html += '<span>'+data[i].account_name+'</span><div class="fl-r fs24">';
						html += '<img src="images/wei.png" class="wei"/><button type="button" class="weixin_ip" data-url="'+data[i].wx_account+'" data-clipboard-target="#foo" aria-label="复制成功！">'+data[i].wx_account+'</button></div></div>';
						html += '<div class="h77 fs24 llk"><div style="display:inline-block;"><img src="images/tel.png" class="tel"/><button type="button" class="weixin_ip" data-url="'+data[i].username+'" data-clipboard-target="#foo" aria-label="复制成功！">'+data[i].username;
						html += '</button></div><div class="fs24" style="display:inline-block;">'+data[i].create_time+'</div></div></div></div>';
					}
					if (html == "" || data.length < pagesize) {
						$('.notMore').css('display',"block")
					}
					$("#mytk").append(html);
					$("#team_count").html(count)
					$("#one_plus").html(one_plus)
//					复制文本
					$(".weixin_ip").on("click",function(){
						if($(this).attr("data-url") != undefined){
							$("#foo").val($(this).attr("data-url"));
						}
					})
					
				} else {
					isErr(result);
				}
			},			
		})
	}
	financial_list(p);
	//	下拉加载更多
	$(window).scroll(function() {
		console.log("ljl")
		if ($(document).scrollTop() >= $(document).height() - $(window).height() - 70) {			
		// console.log('我到底了');
			if ($('.notMore').css('display') != "block") {
				p++;
				financial_list(p);
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
