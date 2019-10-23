$(function(){
	$.ajax({
		type: "post",
		url:url + '/api.php/User/getShareInfo',
		async: false,
		data:{"token":token},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				$(".share_qrcode").attr("src",result.data.share_qrcode);
				$(".code_1").html(result.data.code);
				$("#foo").val(result.data.share_link);
				$("#test").attr("data-url",result.data.share_link);
			} else {
				isErr(result);
			}
		},			
	})
	var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isiOS) {
        var clipboard = new Clipboard("#test");
        clipboard.on("success", function(e) {
            var msg = e.trigger.getAttribute('aria-label'); 
		    alert(msg); 		 
		    e.clearSelection(); 
        })
    } else {
		//alert("++");
        $("#test").click(function () {
	        var text = $(this).attr("data-url");
	        var oInput = document.createElement('input');
	        oInput.value = text;
	        document.body.appendChild(oInput);
	        oInput.select(); // 选择对象
	        document.execCommand("Copy"); // 执行浏览器复制命令
	        oInput.className = 'oInput';
	        oInput.style.display = 'none';
	        alert('复制成功');
	
	    })
    }
})
